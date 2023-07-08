document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.querySelector('.hamburger');
  const menu = document.querySelector('.options');

  hamburger.addEventListener('click', function () {
    menu.classList.toggle('show-menu');
  });
});