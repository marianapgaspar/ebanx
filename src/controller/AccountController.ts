import { Request, Response } from 'express';
import AccountService from '../services/AccountService';
import AccountEventsRules from '../rules/AccountEventsRules';
const pick = require('object.pick');

class AccountController {
    public accountService = new AccountService();

    public async reset(req: Request, res: Response) {
        try {
            await this.accountService.deleteAllAccounts();
            res.status(200).send("OK");
            return;
        } catch (error) {
            res.status(500).send("Error trying to reset: "+ error);
            return;
        }
    }
    
    public async getAccount(req: Request, res: Response){
        try {
            const accountId = req.query.account_id as string;
            if (!accountId) {
                res.status(404).json("Account id is invalid");
                return;
            } 

            const accountExists = await this.accountService.checkAccountExists(accountId);
            if (!accountExists) {
                res.status(404).send("0");
                return;
            } 

            const account = await this.accountService.getAccount(accountId);
            res.status(200).send(account.amount.toString());
            return;
        } catch (error) {
            res.status(500).send("Error checking account existence:"+ error);
            return;
        }
    }

    public async event(req: Request, res: Response){
        try {
            const data = pick(req.body, ["type", "destination", "amount", "origin"]);
            var status = 200;
            var send = "";

            const accountEventsRules = new AccountEventsRules(this.accountService, data);
            switch (data.type){
                case "deposit":
                    const deposit = await accountEventsRules.deposit();
                    status = deposit.status;
                    send = deposit.send;
                    break;
                case "withdraw":
                    const withdraw = await accountEventsRules.withdraw();
                    status = withdraw.status;
                    send = withdraw.send;
                    break;
                default:
                    const transfer = await accountEventsRules.transfer();
                    status = transfer.status;
                    send = transfer.send;
                    break;
            }

            res.status(status).json(send);
            return;
        } catch (error) {
            console.error("Error checking account existence:", error);
            res.status(500).json("Internal server error");
            return;
        }
    }
}
export default AccountController;