import express, { Request, Response } from 'express';
import AccountService from '../services/AccountService';
import BalanceEventsRules from '../rules/BalanceEventsRules';
const pick = require('object.pick');
const accountService = new AccountService();
class BalanceController {
    static async reset(req: Request, res: Response) {
        await accountService.deleteAllAccounts();
        res.status(200).send("OK");
    }
    static async getBalance(req: Request, res: Response){
        const accountId = req.query.account_id as string;
        var status = 200;
        var send: any = "OK";
        if (!accountId) {
            status = 404;
            send ="Account id is invalid";
            return;
        } else {
            try {
                const accountExists = await accountService.checkAccountExists(accountId);
                if (!accountExists) {
                    res.status(404).send("0");
                    return;
                }
    
                const account = await accountService.getAccount(accountId);
                status = 200;
                send = account.amount;
            } catch (error) {
                console.error("Error checking account existence:", error);
                status = 500;
                send = "Internal server error";
            }
        }
        
        
        res.status(status).send(send);
    }

    static async event(req: Request, res: Response){
        const data = pick(req.body, ["type", "destination", "amount"]);
        var status = 200;
        var send = "";
        if (!data.destination) {
            status = 404;
            send = "Account id is invalid";
            return;
        } else {
            try {
                switch (data.type){
                    case "deposit":
                        const deposit = await BalanceEventsRules.deposit(accountService, data);
                        status = deposit.status;
                        send = deposit.send;
                        break;
                    case "withdraw":
                        const withdraw = await BalanceEventsRules.withdraw(accountService,data);
                        status = withdraw.status;
                        send = withdraw.send;
                        break;
                    default:
                        const transfer = await BalanceEventsRules.transfer(accountService,data);
                        status = transfer.status;
                        send = transfer.send;
                        break;
                }
            } catch (error) {
                console.error("Error checking account existence:", error);
                status = 500;
                send = "Internal server error";
            }
        }
        
        
        res.status(status).json(send);
    }
}
export default BalanceController;