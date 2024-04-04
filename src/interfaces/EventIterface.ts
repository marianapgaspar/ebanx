export interface EventReceiveParams {
    type: string;
    amount: number;
    destination?: string;
    origin?: string;
}

export interface EventStatusReturn {
    status: number;
    send: any
}