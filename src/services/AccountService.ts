import fs from 'fs';
import path from 'path';

interface Account {
  id: string;
  amount: number;
}

export default class AccountService {
    private static readonly accountsFilePath = path.resolve(__dirname, '..', 'data', 'accounts.json');

    static async checkAccountExists(accountId: string): Promise<boolean> {
        const accountsData = fs.readFileSync(this.accountsFilePath, 'utf-8');
        const accounts: Account[] = await JSON.parse(accountsData);

        return accounts.some((account) => account.id === accountId);
    }
}