import { Account } from "../interfaces/AccountIterface";

export default class AccountService {
    private accounts: Account[] = [];

    public async checkAccountExists(accountId: string): Promise<boolean> {
        try {
            return this.accounts.some((account) => account.id === accountId);
        } catch (error) {
            throw error;
        }
    }

    public async getAccount(accountId: string): Promise<Account> {
        try {
            const accountIndex = await this.getIndexById(accountId);
            return this.accounts[accountIndex];
        } catch (error) {
            throw error;
        }
    }

    public async insertAccount(account: Account): Promise<Account | void> {
        try {
            this.accounts.push(account);
            return account;
        } catch (error) {
            console.error("Error while inserting account: ", error);
            throw error;
        }
    }

    public async updateAmount(updateAccount: Account): Promise<Account | void> {
        try {
            const accountIndex = await this.getIndexById(updateAccount.id);
            this.accounts.splice(accountIndex, 1);
            this.addAccount(updateAccount);
            return updateAccount;
        } catch (error) {
            console.error("Error while updating account:", error);
            throw error;
        }
    }
    
    public getAccounts() {
        return this.accounts;
    }

    public async addAccount(account: Account) {
        try {
            this.accounts.push(account);
            return this.accounts;
        } catch (error) {
            console.error("Error while adding account:", error);
            throw error;
        }
    }

    public async deleteAllAccounts() {
        try {
            this.accounts = [{ id: "300", amount: 0 }];
            return this.accounts;
        } catch (error) {
            console.log(error);
            throw error;
        }
    }

    private async getIndexById(id: string){
        try {
            const accountIndex = this.accounts.findIndex(
                (account) => account.id === id
            );
            if (accountIndex === -1) {
                throw new Error("Account not found");
            }
            return accountIndex;
        } catch (error) {
            console.error("Error while updating account:", error);
            throw error;
        }
    }
}
