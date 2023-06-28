
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
          alert(user.email);
          console.log(user.email);
          alert("Login successful");
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
     
    } else {
      // User is not signed in
      // Show the login button and hide the profile icon
      loginButton.style.display = "inline-block"; // or "block", depending on the desired display style
      profileIcon.style.display = "none";
    }
  });

  const provider = new firebase.auth.GoogleAuthProvider();
 
  document.getElementById('googlesignup').addEventListener('click', (e) => {
    e.preventDefault();
  firebase.auth().signInWithPopup(provider)
    .then((result) => {
      // Handle successful authentication
      const user = result.user;
      console.log(user);
      // Hide the login button and display the profile icon
      window.location.href = "./home.html";
     loginButton.style.display = "none";
      profileIcon.style.display = "inline-block"; // or "block", depending on the desired display style
     
    })
    .catch((error) => {
      // Handle authentication error
      const errorCode = error.code;
      const errorMessage = error.message;
      console.log(errorMessage);
    });
  });
    // Signout
 
 
    
