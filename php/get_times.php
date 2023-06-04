<?php
// Establish a connection to your database
include 'config.php';

// Get the first and last time from the station_time table
$station = $_POST['station'];

$query = "SELECT first_time, last_time, toAluva, lastToAluva FROM station_time WHERE station = '$station'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $firstTime = $row['first_time'];
  $lastTime = $row['last_time'];
  $toAluva = $row['toAluva'];
  $lastToAluva = $row['lastToAluva'];
  
  // Prepare the response as JSON
  $response = array(
    'firstTime' => $firstTime,
    'lastTime' => $lastTime,
    'toAluva' => $toAluva,
    'lastToAluva' => $lastToAluva
  );
  
  echo json_encode($response);
} else {
  echo ""; // Invalid station selection
}

mysqli_close($conn);
?>