document.getElementById('search-button').addEventListener('click', function() {
    var selectBox = document.getElementById('select-box-1');
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    window.location.href = 'shops.html?#' + selectedValue;
});

