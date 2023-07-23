<?php
include 'config.php';

//Add
// if (isset($_POST['add'])) {
//     $sql="INSERT INTO `notification` (NULL, 'This is message2 of metro for testing purpose.', current_timestamp())";
// }

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        // Get the submitted value from the input field
        $value = $_POST['inputValue'];

        if (!empty($value)) {
            // Insert the value into the table
            $sql = "INSERT INTO `notification` VALUES (NULL,'$value', current_timestamp())";

            if ($conn->query($sql) === TRUE) {
                // echo "Value added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Please enter a value.');</script>";
        }
    }
}

// Handle the delete operation
if (isset($_POST['delete'])) {
    // Get the selected row IDs
    $selectedRows = $_POST['selectedRows'];

    // Delete the selected rows
    foreach ($selectedRows as $rowId) {
        $sql = "DELETE FROM notification WHERE id = $rowId";
        $conn->query($sql);
    }
}

// Fetch data from the table
$sql = "SELECT * FROM notification";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification update</title>

    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/notification.css">

</head>
<body>

<section class="full-navbar ">

<nav class="top">
  <div class="top-in">

    <img class=" pattern col-4" src="../css/header_pattern_1.png" alt="">
    
  </div>
</nav>

<nav class="bottom ">
  <div class="row">

    <div class="bottom-left col-5">
      <img class="logo" src="../css/Koch_Metro_Logo_1.png" alt="kochi-metro-logo">
      <p class="metro-name">KOCHI METRO</p>
    </div>
    <div class="bottom-right col-6">
      <ul class="options">
        <li><a href="../admin_home.html">Home</a></li>
        <!-- <li><a href="#">Water Metro</a></li> -->
        <!-- <li><a href="#">About us</a></li> -->
      </ul>
      <!-- <button class="button1" type="button">Profile</button> -->
      <!-- <button class="button2" type="button" id="login" onclick="window.location.href='login.html'">Login</button> -->
      <!-- <button id="profileIcon" class="avatar">User profile icon</button> -->
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

    <div class="container">

        <form method="POST" action="">
        <table class="lost-found-table">
            <tr><th class="noti-head" colspan="4">NOTIFICATIONS/ALERTS</th></tr>
            <tr>
                <th>Select</th>
                <th>Id</th>
                <th>Mesaage</th>
                <th>Date and Time</th>
                <!-- Add more columns here as needed -->
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="selectedRows[]" value="<?php echo $row['id']; ?>"></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['dateTime']; ?></td>
                    <!-- Add more columns here as needed -->
                </tr>
            <?php } ?>
        </table>

        <br>
        <button type="submit" name="delete" id="delete1" class="button-container">Delete</button>
        <br>
        </form>
        <button id="open-notification" class="button-container">Add new notification</button>
        <br><br>

        <dialog id="notification-modal">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="noti-content">
                        <label for="inputValue">New Notification/Alert :</label>
                        <textarea name="inputValue" id="inputValue" cols="30" rows="9" maxlength="511" minlength="10" placeholder="Enter the message here..."></textarea>
                    </div>

                    <div class="noti-button">
                        <button name="close" id="close-n">Close</button>
                        <button type="submit" name="submit" id="add-content">Add</button>
                           
                    </div>
                                 
                </form>
        </dialog>

    </div>

    

    <script>
    // Show the delete button when at least one checkbox is checked
    const checkboxes = document.querySelectorAll('input[name="selectedRows[]"]');
    const deleteButton = document.querySelector('button[name="delete"]');

    deleteButton.style.display = 'none'; // Hide the delete button by default

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            deleteButton.style.display = isAnyCheckboxChecked() ? 'block' : 'none';
        });
    });

    function isAnyCheckboxChecked() {
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                return true;
            }
        }
        return false;
    }
    </script>

    <script src="../js/notification.js"></script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>