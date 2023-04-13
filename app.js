


console.log("hai user");

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


// google auth
const provider = new firebase.auth().GoogleAuthProvider();
document.getElementById('googlesign').addEventListener('click',(e)=>{
  e.preventDefault()

firebase.auth().signInWithPopup(auth, provider)
  .then((result) => {
    // This gives you a Google Access Token. You can use it to access the Google API.
    const credential = GoogleAuthProvider.credentialFromResult(result);
    const token = credential.accessToken;
    // The signed-in user info.
    const user = result.user;
    // IdP data available using getAdditionalUserInfo(result)
    // ...
  }).catch((error) => {
    // Handle Errors here.
    const errorCode = error.code;
    const errorMessage = error.message;
    // The email of the user's account used.
    const email = error.customData.email;
    // The AuthCredential type that was used.
    const credential = GoogleAuthProvider.credentialFromError(error);
    // ...
  });
})
