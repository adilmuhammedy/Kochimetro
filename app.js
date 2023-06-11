const express = require('express');
const { createCanvas, registerFont } = require('canvas');
const QRCode = require('qrcode');
const path = require('path');
const cors = require('cors');
const { MongoClient } = require('mongodb');
const app = express();

app.use(express.json());
app.use(express.static(path.join('Projects\Kochi Metro\code', 'code')));
app.use(cors());
app.options('/submit-form', cors()); // enable pre-flight request for POST request
app.use((req, res, next) => {
  //res.setHeader('Access-Control-Allow-Origin', 'http://127.0.0.1:5500');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  res.setHeader('Access-Control-Allow-Credentials', true);
  next();
});

const url = "mongodb://localhost:27017";
const options = {
  useNewUrlParser: true,
  useUnifiedTopology: true
};



function generateTicketId() {
  const timestamp = Date.now();
  const random = Math.floor(Math.random() * 10000);
  const ticketId = `${timestamp}-${random}`;
  return ticketId;
}

app.post('/submit-form',cors(), async (req, res) => {
  const { from, to, timeSlot, ticketType, passengers } = req.body;
  //console.log("from: " + from);
  //console.log("to: " + to);
  //console.log("timeSlot: " + timeSlot);
  //console.log("ticketType: " + ticketType);
  //console.log("passengers: " + passengers);
  // Perform any necessary backend processing or calculations
  // ...
  let fare=0;
  
  try {
    // Connect to the MongoDB server
    const client = await MongoClient.connect(url, options);
    console.log('Connected to MongoDB server');

    // Select the database and collection
    const collection = client.db('Kochimetro').collection('ticket');

    // Create a query object with the "from" and "to" values
    const query = { from: from, to: to };

    // Find the document that matches the query in the collection
    const foundDocument = await collection.findOne(query);
   
    // Retrieve the fare value from the document
    if (foundDocument) {
      fare = foundDocument.fare;
      console.log('Fare:', fare);
    }
  } catch (error) { 
    console.error(error);
  }

  const redirectUrl = `confirmation.html?fare=${fare}`;
  const response = {
    ticketId: generateTicketId(),
    confirmationMessage: 'Your ticket has been booked successfully!',
    fare: fare,
    redirectUrl: redirectUrl
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
