// Regex patterns for validation
var namePattern = /^[A-Za-z\s]+$/; // Only alphabets and spaces allowed in name
var emailPattern = /^\S+@\S+\.\S+$/; // Basic email format validation
var phonePattern = /^\d{10}$/; // 10-digit numeric phone number

function applyMetroCard() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var dob = document.getElementById("dob").value;
  var phoneNumber = document.getElementById("PhoneNumber").value;
  var passengerType = document.getElementById("passengerType").value;

  // Validate name
  if (!name.match(namePattern)) {
    alert("Please enter a valid name. Only alphabets and spaces are allowed.");
    return false;
  }

  // Validate email
  if (!email.match(emailPattern)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Validate phone number
  if (!phoneNumber.match(phonePattern)) {
    alert("Please enter a valid 10-digit phone number.");
    return false;
  }

  var formElement = document.getElementById("metroForm");
  var cardContainer = document.getElementById("cardContainer");

  // Hide the form
  formElement.style.display = "none";

  // Generate a unique application ID
  var applicationId = generateApplicationId();

  // Create a new card element
  var card = document.createElement("div");
  card.className = "card new-card";

  var cardContent = document.createElement("div");
  cardContent.className = "card-content";

  var applicationIdLabel = document.createElement("label");
  applicationIdLabel.textContent = "Application ID: ";
  var applicationIdValue = document.createElement("span");
  applicationIdValue.textContent = applicationId;

  var nameLabel = document.createElement("label");
  nameLabel.textContent = "Name: ";
  var nameValue = document.createElement("span");
  nameValue.textContent = name;

  var emailLabel = document.createElement("label");
  emailLabel.textContent = "Email: ";
  var emailValue = document.createElement("span");
  emailValue.textContent = email;

  var dobLabel = document.createElement("label");
  dobLabel.textContent = "Date of Birth: ";
  var dobValue = document.createElement("span");
  dobValue.textContent = dob;

  var phoneNumberLabel = document.createElement("label");
  phoneNumberLabel.textContent = "Phone Number: ";
  var phoneNumberValue = document.createElement("span");
  phoneNumberValue.textContent = phoneNumber;

  var passengerTypeLabel = document.createElement("label");
  passengerTypeLabel.textContent = "Passenger Type: ";
  var passengerTypeValue = document.createElement("span");
  passengerTypeValue.textContent = passengerType;

  cardContent.appendChild(applicationIdLabel);
  cardContent.appendChild(applicationIdValue);
  cardContent.appendChild(document.createElement("br"));

  cardContent.appendChild(nameLabel);
  cardContent.appendChild(nameValue);
  cardContent.appendChild(document.createElement("br"));

  cardContent.appendChild(emailLabel);
  cardContent.appendChild(emailValue);
  cardContent.appendChild(document.createElement("br"));

  cardContent.appendChild(dobLabel);
  cardContent.appendChild(dobValue);
  cardContent.appendChild(document.createElement("br"));

  cardContent.appendChild(phoneNumberLabel);
  cardContent.appendChild(phoneNumberValue);
  cardContent.appendChild(document.createElement("br"));

  cardContent.appendChild(passengerTypeLabel);
  cardContent.appendChild(passengerTypeValue);

  card.appendChild(cardContent);
  cardContainer.appendChild(card);

  // Return false to prevent the form from submitting
  return false;
}

function generateApplicationId() {
  var timestamp = Date.now().toString(36); // Convert current timestamp to base36 string
  var random = Math.floor(Math.random() * 10000).toString(36); // Generate random number and convert to base36 string
  var applicationId = timestamp + random; // Combine timestamp and random number
  return applicationId.toUpperCase(); // Convert to uppercase for better readability
}
