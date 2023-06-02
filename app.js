const express = require('express');
const { createCanvas, registerFont } = require('canvas');
const QRCode = require('qrcode');
const path = require('path');
const cors = require('cors');
const app = express();
app.use(express.json());
app.use(express.static(path.join('Projects\Kochi Metro\code', 'code')));
app.use(cors());
app.options('/submit-form', cors()); // enable pre-flight request for POST request
app.use((req, res, next) => {
  res.setHeader('Access-Control-Allow-Origin', 'http://127.0.0.1:5500');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  res.setHeader('Access-Control-Allow-Credentials', true);
  next();
});



function generateTicketId() {
  const timestamp = Date.now();
  const random = Math.floor(Math.random() * 10000);
  const ticketId = `${timestamp}-${random}`;
  return ticketId;
}

app.post('/submit-form',cors(), async (req, res) => {
  const { from, to, timeSlot, ticketType, passengers } = req.body;
  console.log("from: " + from);
  console.log("to: " + to);
  console.log("timeSlot: " + timeSlot);
  console.log("ticketType: " + ticketType);
  console.log("passengers: " + passengers);
  // Perform any necessary backend processing or calculations
  // ...

  const response = {
    ticketId: generateTicketId(),
    confirmationMessage: 'Your ticket has been booked successfully!',
  };

  const qrCodeText = `Ticket ID: ${response.ticketId}`;
  const qrCodeImagePath = 'qrcode.png';
  await generateQRCode(qrCodeText, qrCodeImagePath);
  response.qrCodeImage = qrCodeImagePath;
 
  res.setHeader('Access-Control-Allow-Origin', 'http://127.0.0.1:5500');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  res.setHeader('Access-Control-Allow-Credentials', true);
  res.setHeader('Content-Type', 'application/json');
  res.json(response);
});

async function generateQRCode(text, imagePath) {
  try {
    await QRCode.toFile(imagePath, text);
  } catch (error) {
    console.error('Error generating QR code:', error);
  }
}

app.listen(8080, () => {
  console.log('Server started on port 8080');
});
