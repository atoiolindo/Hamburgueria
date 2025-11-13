import express from "express";
import 'dotenv/config';
import { MercadoPagoConfig, Payment } from "mercadopago";
import cors from "cors";

const app = express();
app.use(cors()); // se PHP estiver chamando via fetch
app.use(express.json());

const client = new MercadoPagoConfig({
  accessToken: process.env.ACCESS_TOKEN,
});

const payment = new Payment(client);

app.post("/criar-pix", async (req, res) => {
  try {
    const { valor, email, idvenda } = req.body;

    const body = {
      transaction_amount: parseFloat(valor),
      description: `Pedido #${idvenda}`,
      payment_method_id: "pix",
      payer: {
        email,
        first_name: "Cliente",
        last_name: "Teste"
      },
      external_reference: `pedido_${idvenda}_${Date.now()}`,
      notification_url: "https://seusite.com/webhook.php"
    };

    const pagamento = await payment.create({ body });
    res.json(pagamento);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: err.message });
  }
});

app.listen(3000, () => console.log("Server rodando em http://localhost:3000"));
