import express, { Request, Response } from 'express';
import BalanceController from '../controller/BalanceController';

const router = express.Router();

router.get('/reset', async (req: Request, res: Response) => {
    await BalanceController.reset(req, res);
});
router.get("/balance",async (req: Request, res: Response) => {
    await BalanceController.getBalance(req,res);
})

export default router;
