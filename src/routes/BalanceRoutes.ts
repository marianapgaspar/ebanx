import express, { Request, Response } from 'express';
import BalanceController from '../controller/BalanceController';

const router = express.Router();
const balanceController = new BalanceController;
router.get("/", async(req: Request, res: Response) => {
    res.send("Hello world");
})
router.post('/reset', async (req: Request, res: Response) => {
    await balanceController.reset(req, res);
});
router.get("/balance",async (req: Request, res: Response) => {
    await balanceController.getBalance(req,res);
})

router.post("/event", async (req: Request, res: Response) => {
    await balanceController.event(req,res);
})

export default router;
