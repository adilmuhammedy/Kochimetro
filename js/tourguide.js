function search() {
  let input = document.querySelector('.search-bar');
  
  let cardsCont = document.querySelectorAll('.cardcontainer');
  cardsCont.forEach((card) => {
      let cardInner = card.querySelector('.card');
      if (cardInner.querySelector('.card-title').innerText.toLowerCase().includes(input.value.toLowerCase())) {
          card.style.display = "block";
      } else {
          card.style.display = "none";
      }
  });
}

document.addEventListener("DOMContentLoaded", function() {
    // Get the card container element
    var cardContainer = document.getElementById("card-container");
  
    // Get all the card elements
    var cards = cardContainer.getElementsByClassName("cardcontainer");
  
    // Convert the HTMLCollection to an array for easier manipulation
    var cardsArray = Array.from(cards);
  
    // Sort the cards based on the card title (location name)
    cardsArray.sort(function(a, b) {
      var titleA = a.querySelector(".card-title").textContent.toLowerCase();
      var titleB = b.querySelector(".card-title").textContent.toLowerCase();
      return titleA.localeCompare(titleB);
    });
  
    // Clear the current card order in the container
    cardContainer.innerHTML = "";
  
    // Append the sorted cards back to the container
    cardsArray.forEach(function(card) {
      cardContainer.appendChild(card);
    });
  });
  