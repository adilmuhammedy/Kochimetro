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

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .delete-btn {
            display: none;
        }
    </style>

</head>
<body>
    <h2>Add or delete reqired notification</h2>
    

    <form method="POST" action="">
        <table>
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
        <button type="submit" name="delete">Delete</button>

    </form>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="inputValue" maxlength="511" minlength="10" placeholder="Enter the message here...">
        <button type="submit" name="submit">Add</button>
    </form>

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

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>