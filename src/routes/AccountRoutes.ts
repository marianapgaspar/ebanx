import express, { Request, Response } from 'express';
import AccountController from '../controller/AccountController';

const router = express.Router();
const balanceController = new AccountController;

router.get("/", async(req: Request, res: Response) => {
    res.send("Hello world");
})
router.post('/reset', async (req: Request, res: Response) => {
    await balanceController.reset(req, res);
});

router.get("/balance",async (req: Request, res: Response) => {
    await balanceController.getAccount(req,res);
})

router.post("/event", async (req: Request, res: Response) => {
    await balanceController.event(req,res);
})

export default router;
