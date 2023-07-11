<!DOCTYPE html>
<html>
<head>
  <title>Train Schedule</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <link rel="stylesheet" href="../css/Time.css">
  <link rel="stylesheet" href="../css/nav.css">

  <script src="../js/time.js"></script>

   <!-- bootstrap5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</head>
<body>

    <!-- Navbar Start -->
    <section class="full-navbar ">

        <nav class="top">
          <div class="top-in">
    
            <img class=" pattern col-4" src="../images/header_pattern_1.png" alt="">
            
          </div>
        </nav>
    
        <nav class="bottom ">
          <div class="row">
    
            <div class="bottom-left col-5">
              <img class="logo" src="../images/Koch_Metro_Logo_1.png" alt="kochi-metro-logo">
              <p class="metro-name">KOCHI METRO</p>
            </div>
            <div class="bottom-right col-6">
              <ul class="options">
                <li><a href="home.html">Home</a></li>
                <li><a href="#">Water Metro</a></li>
                <li><a href="#">About us</a></li>
              </ul>
              <!-- <button class="button1" type="button">Profile</button> -->
              <!-- <button class="button2" type="button" id="login" onclick="window.location.href='login.html'">Login</button> -->
              <button id="profileIcon" class="avatar"><!-- User profile icon --></button>
              <!-- <button class="button2" type="button" id="signout" onclick='sinout()'>Signout</button> -->
              <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    
              <script type="text/javascript" src="js/login.js"></script>
              <script type="text/javascript">
                function sinout() {
                    console.log("Signout clicked");
                    firebase.auth().signOut()
                      .then(() => {
                        // Sign-out successful.s
                        console.log("User signed out");
                        alert("User signed out")
                        // Redirect or perform additional tasks after sign-out if needed
                      })
                      .catch((error) => {
                        // An error happened during sign-out.
                        console.log(error);
                      });
                    }
              </script>

              <!--Hamburger-->
              <div class="hamburger">
                <input type="checkbox" id="toggle-hamburger" class="toggle-input">
                <label for="toggle-hamburger"></label>
                <span></span>
                <span></span>
                <span></span>
              </div>
    
            </div>
          </div>
        </nav>

      </section>
  
    <!-- Navbar Ends-->

    <div class="time-main">
        <div class="time-center">

            <h1>TRAIN TIMER </h1><br>
  
            <form method="post" action="">
                <label for="station">Select your station:</label>
                <select id="station" name="station">
                <option value="Aluva">Aluva</option>
                <option value="Muttom">Muttom</option>
                <option value="Cusat">Cusat</option>
                <option value="Edappally">Edappally</option>
                <option value="Town_Hall">Town Hall</option>
                <option value="Ernakulam_South">Ernakulam South</option>
                <option value="SN_Junction">SN Junction</option>
                </select><br><br>
                <div>
                    <button id="open-time" type="submit" name="submit">Submit</button>
                </div>              
            </form>

        </div>
    </div>



    <dialog id="time-modal" class="lost-item-moda">
            <p>Towards SN Junction : </p>
            <div id="countdown"></div>
            <p>Towards Aluva : </p>
            <div id="countdown2"></div>
            <div class="nav-btn">
                <button type="close" id="close-modal">Close</button>
            </div>
        </form>
    </dialog>
  
  
  <script>
    // Function to start the countdown
    function startCountdown(duration, display) {
      var timer = duration;
  
      var countdownInterval = setInterval(function () {
        var minutes = parseInt(timer / 60, 10);
        var seconds = parseInt(timer % 60, 10);
  
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
  
        display.textContent = "Next train in " + minutes + ":" + seconds + " minutes";
  
        if (--timer < 0) {
          clearInterval(countdownInterval);
          // Restart countdown when it reaches 00:00
          startCountdown(480, display); // 480 seconds = 8 minutes (starting from 08:00)
        }
      }, 1000);
    }
  
    // Calculate the countdown duration and start the countdown
    function calculateCountdownTime(firstTime, lastTime, check) {

      if(check===0){
        var display = document.getElementById("countdown");
      }else{
        var display = document.getElementById("countdown2");
      }

      var currentTime = new Date();
      var currentSeconds = currentTime.getHours() * 3600 + currentTime.getMinutes() * 60 + currentTime.getSeconds();
    //   console.log(currentSeconds);
      var firstTimeSeconds = parseInt(firstTime.substr(0, 2)) * 3600 + parseInt(firstTime.substr(3, 2)) * 60;
    //   console.log(firstTimeSeconds);
      var lastTimeSeconds = parseInt(lastTime.substr(0, 2)) * 3600 + parseInt(lastTime.substr(3, 2)) * 60;

      if (currentSeconds < firstTimeSeconds) {
        $(display).text("Currently no train is running. The first train from this station starts at " + firstTime);
      } else if (currentSeconds > lastTimeSeconds) {
        $(display).text("Currently no train is running.The first train from this station starts at " + firstTime);
      } else {
        var remainderSeconds = (currentSeconds - firstTimeSeconds) % 480;
        var remainderSeconds = 480 - remainderSeconds;
        // var display = document.getElementById("countdown");

        startCountdown(remainderSeconds, display);
      }
    }

  
    $(document).ready(function() {
      $("form").submit(function(e) {
        e.preventDefault();
  
        var station = $("#station").val();
  
        // Send AJAX request to get the first and last time for the selected station
        $.ajax({
          type: "POST",
          url: "get_times.php",
          data: { station: station },
          success: function(result) {
            if (result === "") {
              alert("Invalid station selection");
            } else {
              var times = JSON.parse(result);
              var firstTime = times.firstTime;
              var lastTime = times.lastTime;
              var toAluva = times.toAluva;
              var lastToAluva = times.lastToAluva;

              console.log(firstTime);
              console.log(lastTime);
              console.log(toAluva);
              console.log(lastToAluva);

              if(firstTime==null){
                setTimeout(function() {
                  $("#countdown").text("This is the selected station.");
                },1000); 
              }else{
                calculateCountdownTime(firstTime, lastTime,0);
              }

              if(toAluva==null){
                setTimeout(function() {
                  $("#countdown2").text("This is the selected station.");
                },1000);              
              }else{
                calculateCountdownTime(toAluva, lastToAluva,1);
              }
              
            }
          }
        });
      });
    });
  </script>
</body>
</html>