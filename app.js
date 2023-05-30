const express = require('express');
const { json } = require('body-parser');
const { toFile } = require('qrcode');
const fs = require('fs');

const app = express();
// Middleware for parsing JSON data
app.use(json());

// Serve static files (HTML, CSS, JS)
app.use(express.static('public'));

// Handle form submission
app.post('#', async (req, res) => {
  // Get form data from the request body
  const from = req.body.from;
  const to = req.body.to;
  const timeSlot = req.body.timeSlot;
  const ticketType = req.body.ticketType;
  const passengers = req.body.passengers;

  // Perform any necessary backend processing or calculations
  // ...

  // Create the response object
  const response = {
    ticketId: '12345', // Replace with actual ticket ID
  };

  // Generate QR code
  const qrCodeText = `Ticket ID: ${response.ticketId}`;
  const qrCodeImagePath = 'qrcode.png';
  await generateQRCode(qrCodeText, qrCodeImagePath);

  // Attach QR code image URL to the response
  response.qrCodeImage = qrCodeImagePath;

  // Send the response back to the client
  res.json(response);
});

// Function to generate QR code
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

// Start the server
app.listen(8080, () => {
  console.log('Server started on port 8080');
});
