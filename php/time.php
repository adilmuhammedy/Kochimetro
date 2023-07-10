<!DOCTYPE html>
<html>
<head>
  <title>Train Schedule</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <h1>Train Schedule</h1>
  
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
    </select>
    <button class="time-submit" type="submit" name="submit">Submit</button>
  </form>

  <p>Towards SN Junction : </p>
  <div id="countdown"></div>
  <p>Towards Aluva : </p>
  <div id="countdown2"></div>
  
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