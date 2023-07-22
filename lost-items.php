<!DOCTYPE html>
<html>

<head>
  <title>Lost and Found Items</title>
  <link rel="stylesheet" type="text/css" href="css/lost-found.css">
  <link rel="stylesheet" href="css/nav.css">
    <!-- <link href="css/home.css" rel="stylesheet" href=""> -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>

<section class="full-navbar ">

<nav class="top">
  <div class="top-in">

    <img class=" pattern col-4" src="images/header_pattern_1.png" alt="">
    
  </div>
</nav>

<nav class="bottom ">
  <div class="row">

    <div class="bottom-left col-5">
      <img class="logo" src="images/Koch_Metro_Logo_1.png" alt="kochi-metro-logo">
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

  <?php

      include 'php/config.php';

      // items from the database
      $sql = "SELECT * FROM found";
      $result = $conn->query($sql);

      $lostItems = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $lostItems[] = $row;
          }
      }

      $lostItems = array_reverse($lostItems);
  ?>


  <h1 class="heading">Lost and Found Items</h1>
  <table class="lost-found-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Date of Found</th>
            <th>Location Found</th>
            <th>Item Description</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <?php foreach ($lostItems as $item): ?>
            <tr>
                <td><?php echo $item["id"]; ?></td>
                <td><?php 
                $formattedDate = date("d-m-Y", strtotime($item["date"]));
                echo $formattedDate;
                ?></td>
                <td><?php echo $item["location"]; ?></td>
                <td><?php echo $item["item"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
            </tr>
      <?php endforeach; ?>
  </table>
  <br><br>
</body>

</html>
