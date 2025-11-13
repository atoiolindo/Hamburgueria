import 'dotenv/config';
import express from 'express';
import cors from 'cors';
import { MercadoPagoConfig, Payment } from 'mercadopago';

const app = express();
const PORT = 3000;

app.use(cors());  // Permite requisições do PHP
app.use(express.json());  // Para receber JSON do PHP

// Config do Mercado Pago
const client = new MercadoPagoConfig({
    accessToken: process.env.accessToken,  // Token do .env
    options: { timeout: 5000 }
});

app.post('/criar-pix', async (req, res) => {
    const { valor, email, idvenda } = req.body;

    if (!valor || !email || !idvenda) {
        return res.status(400).json({ error: 'Dados incompletos' });
    }

    const payment = new Payment(client);

    const body = {
        transaction_amount: parseFloat(valor),  // Valor dinâmico
        description: `Pedido #${idvenda} - ${Date.now()}`,  // Descrição única
        payment_method_id: 'pix',
        payer: { email: email },  // Email dinâmico
        external_reference: `pedido_${idvenda}_${Date.now()}`,  // Referência única
        notification_url: 'https://seusite.com/webhook.php'  // Seu webhook real
    };

    try {
        const result = await payment.create({ body });
        console.log('Pagamento criado:', result);  // Log no terminal
        res.json(result);  // Retorna o JSON pro PHP
    } catch (error) {
        console.error('Erro:', error);
        res.status(500).json({ error: error.message });
    }
});

app.listen(PORT, () => {
    console.log(`Servidor rodando em http://localhost:${PORT}`);
});