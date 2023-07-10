function applyMetroCard() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var dob = document.getElementById("dob").value;
  var phoneNumber = document.getElementById("PhoneNumber").value;
  var passengerType = document.getElementById("passengerType").value;

  var formElement = document.getElementById("metroForm");
  var cardContainer = document.getElementById("cardContainer");

  // Hide the form
  formElement.style.display = "none";

  // Create a new card element
  var card = document.createElement("div");
  card.className = "card new-card";
  
  var cardContent = document.createElement("div");
  cardContent.className = "card-content";
  
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
}
