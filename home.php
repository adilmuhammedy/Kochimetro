<?php
      include 'php/config.php';

      // Function to fetch data from the table
      function fetchDataFromTable($conn) {
        $sql = "SELECT * FROM notification";
        $result = $conn->query($sql);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
      }

      // Fetch initial data
      $data = fetchDataFromTable($conn);

      // Periodically fetch and update the data
      function updateData() {
        global $conn, $data;
        $data = fetchDataFromTable($conn);
      }

      // Set the interval for updating the data (in seconds)
      $updateInterval = 60; // Update every minute

      // Check if an update is needed
      $lastUpdateTime = isset($_SESSION['lastUpdateTime']) ? $_SESSION['lastUpdateTime'] : 0;
      $currentTimestamp = time();

      if ($currentTimestamp - $lastUpdateTime > $updateInterval) {
        updateData();
        $_SESSION['lastUpdateTime'] = $currentTimestamp;
      }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metro</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include FontAwesome icons CSS file -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- select2 dropdown  -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />

  <!-- footer  -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>


  <link href="css/home.css" rel="stylesheet" href="">
  <!-- <link href="script/check.css" rel="stylesheet" href=""> -->

</head>

<body>
  <section class="full-navbar ">

    <nav class="top">
      <div class="top-in">

        <img class=" col-5 pattern" src="images/header_pattern_1.png" alt="">
      </div>
    </nav>
    <nav class="bottom ">
      <div class="row">
        <div class="bottom-left col-5">
          <img class="logo" src="images/Koch_Metro_Logo_1.png" alt="kochi-metro-logo">
          <p class="metro-name">KOCHI METRO</p>
        </div>
        <div class="bottom-right col-6">
          <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="http://localhost:3000/">Water Metro</a></li>
            <li><a href="aboutus.html">About us</a></li>
          </ul>
          <!-- <button class="button1" type="button">Profile</button> -->
          <button class="button2" type="button" id="login" onclick="window.location.href='login.html'">Login</button>
          <img src="/images/avatarimg.png" id="profileIcon" class="avatar" style="display: none; cursor: pointer;"><!-- User profile icon --></img>
          <button class="button2" type="button" id="signout">Signout</button>
          <script type="text/javascript" src="js/login.js"></script>
        </div>
      </div>
    </nav>
  </section>

  </div>

  <div class="container-fluid">
    <div class="row outer custom-row">
      <div class="col-4 inner custom-col">

        <div class="form-container">
          <form action="#" id="formm">

            <div class="form-group">
              <div class="heading1">
                <h2 id="head1">PLAN YOUR JOURNEY</h2>
              </div>
              <br>
              <label for="select1">From :</label>
              <select id="from" class="select2" style="width: 334.3px;">
                <option value="" class="pholder" disabled selected hidden>Click to select</option>
                <option value="Aluva">Aluva</option>
                <option value="Pulinchodu">Pulinchodu</option>
                <option value="Companypady">Companypady</option>
                <option value="Ambattukavu">Ambattukavu</option>
                <option value="Muttom">Muttom</option>
                <option value="Kalamassery Town">Kalamassery Town</option>
                <option value="Cochin University">Cochin University</option>
                <option value="Pathadipalam">Pathadipalam</option>
                <option value="Edapally">Edapally</option>
                <option value="Changampuzha Park">Changampuzha Park</option>
                <option value="Palarivattom">Palarivattom</option>
                <option value="JLN Stadium">JLN Stadium</option>
                <option value="Kaloor">Kaloor</option>
                <option value="Town Hall">Town Hall</option>
                <option value="M.G Road">M.G Road</option>
                <option value="Maharaja's College">Maharaja's College</option>
                <option value="Kadavanthra">Kadavanthra</option>
                <option value="Elamkulam">Elamkulam</option>
                <option value="Vyttila">Vyttila</option>
                <option value="Thykkoodam">Thykkoodam</option>
                <option value="Petta">Petta</option>
                <option value="Vadakkekotta">Vadakkekotta</option>
                <option value="SN Junction">SN Junction</option>
              </select>
            </div>

            <div class="form-group" id="div1">
              <label for="select2">To :</label>
              <select id="to" class="select2" style="width: 334.3px;">
                <option value="" class="pholder" disabled selected hidden>Click to select</option>
                <option value="Aluva">Aluva</option>
                <option value="Pulinchodu">Pulinchodu</option>
                <option value="Companypady">Companypady</option>
                <option value="Ambattukavu">Ambattukavu</option>
                <option value="Muttom">Muttom</option>
                <option value="Kalamassery Town">Kalamassery Town</option>
                <option value="Cochin University">Cochin University</option>
                <option value="Pathadipalam">Pathadipalam</option>
                <option value="Edapally">Edapally</option>
                <option value="Changampuzha Park">Changampuzha Park</option>
                <option value="Palarivattom">Palarivattom</option>
                <option value="JLN Stadium">JLN Stadium</option>
                <option value="Kaloor">Kaloor</option>
                <option value="Town Hall">Town Hall</option>
                <option value="M.G Road">M.G Road</option>
                <option value="Maharaja's College">Maharaja's College</option>
                <option value="Kadavanthra">Kadavanthra</option>
                <option value="Elamkulam">Elamkulam</option>
                <option value="Vyttila">Vyttila</option>
                <option value="Thykkoodam">Thykkoodam</option>
                <option value="Petta">Petta</option>
                <option value="Vadakkekotta">Vadakkekotta</option>
                <option value="SN Junction">SN Junction</option>
              </select>
            </div>



            <div class="form-group form-grp">
              <div class="p1" id="div2">
                <label for="select3">Time slot :</label>
                <select id="time" class="select2" style="width: 160.48px;">
                  <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to
                    select</option>
                  <option value="6:00-8:00">6:00 am - 8:00 am</option>
                  <option value="8:00-21:00">8:00 am -9:00 pm</option>
                  <option value="21:00-23:00">9:00 pm - 11:00 pm</option>
                </select>
              </div>
              <div class="p1">
                <label for="select5">Ticket type :</label>
                <select id="ttype" class="select2" style="width: 160.48px;">
                  <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to
                    select</option>
                  <option value="One-way">One-way</option>
                  <option value="Two-way">Two-way</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>No of Passengers :</label>
              <input id="nop" class="i" type="number" id="nop" />
            </div>
            <br>

            <div class="buttons">
              <button type="reset" id="my-reset-button" onclick="resetSelect2()">Reset</button>
              <button type="submit" class="submit" id="submit">Book Ticket</button>
            </div>
            <br>
          </form>



          <script>
  // Submit form data to the backend
document.getElementById('formm').addEventListener('submit', async (event) => {
  event.preventDefault();

  // Get form data
  const form = event.target;
  const from = formm.from.value;
  const to = formm.to.value;
  const timeSlot = formm.time.value;
  const ticketType = formm.ttype.value;
  const passengers = formm.nop.value;

  if (from == "" || to == "" || timeSlot == "" || ticketType == "" || passengers == "") {
    alert("Please fill all the fields");
    return;
  } else if (from == to) {
    alert("From and To cannot be the same");
    return;
  } else if (passengers <= 0) {
    alert("Number of passengers cannot be less than 1");
    return;
  } else {
    localStorage.setItem("from", from);
    localStorage.setItem("to", to);
    localStorage.setItem("timeSlot", timeSlot);
    localStorage.setItem("ticketType", ticketType);
    localStorage.setItem("passengers", passengers);

    // Create the request body
    const requestBody = {
      from,
      to,
      timeSlot,
      ticketType,
      passengers,
    };

    try {
      // Send a POST request to the backend
      const response = await fetch('http://localhost:8080/submit-form', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestBody),
      });

      // Handle the response
      if (response.ok) {
        const responseData = await response.json();
        console.log("responseData and connection successful", responseData);
        const redirectUrl = responseData.redirectUrl;
        // Redirect to the confirmation page
        window.location.href = redirectUrl;
      } else {
        console.error('Form submission failed.');
      }
    } catch (error) {
      console.error('An error occurred:', error);
    }
  }
});
          </script>
          <!--backend-->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        </div>
      </div>
      <div class="col-4 custom-col">
        <div class="search-container">
          <h2 class="search-heading">Know your station</h2>
          <div class="search-input-container">
            <div class="s-box">
              <select id="select-box-1" class="select2" style="width: 250.88px;">
                <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to
                  select</option>
                <option value="1">Aluva</option>
                <option value="2">Cochin University</option>
                <option value="3">Edapally</option>
                <option value="4">Town Hall</option>
                <option value="5">MG Road</optio>
              </select>
            </div>
            <button class="search-icon" id="search-button"><i class="fa fa-search"></i></button>
            <!-- <button class="search-button"></button> -->
          </div>
        </div>
        <br>
        <div class="btn-container">
          <div class="row">
            <div class="col-md-6">
              <button class="btn-rect" onclick="openFareCalculator()">
                <div class="btn-inner">
                  <div class="btn-divider"></div>
                  <div class="btn-name">Fare Calculator</div>
                </div>
              </button>
            </div>
            <div class="col-md-6">
              <button class="btn-rect" onclick="window.location='lost-base.html'">
                <div class="btn-inner">
                  <div class="btn-divider"></div>
                  <div class="btn-name">Lost and Found</div>
                </div>
              </button></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <button class="btn-rect" onclick="window.location='tourguide.html'">
                <div class="btn-inner">
                  <div class="btn-divider"></div>
                  <div class="btn-name">Tour Guide</div>
                </div>
              </button>
            </div>
            <div class="col-md-6">
              <button class="btn-rect" onclick="window.location='card.html'">
                <div class="btn-inner">
                  <div class="btn-divider"></div>
                  <div class="btn-name">Metro Card</div>
                </div>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <button class="btn-rect" onclick="window.location='php/time.php'">
                <div class="btn-inner">
                  <div class="btn-divider"></div>
                  <div class="btn-name">Metro timer</div>
                </div>
              </button>
            </div>
            <div class="col-md-6">
              <button class="btn-rect" onclick="window.location='router.html'">
                <div class="btn-inner">
                  <div class="btn-divider"></div>
                  <div class="btn-name">Route Map</div>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4 custom-col">
        <div class="table-wrapper">
          <table class="notification-table scroll">
            <thead>
              <tr>
                <th colspan="2">News and Alerts</th>
              </tr>
            </thead>
            <tbody class="table-body">

                <?php for ($i = count($data) - 1; $i >= 0; $i--) { ?>

                  <tr>
                    <td class="notification-cell"><i class="fas fa-bell"></i></td>
                    <td class="message-cell"><?php echo $data[$i]['message']; ?></td>
                  </tr>

                <?php } ?>
               
                </tbody> 
          </table>
        </div>

      </div>
    </div>
  </div>

  <!-- footer  -->
  <div class="footer-dark">
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3 item">
            <h3>Services</h3>
            <ul>
              <li><a href="#">Web design</a></li>
              <li><a href="#">Development</a></li>
              <li><a href="#">Hosting</a></li>
            </ul>
          </div>
          <div class="col-sm-6 col-md-3 item">
            <h3>About</h3>
            <ul>
              <li><a href="#">Company</a></li>
              <li><a href="#">Team</a></li>
              <li><a href="#">Careers</a></li>
            </ul>
          </div>
          <div class="col-md-6 item text">
            <h3>Company Name</h3>
            <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus
              elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
          </div>
          <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i
                class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a
              href="#"><i class="icon ion-social-instagram"></i></a></div>
        </div>
        <p class="copyright">Company Name © 2018</p>
      </div>
    </footer>
  </div>

  <div id="fareCalculator"
    style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background-color:rgba(0,0,0,0.5); z-index:9999;">
    <div class="container" style="margin:auto; margin-top:100px; background-color:#fff; padding:20px; width:600px;">
      <h1>FARE CALCULATOR</h1>
      <form id="fareForm">
        <label for="from">From:</label>
        <select id="cfrom">
          <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to select
          </option>
          <option value="1">Aluva</option>
          <option value="2">Pulinchodu</option>
          <option value="3">Companypady</option>
          <option value="4">Ambattukavu</option>
          <option value="5">Muttom</option>
          <option value="6">Kalamassery Twon</option>
          <option value="7">Cochin University</option>
          <option value="8">Pathadipalam</option>
          <option value="9">Edapally</option>
          <option value="10">Changampuzha Park</option>
          <option value="11">Palarivattom</option>
          <option value="12">JLN Stadium</option>
          <option value="13">Kaloor</option>
          <option value="14">Town Hall</option>
          <option value="15">M.G Road</option>
          <option value="16">Maharaja's College</option>
          <option value="17">Ernakulam South</option>
          <option value="18">Kadavanthra</option>
          <option value="19">Elamkulam</option>
          <option value="20">Vyttila</option>
          <option value="21">Thykkoodam</option>
          <option value="22">Petta</option>
          <option value="23">Vadakkekotta</option>
          <option value="24">SN Junction</option>
        </select>
        <label for="to">To:</label>
        <select id="cto">
          <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to select
          </option>
          <option value="1">Aluva</option>
          <option value="2">Pulinchodu</option>
          <option value="3">Companypady</option>
          <option value="4">Ambattukavu</option>
          <option value="5">Muttom</option>
          <option value="6">Kalamassery Twon</option>
          <option value="7">Cochin University</option>
          <option value="8">Pathadipalam</option>
          <option value="9">Edapally</option>
          <option value="10">Changampuzha Park</option>
          <option value="11">Palarivattom</option>
          <option value="12">JLN Stadium</option>
          <option value="13">Kaloor</option>
          <option value="14">Town Hall</option>
          <option value="15">M.G Road</option>
          <option value="16">Maharaja's College</option>
          <option value="17">Ernakulam South</option>
          <option value="18">Kadavanthra</option>
          <option value="19">Elamkulam</option>
          <option value="20">Vyttila</option>
          <option value="21">Thykkoodam</option>
          <option value="22">Petta</option>
          <option value="23">Vadakkekotta</option>
          <option value="24">SN Junction</option>
        </select><br>
        <label for="tickets">Number of tickets:</label>
        <input type="integer" id="tickets" value="1"><br>
        <div>
          <label for="ticket-type">Ticket type:</label>
          <select id="ticket-type">
            <option value="one-way">One-way</option>
            <option value="two-way">Two-way</option>
          </select>

          <label for="Time">Time-slot</label>
          <select id="time-slot">
            <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to
              select</option>
            <option value="mrng">6:00 am-8:00 am</option>
            <option value="day">8:00 am-9:00 pm</option>
            <option value="nyt">9:00 pm-11:00 pm</option>
          </select>
        </div>
        <button type="button" onclick="calculator()">Calculate Fare</button>
        <div id="result"></div>
      </form>
      <button onclick="closeFareCalculator()" style="margin-top:10px;">Close</button>
    </div>
  </div>


  <script src="js/farecalculator.js"></script>
  <script src="shops.js"></script>

  <!--AFTER FARE CALCULATION-->

  <div id="fareDetails"
    style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background-color:rgba(0,0,0,0.5); z-index:9999;">
    <div class="container" style="margin:auto; margin-top:200px; background-color:#fff; padding:50px; width:600px;">
      <h1>FARE DETAILS</h1>
      <div style="padding:50px;">
        <h4 id="details" style="left:100px;"></h4>
      </div>
      <button onclick="closeFareDetails()" style="margin-top:10px; text-align: center;">Close</button>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

  <script src="js/ticket_details.js"></script>
</body>

</html>