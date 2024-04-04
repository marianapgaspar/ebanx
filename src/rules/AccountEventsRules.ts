import {
    EventReceiveParams,
    EventStatusReturn,
} from "../interfaces/EventIterface";
import AccountService from "../services/AccountService";

export default class BalanceEventsRules {
    protected accountService: AccountService;
    protected data: EventReceiveParams;

    constructor(accountService: AccountService, data: EventReceiveParams) {
        this.accountService = accountService;
        this.data = data;
    }

    public async deposit(): Promise<EventStatusReturn> {
        if (!this.data.destination) {
            eventStatus = {
                status: 401,
                send: "You can't make a deposit with no destination",
            };
            return eventStatus;
        }

        const accountExists = await this.accountService.checkAccountExists(
            this.data.destination
        );
        var eventStatus: EventStatusReturn;
        if (!accountExists) {
            await this.accountService.insertAccount({
                id: this.data.destination,
                amount: this.data.amount,
            });
            eventStatus = {
                status: 201,
                send: {
                    destination: { id: this.data.destination, balance: this.data.amount },
                },
            };
            return eventStatus;
        }

        const account = await this.accountService.getAccount(this.data.destination);
        const updatedAccount = await this.accountService.updateAmount({
            id: this.data.destination,
            amount: account.amount + this.data.amount,
        });
        eventStatus = {
            status: 201,
            send: {
                destination: {
                    id: updatedAccount?.id,
                    balance: updatedAccount?.amount,
                },
            },
        };
        return eventStatus;
    }

    public async withdraw(): Promise<EventStatusReturn> {
        var eventStatus: EventStatusReturn;
        if (!this.data.origin) {
            eventStatus = {
                status: 401,
                send: "You can't make a withdraw without origin",
            };
            return eventStatus;
        }

        const accountExists = await this.accountService.checkAccountExists(
            this.data.origin
        );
        if (!accountExists) {
            eventStatus = {
                status: 404,
                send: 0,
            };
            return eventStatus;
        }

        const account = await this.accountService.getAccount(this.data.origin);
        const updatedAccount = await this.accountService.updateAmount({
            id: this.data.origin,
            amount: account.amount - this.data.amount,
        });
        eventStatus = {
            status: 201,
            send: {
                origin: { id: updatedAccount?.id, balance: updatedAccount?.amount },
            },
        };
        return eventStatus;
    }

    public async transfer(): Promise<EventStatusReturn> {
        var eventStatus: EventStatusReturn;
        if (!this.data.origin || !this.data.destination) {
            eventStatus = {
                status: 401,
                send: "You can't make a transfer without origin or destination",
            };
            return eventStatus;
        }

        const originAccountExists = await this.accountService.checkAccountExists(
            this.data.origin
        );
        if (!originAccountExists) {
            eventStatus = { status: 404, send: 0 };
            return eventStatus;
        }

        const destinationAccountExists =
            await this.accountService.checkAccountExists(this.data.destination);
        if (!destinationAccountExists) {
            eventStatus = { status: 404, send: 0 };
            return eventStatus;
        }

        const originAccount = await this.accountService.getAccount(
            this.data.origin
        );
        const destinationAccount = await this.accountService.getAccount(
            this.data.destination
        );
        const updatedOriginAccount = await this.accountService.updateAmount({
            id: this.data.origin,
            amount: originAccount.amount - this.data.amount,
        });
        const updatedDestinationAccount = await this.accountService.updateAmount({
            id: this.data.destination,
            amount: destinationAccount.amount + this.data.amount,
        });

        eventStatus = {
            status: 201,
            send: {
                origin: {
                    id: updatedOriginAccount?.id,
                    balance: updatedOriginAccount?.amount,
                },
                destination: {
                    id: updatedDestinationAccount?.id,
                    balance: updatedDestinationAccount?.amount,
                },
            },
        };
        return eventStatus;
    }
}
