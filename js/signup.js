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
  document.getElementById('signin').addEventListener('click',(e)=>{
    e.preventDefault()
  const email=document.getElementById('email').value;
  const password=document.getElementById('password').value;
  auth.createUserWithEmailAndPassword(email, password)
  .then((userCredential) => {
    // Signed in
    const user = userCredential.user;
    console.log("User created:", user);

    // Redirect to home.php after successful sign-up
    window.location.href = "home.php";
  })
  .catch((error) => {
    const errorCode = error.code;
    const errorMessage = error.message;
    console.error("Error:", errorCode, errorMessage);
    alert("Error:"+ errorCode + errorMessage);
  });
});