const express = require('express');
const bodyParser = require('body-parser');
const { toFile } = require('qrcode');

const app = express();
app.use(bodyParser.json());
app.use(express.static('public'));

app.post('/submit-form', async (req, res) => {
  const { from, to, timeSlot, ticketType, passengers } = req.body;

  // Perform any necessary backend processing or calculations
  // ...

  const response = {
    ticketId: '12345', // Replace with actual ticket ID
  };

  const qrCodeText = `Ticket ID: ${response.ticketId}`;
  const qrCodeImagePath = 'qrcode.png';
  await generateQRCode(qrCodeText, qrCodeImagePath);

  response.qrCodeImage = qrCodeImagePath;

  res.json(response);
});

async function generateQRCode(text, imagePath) {
  try {
    const qrCodeOptions = {
      type: 'png',
      errorCorrectionLevel: 'H',
      quality: 0.92,
      margin: 1,
    };
    await toFile(imagePath, text, qrCodeOptions);
  } catch (error) {
    console.error('Error generating QR code:', error);
  }
}

app.listen(8080, () => {
  console.log('Server started on port 8080');
});
