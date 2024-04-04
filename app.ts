import express from 'express';
import accountRoutes from './src/routes/AccountRoutes';

const app = express();

app.use(express.json());
app.use('/', accountRoutes);

const PORT: number = parseInt(process.env.PORT || '3000');

app.listen(PORT, () => {
  console.log(`Running on ${PORT} port`);
});

export default app;