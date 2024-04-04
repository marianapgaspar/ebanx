import express, { Request, Response } from 'express';
import AccountService from '../services/AccountService';
import BalanceEventsRules from '../rules/BalanceEventsRules';
const pick = require('object.pick');
class BalanceController {
    public accountService = new AccountService();

    public async reset(req: Request, res: Response) {
        await this.accountService.deleteAllAccounts();
        res.status(200).send("OK");
        return;
    }
    public async getBalance(req: Request, res: Response){
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
            switch (data.type){
                case "deposit":
                    const deposit = await BalanceEventsRules.deposit(this.accountService, data);
                    status = deposit.status;
                    send = deposit.send;
                    break;
                case "withdraw":
                    const withdraw = await BalanceEventsRules.withdraw(this.accountService,data);
                    status = withdraw.status;
                    send = withdraw.send;
                    break;
                default:
                    const transfer = await BalanceEventsRules.transfer(this.accountService,data);
                    status = transfer.status;
                    send = transfer.send;
                    break;
            }
        } catch (error) {
            console.error("Error checking account existence:", error);
            status = 500;
            send = "Internal server error";
        }
        
        res.status(status).json(send);
        return;
    }
}
export default BalanceController;