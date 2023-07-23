const express = require('express');
const { createCanvas, registerFont } = require('canvas');
const QRCode = require('qrcode');
const path = require('path');
const cors = require('cors');
const { MongoClient } = require('mongodb');
const app = express();
const Razorpay=require('razorpay');
const instance = new Razorpay({
  key_id: 'rzp_test_KoHAhlJPYY3SRe',
  key_secret: 'D27EAT8wqDj3zSZfWH8iaUIG',
});
app.use(express.json());
app.use(express.static(path.join('Projects\Kochi Metro\code', 'code')));
app.use(cors());
app.options('/submit-form', cors()); // enable pre-flight request for POST request
app.use((req, res, next) => {
  res.setHeader('Access-Control-Allow-Origin', 'http://127.0.0.1:5500/');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  res.setHeader('Access-Control-Allow-Credentials', true);
  next();
});
app.use(express.static(path.join(__dirname, 'public')));
const url = "mongodb://localhost:27017";
const options = {
  useNewUrlParser: true,
  useUnifiedTopology: true
};
process.on('unhandledRejection', (err) => {
  console.error(err);
  // Handle the error appropriately
});
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
  console.log("from: " + from);
  console.log("to: " + to);
  console.log("timeSlot: " + timeSlot);
  console.log("ticketType: " + ticketType);
  console.log("passengers: " + passengers);
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
      console.log('Fare from database:', fare);
      if(passengers > 1) {
        fare = fare * passengers;
      }
      if(ticketType == "Two-way") {
        fare = fare * 2;
      }
      if(timeSlot == "6:00-8:00") {
        fare = fare * 0.5;
      }
      if(timeSlot == "21:00-23:00") {
        fare = fare * 0.5;
      }
    }
  } catch (error) { 
    console.error(error);
  }
  const order =  await instance.orders.create({ amount: fare*100, currency: 'INR', receipt: 'receipt1', payment_capture: '0' });
  console.log("order",order);
  const redirectUrl = `confirmation.html?fare=${fare}&order_id=${order.id}`;
  const response = {
    ticketId: generateTicketId(),
    confirmationMessage: 'Your ticket has been booked successfully!',
    fare: fare,
    redirectUrl: redirectUrl,
    orderId: order.id,
  };


  const qrCodeText = `Ticket ID: ${response.ticketId}`;
  const qrCodeImagePath = 'qrcode.png';
  await generateQRCode(qrCodeText, qrCodeImagePath);
  response.qrCodeImage = qrCodeImagePath;
 
  res.setHeader('Access-Control-Allow-Origin', 'http://127.0.0.1:5500/');
  res.setHeader('Access-Control-Allow-Origin', 'http://localhost:3000');
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

app.post('/create/orderId', (req, res) => {
  console.log("create orderId request",req.body);
  var options={
    amount:req.body.amount,
    currency:"INR",
    receipt:"rcp1",
  };
  instance.orders.create(options).then((order) => {
    console.log(order);
    res.send({ orderId: order.id, amount: order.amount });
  })
  .catch((error) => {
    console.log(error);
    res.status(500).send("Some error occured");
  });
});


app.post('/api/verify/payment/', (req, res) => {
  try{
    res.redirect("http://localhost:3000/ticket.html?+response.signatureIsValid");
  //console.log("verify payment request",req.body);
  //let body=req.body.response.razorpay_order_id+"|"+req.body.response.razorpay_payment_id;
  //var crypto = require("crypto");
  //var expectedSignature=crypto.createHmac('sha256', 'D27EAT8wqDj3zSZfWH8iaUIG')
  //.update(body.toString())
  //.digest('hex');
  //console.log("sig received",req.body.response.razorpay_signature);
  //console.log("sig generated",expectedSignature);
  //var response={"signatureIsValid":"false"};
  //if(expectedSignature===req.body.response.razorpay_signature)
  //response={"signatureIsValid":"true"};
  }
  
  catch(error){
    console.log(error);
    res.status(500).send("Error verifying payment");
  }
});

app.get('' , (req,res) => {
  res.sendFile(path.join(__dirname, 'home.php'));
});

// const mongoClient = new MongoClient("mongodb://localhost:27017");

// mongoClient.connect(() => {
//   const db = mongoClient.db("ticketing");
//   const collection = db.collection("tickets");

//   const ticket = {
//     from: from,
//     to: to,
//     timeSlot: timeSlot,
//     ticketType: ticketType,
//     passengers: passengers,
//     fare: fare,
//   };

//   collection.insertOne(ticket, (err, result) => {
//     if (err) {
//       console.log(err);
//     } else {
//       console.log("Ticket saved successfully");
//     }
//   });
// });


// mongoClient.connect(() => {
//   const db = mongoClient.db("ticketing");
//   const collection = db.collection("tickets");


// const ticket = collection.findOne({
//   from: from,
//   to: to,
//   timeSlot: timeSlot,
//   ticketType: ticketType,
//   passengers: passengers,
// });

// if (ticket) {
//   console.log(ticket);
// } else {
//   console.log("Ticket not found");
// }
// });


app.listen(8080, () => {
  console.log('Server started on port 8080');
});
