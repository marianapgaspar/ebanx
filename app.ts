import express from 'express';
import balanceRoutes from './src/routes/BalanceRoutes';

const app = express();

app.use(express.json());
app.use('/', balanceRoutes);

const PORT: number = parseInt(process.env.PORT || '3000');

app.listen(PORT, () => {
  console.log(`Running on ${PORT} port`);
});
