import express, { Request, Response } from 'express';

class BalanceController {
    static async reset(req: Request, res: Response) {
        res.status(500).send("ok");
    }
}
export default BalanceController;