import { Event, EventStatus } from "../interfaces/EventIterface";
import AccountService from "../services/AccountService";


export default class BalanceEventsRules {
    static async deposit(accountService:AccountService, data: Event): Promise<EventStatus> {
        if (!data.destination){
            eventStatus = {
                status: 401, 
                send: "You can't make a deposit with no destination"
            }
            return eventStatus;
        }

        const accountExists = await accountService.checkAccountExists(data.destination);
        var eventStatus: EventStatus;
        if (!accountExists) {
            await accountService.insertAccount({id: data.destination, amount: data.amount});
            eventStatus = {
                status: 201, 
                send: {
                    destination: {id: data.destination, balance: data.amount}
                }
            };
            return eventStatus;
        }

        const account = await accountService.getAccount(data.destination);
        const updatedAccount = await accountService.updateAmount({id: data.destination, amount: (account.amount + data.amount)})
        eventStatus = {
            status: 201, 
            send: {
                destination: {id: updatedAccount?.id, balance: updatedAccount?.amount}
            }
        };
        return eventStatus;
    }

    static async withdraw(accountService:AccountService,data: Event): Promise<EventStatus> {
        var eventStatus: EventStatus;
        if (!data.origin){
            eventStatus = {
                status: 401, 
                send: "You can't make a withdraw without origin"
            }
            return eventStatus;
        }

        const accountExists = await accountService.checkAccountExists(data.origin);
        if (!accountExists) {
            eventStatus = {
                status: 404, send:0
            };
            return eventStatus;
        }

        const account = await accountService.getAccount(data.origin);
        const updatedAccount = await accountService.updateAmount({id: data.origin, amount: (account.amount - data.amount)})
        eventStatus = {
            status: 201, 
            send: {
                origin: {id: updatedAccount?.id, balance: updatedAccount?.amount}
            }
        };
        return eventStatus;
    }

    static async transfer(accountService:AccountService,data: Event): Promise<EventStatus> {
        var eventStatus: EventStatus;
        if (!data.origin || !data.destination){
            eventStatus = {status: 401, send: "You can't make a transfer without origin or destination"}
            return eventStatus;
        }

        const originAccountExists = await accountService.checkAccountExists(data.origin);
        if (!originAccountExists) {
            eventStatus = {status: 404, send:0};
            return eventStatus;
        }

        const destinationAccountExists = await accountService.checkAccountExists(data.destination);
        if (!destinationAccountExists) {
            eventStatus = {status: 404, send:0};
            return eventStatus;
        }

        const originAccount = await accountService.getAccount(data.origin);
        const destinationAccount = await accountService.getAccount(data.destination);
        const updatedOriginAccount = await accountService.updateAmount({id: data.origin, amount: (originAccount.amount - data.amount)})
        const updatedDestinationAccount = await accountService.updateAmount({id: data.destination, amount: (destinationAccount.amount + data.amount)})

        eventStatus = {
            status: 201, 
            send: {
                origin: {
                    id: updatedOriginAccount?.id, balance:updatedOriginAccount?.amount
                }, 
                destination: {
                    id: updatedDestinationAccount?.id, balance: updatedDestinationAccount?.amount
                }
            }
        };
        return eventStatus;
    }
}