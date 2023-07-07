// function search() {
//   let input = document.querySelector('.search-bar');
  
//   let cardsCont = document.querySelectorAll('.cardcontainer');
//   cardsCont.forEach((card) => {
//       let cardInner = card.querySelector('.card');
//       if (cardInner.querySelector('.card-title').innerText.toLowerCase().includes(input.value.toLowerCase())) {
//           card.style.display = "block";
//       } else {
//           card.style.display = "none";
//       }
//   });
// }

function search() {
  var searchInput = document.querySelector('.search-bar').value.toLowerCase();
  var cards = document.querySelectorAll('.cardcontainer');

  cards.forEach(function(card) {
    var title = card.querySelector('.card-title').textContent.toLowerCase();
    if (title.includes(searchInput)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}


document.addEventListener("DOMContentLoaded", function() {
    var cardContainer = document.getElementById("card-container");
    var cards = cardContainer.getElementsByClassName("cardcontainer");  
    var cardsArray = Array.from(cards);
  
    cardsArray.sort(function(a, b) {
      var titleA = a.querySelector(".card-title").textContent.toLowerCase();
      var titleB = b.querySelector(".card-title").textContent.toLowerCase();
      return titleA.localeCompare(titleB);
    });
  
    cardContainer.innerHTML = "";
  
    cardsArray.forEach(function(card) {
      cardContainer.appendChild(card);
    });
  });
  