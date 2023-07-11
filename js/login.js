const firebaseConfig = {
    apiKey: "AIzaSyDjBgmzmlwmso2pJ6IUSaROuAoRKLmynpw",
    authDomain: "metro-c2e76.firebaseapp.com",
    databaseURL: "https://metro-c2e76-default-rtdb.firebaseio.com",
    projectId: "metro-c2e76",
    storageBucket: "metro-c2e76.appspot.com",
    messagingSenderId: "443513878126",
    appId: "1:443513878126:web:af44ba5a20e97a0654587f",
    measurementId: "G-PF5GKDP950"
  };
  firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();
  //email login
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginbtn').addEventListener('click', function(e) {
      e.preventDefault();
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      console.log(email);
      console.log(password);
      auth.signInWithEmailAndPassword(email, password)
        .then(function(userCredentials) {
          var user = userCredentials.user;
          if (user.email === 'admin@example.com' && password === 'adminpassword') {
            // Redirect to admin page
            window.location.href = '/admin/admin_home.html';
          } else {
            alert("Login successful");
          }
        })
        .catch(function(error) {
          var errorMessage = error.message;
          alert(errorMessage);
        });
    });
  });
  var loginButton = document.getElementById("login");
  var profileIcon = document.getElementById("profileIcon");
  const signoutButton = document.getElementById('signout');
  function signout() {
    console.log("Signout clicked");
    firebase.auth().signOut()
      .then(() => {
        // Sign-out successful.
        console.log("User signed out");
     
        // Redirect or perform additional tasks after sign-out if needed.
      })
      .catch((error) => {
        // An error happened during sign-out.
        console.log(error);
      });
  }
  // Add event listener to the signout button
  signoutButton.addEventListener('click', signout);
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      var email = user.email;
      var users = document.getElementById('user');
      var text = document.createTextNode(email);
      // users.appendChild(text);
      console.log(user);
      // Hide the login button and display the profile icon
      loginButton.style.display = "none";
      profileIcon.style.display = "inline-block"; // or "block", depending on the desired display style
      signoutButton.style.display = "inline-block";
    } else {
      // User is not signed in
      // Show the login button and hide the profile icon
      loginButton.style.display = "inline-block"; // or "block", depending on the desired display style
      profileIcon.style.display = "none";
      signoutButton.style.display = "none";
    }
  });
  
    // Signout 
