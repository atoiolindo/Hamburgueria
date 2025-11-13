import 'dotenv/config'
import  { MercadoPagoConfig, Payment } from 'mercadopago';

const client = new MercadoPagoConfig({
    accessToken: process.env.accessToken,
    options: {
        timeout: 5000,
        idempotencyKey: 'abc'
    }
});

const payment = new Payment(client);

const body = {
    transaction_amount: 20.10,
    description: 'teste api pix',
    payment_method_id: 'pix',
    payer:{
        email:'liroyasmin@gmail.com'
    },

};

payment.create ({body }).then(console.log).catch(console.log);