import request from 'supertest';
import app from '../app';

describe('GET /', () => {
    it('should return 200 OK', async () => {
        await request(app).get('/').expect(200);
    });
});

describe('POST /reset', () => {
    it('should return 200 OK', async () => {
        await request(app).post('/reset').expect(200);
    });
});

describe('GET /balance', () => {
    it('should return 404 0 for non-existing account', async () => {
        const res = await request(app).get('/balance').query({account_id:"1234"}).send()
        expect(res.statusCode).toBe(404);
        expect(res.text).toBe("0");
    });

    it('should get balance for existing account', async () => {
        await request(app).post('/reset')
        
        const res = await request(app).get('/balance').query({account_id:"300"}).send()
        expect(res.statusCode).toBe(200);
        expect(res.text).toBe("0");
    });
});

describe('POST /event', () => {
    it('should create account with initial balance and return 201 status with created object', async () => {
        const res = await request(app)
            .post('/event')
            .send({type:"deposit", destination:"100", amount:10})

        expect(res.statusCode).toBe(201);
        expect(res.text).toStrictEqual("{\"destination\":{\"id\":\"100\",\"balance\":10}}");
    });

    it('should deposit into existing account and return 201 code whith the updated object', async () => {
        const res = await request(app)
            .post('/event')
            .send({type:"deposit", destination:"100", amount:10})

        expect(res.statusCode).toBe(201);
        expect(res.text).toStrictEqual("{\"destination\":{\"id\":\"100\",\"balance\":20}}");
    });
    
    it('should return a 404 status code when make an Withdraw from non-existing account', async () => {
        const res = await request(app)
            .post('/event')
            .send({type:"withdraw", origin:"200", amount:10})

        expect(res.statusCode).toBe(404);
        expect(res.text).toStrictEqual("0");
    });

    it('should return a 201 status code with the origin account when make an Withdraw from existing account', async () => {
        const res = await request(app)
            .post('/event')
            .send({type:"withdraw", origin:"100", amount:5})

        expect(res.statusCode).toBe(201);
        expect(res.text).toStrictEqual("{\"origin\":{\"id\":\"100\",\"balance\":15}}");
    });

    it('should return a 201 status code with the origin and destination account when make an Transfer from existing account', async () => {
        const res = await request(app)
            .post('/event')
            .send({type:"transfer", origin:"100", amount:15, "destination":"300"})

        expect(res.statusCode).toBe(201);
        expect(res.text).toStrictEqual("{\"origin\":{\"id\":\"100\",\"balance\":0},\"destination\":{\"id\":\"300\",\"balance\":15}}");
    });


    it('should return a 404 status when make an Transfer from non-existing account', async () => {
        const res = await request(app)
            .post('/event')
            .send({type:"transfer", origin:"200", amount:15, destination:"300"})

        expect(res.statusCode).toBe(404);
        expect(res.text).toStrictEqual("0");
    });
});