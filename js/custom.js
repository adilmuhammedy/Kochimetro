// function myFunction() {
//     document.getElementById("myDropdown").classList.toggle("show");
//   }
  
//   function filterFunction() {
//     var input, filter, ul, li, a, i;
//     input = document.getElementById("myInput");
//     filter = input.value.toUpperCase();
//     div = document.getElementById("myDropdown");
//     a = div.getElementsByTagName("a");
//     for (i = 0; i < a.length; i++) {
//       txtValue = a[i].textContent || a[i].innerText;
//       if (txtValue.toUpperCase().indexOf(filter) > -1) {
//         a[i].style.display = "";
//       } else {
//         a[i].style.display = "none";
//       }
//     }
//   }
  

// reset form 
$(document).ready(function() {
  // Initialize Select2
  $('.select2').select2();

  // Reset Select2 to first value on button click
  $('#my-reset-button').click(function() {
    $('.select2').val($('#my-select option:first').val()).trigger('change.select2');
  });
});


// Know station 
const searchInput = document.querySelector('.search-input');
      const searchDropdown = document.querySelector('.search-dropdown');

      searchInput.addEventListener('click', () => {
        searchDropdown.classList.toggle('active');
      });


// dropdown 

$(document).ready(function() {
  // Initialize Select2 on each select element
  $('.select2').each(function() {
    $(this).select2({
      dropdownAutoWidth: true
    });
  });

  // Set custom width for the first dropdown
  $('#div1 .select2').first().css('width', '334.3px');

  // Set custom width for the second dropdown
  $('#div2 .select2').first().css('width', '160.48px');
});
