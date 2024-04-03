export interface Event {
    type: string;
    amount: number;
    destination?: string;
    origin?: string;
}

export interface EventStatus {
    status: number;
    send: any
}