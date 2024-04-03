import express, { Request, Response } from 'express';
import AccountService from '../services/AccountService';
class BalanceController {
    static async reset(req: Request, res: Response) {
        res.status(200).send("ok");
    }
    static async getBalance(req: Request, res: Response){
        const accountId = req.query.account_id as string;
        if (!accountId) {
            res.status(404).send("Account id is invalid");
            return;
        }
        try {
            const accountExists = await AccountService.checkAccountExists(accountId);
            if (!accountExists) {
                res.status(404).send("0");
                return;
            }
            res.status(200).send("ok");
        } catch (error) {
            console.error("Error checking account existence:", error);
            res.status(500).send("Internal server error");
        }
    }
}
export default BalanceController;