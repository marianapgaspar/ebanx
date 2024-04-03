import fs from 'fs';
import path from 'path';
import { Account } from '../interfaces/AccountIterface';

export default class AccountService {
    private accounts: Account[] = [];

    public async checkAccountExists(accountId: string): Promise<boolean> {
      try {
        return this.accounts.some((account) => account.id === accountId);
      } catch (error) {
        console.error('Error while checking if the account exists:', error);
        throw error; 
      }
    }

    public async getAccount(accountId: string): Promise< Account> {
        const accountIndex = this.accounts.findIndex((account) => account.id === accountId);
        if (accountIndex === -1) {
            throw new Error('Account not found');
        }
        return this.accounts[accountIndex];
    }

    public async insertAccount(account: Account): Promise<Account | void> {
        try {
            this.accounts.push(account);
            return account;
        } catch (error) {
            console.error('Error while inserting account: ', error);
            throw error; 
        }
    }

    public async updateAmount(updateAccount: Account): Promise<Account | void> {
        try {
            const accounts = await this.getAccount(updateAccount.id)
            const accountIndex = this.accounts.findIndex((account) => account.id === updateAccount.id);
            if (accountIndex === -1) {
                throw new Error('Account not found');
            }
            this.accounts.splice(accountIndex, 1);
            this.addAccount(updateAccount);
            return updateAccount;
        } catch (error) {
            console.error('Error while updating account:', error);
            throw error; 
        }
    }
    public getAccounts(){
      return this.accounts;
    }
    public async addAccount(account: Account){
      this.accounts.push(account);
      return this.accounts;
    }
    public async deleteAllAccounts() {
      try {
        this.accounts = [];
        return this.accounts;
      } catch (error) {
        console.log(error)
        throw error;
      }
    }
}