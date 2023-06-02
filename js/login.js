

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
  document.getElementById('login').addEventListener('click',(e)=>{
    e.preventDefault()
    var email=document.getElementById('email').value;
    var password=document.getElementById('password').value;
    console.log(email);
    console.log(password);
    firebase.auth().signInWithEmailAndPassword(email,password)
    .then((userCredentials)=>{
      var user=userCredentials.user;
      alert(user.email);
      console.log(user.email);
      alert("login successfull")
    })
    .catch((error)=>{
      var errorMessage=error.message;
      alert(errorMessage);
    })
  firebase.auth().onAuthStateChanged(function(user){
    if(user){
      var email=user.email;
      var users=document.getElementById('user');
      var text=document.createTextNode(email);
      //users.appendChild(text);
      console.log(user);
    }else{
    }
  })
})
const provider = new firebase.auth.GoogleAuthProvider();
document.getElementById('googlesign').addEventListener('click',(e)=>{
  e.preventDefault();
  const auth = firebase.auth();
  auth.signInWithPopup(provider)
    .then((result) => {
      // Handle successful authenticatison
      const user = result.user;
      console.log(user);
    })
    .catch((error) => {
      // Handle authentication error
      const errorCode = error.code;
      const errorMessage = error.message;
      console.log(errorMessage);
    });
})
