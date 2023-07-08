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

    <link rel="stylesheet" href="../css/notification.css">

</head>
<body>

    <div class="container">

        <form method="POST" action="">
        <table>
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
        <button type="submit" name="delete" id="delete1">Delete</button>

        </form>
        <button id="open-notification">Add new notification</button>

        <dialog id="notification-modal">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="noti-content">
                        <label for="inputValue">New Notification/Alert :</label>
                        <textarea name="inputValue" id="inputValue" cols="30" rows="9" maxlength="511" minlength="10" placeholder="Enter the message here..."></textarea>
                    </div>

                    <div class="noti-button">
                        <button type="submit" name="submit" id="add-content">Add</button>
                        <button name="close" id="close-n">Close</button>   
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