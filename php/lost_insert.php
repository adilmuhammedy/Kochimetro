<?php
    include 'config.php';

    // Retrieve the form data
    $item = $_POST['item'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO items (item, location, quantity, date_added) VALUES ('$item', '$location', $quantity, CURDATE())";
    $sql = "INSERT INTO `found` (`id`, `date`, `location`, `item`, `quantity`, `claimed`, `name`, `address`, `id_type`, `id_number`, `phone`) VALUES (NULL, CURRENT_DATE(), '$location', '$item', $quantity, '0', NULL, NULL, NULL, NULL, NULL)";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) { 
        //Success
    } else {
    echo "Error inserting record: " . $conn->error;
    }

    header("Location: lost_found.php");
    exit;

    // Close the database connection
    $conn->close();
?>