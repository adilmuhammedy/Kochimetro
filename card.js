function applyMetroCard() {
    var name = document.getElementById('name').value;
    var dob = document.getElementById('dob').value;
    var passengerType = document.getElementById('passengerType').value;
    
    document.getElementById('cardName').innerText = 'Name: ' + name;
    document.getElementById('cardDob').innerText = 'Date of Birth: ' + dob;
    document.getElementById('cardType').innerText = 'Passenger Type: ' + passengerType;
    
    document.getElementById('card').classList.remove('hidden');
  }
  
  
  
  