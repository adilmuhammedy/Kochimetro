<!DOCTYPE html>
<html>
<head>
    <title>Lost and Found</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script>
        $(document).ready(function() {
            $('.claim-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var itemId = form.find('input[name="item_id"]').val();
                var name = form.find('input[name="name"]').val();
                var address = form.find('input[name="address"]').val();
                var idNumber = form.find('input[name="id_number"]').val();

                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function() {
                        form.hide();
                        form.siblings('.claimed-details').find('.name').text(name);
                        form.siblings('.claimed-details').find('.address').text(address);
                        form.siblings('.claimed-details').find('.id-number').text(idNumber);
                        form.siblings('.claimed-details').show();
                        form.siblings('.claimed-button').show();
                    }
                });
            });

            $('.hide-button').click(function() {
                var details = $(this).parent('.claimed-details');
                details.hide();
                details.siblings('.claimed-button').show();
            });

            $('.claimed-button').click(function() {
                var details = $(this).siblings('.claimed-details');
                details.toggle();
                $(this).text(details.is(':visible') ? 'Hide' : 'Claimed');
            });
        });
    </script> -->


</head>
<body>
    <?php

    include 'config.php';

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

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $idType= $_POST["idType"];
        $idNumber = $_POST["idNumber"];
        $phoneNumber = $_POST["phoneNumber"];
        $itemId = $_POST["item_id"];

        // Update the database with the form submission details
        $sql = "UPDATE found SET claimed=1, name='$name', address='$address', id_type='$idType' , id_number='$idNumber' , phone='$phoneNumber' WHERE id=$itemId";
        if ($conn->query($sql) === TRUE) {
            // Success
        } else {
            echo "Error updating record: " . $conn->error;
        }

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    $conn->close();
    ?>
    <h2>Lost and Found details</h2>
    <table>
        <tr>
            <th>Date of Found</th>
            <th>Location Found</th>
            <th>Item Description</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>

        <?php foreach ($lostItems as $item): ?>
            <tr>
                <td><?php 
                $formattedDate = date("d-m-Y", strtotime($item["date"]));
                echo $formattedDate;
                ?></td>
                <td><?php echo $item["location"]; ?></td>
                <td><?php echo $item["item"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td>
                    <?php if ($item["claimed"] == false): ?>
                        <button onclick="showClaimForm(this, <?php echo $item["id"]; ?>)">Claim</button>
                        
                        <form class="claim-form" style="display: none;" onsubmit="return validateForm(<?php echo $item["id"]; ?>)" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
                            <input type="text" name="name" placeholder="Name" required><br>
                            <input type="text" name="address" placeholder="Address" required><br>

                            <select id="idType_<?php echo $item["id"]; ?>" name="idType" placeholder="Type of id" required>
                                <option value="">-- Select ID Type --</option>
                                <option value="Driving licence">Driving licence</option>
                                <option value="Aadhar card">Aadhar card</option>
                                <option value="Voter ID">Voter ID</option>
                            </select><br>

                            <input type="text" id="idNumber_<?php echo $item["id"]; ?>" name="idNumber" placeholder="Id Number" required ><br>

                            <input type="text" id="phoneNumber_<?php echo $item["id"]; ?>" name="phoneNumber" placeholder="Phone number" required ><br><br>

                            <input type="submit" value="Submit"> <br><br>

                            <button onclick="hideForm(this)">Back</button>

                        </form>

                        <div class="claimed-details" style="display: none;">
                            <p>Name: <span><?php echo $item["name"]; ?></span></p>
                            <p>Address: <span><?php echo $item["address"]; ?></span></p>
                            <p>ID Type: <span><?php echo $item["id_type"]; ?></span></p>
                            <p>ID Number: <span><?php echo $item["id_number"]; ?></span></p>
                            <p>Phone Number: <span><?php echo $item["phone"]; ?></span></p>
                            <button onclick="hideClaimedDetails(this)">Hide</button>
                        </div>
                    <?php else: ?>
                        <button onclick="showClaimedDetails(this, <?php echo $item["id"]; ?>)" >Claimed</button>
                        <div class="claimed-details" style="display: none;">
                            <p>Name: <span><?php echo $item["name"]; ?></span></p>
                            <p>Address: <span><?php echo $item["address"]; ?></span></p>
                            <p>ID Type: <span><?php echo $item["id_type"]; ?></span></p>
                            <p>ID Number: <span><?php echo $item["id_number"]; ?></span></p>
                            <p>Phone Number: <span><?php echo $item["phone"]; ?></span></p>
                            <button onclick="hideClaimedDetails(this)">Hide</button>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h4>Add detail of lost item : </h4>

    <form action="lost_insert.php" method="POST" onsubmit="return validateQuantity()">
        <label for="item">Item:</label>
        <input type="text" id="item" name="item" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        function showClaimForm(button, itemId) {
            var form = button.parentNode.querySelector('.claim-form');
            form.style.display = "block";
            button.style.display = "none";
        }

        function showClaimedDetails(button, itemId) {
            var details = button.parentNode.querySelector('.claimed-details');
            details.style.display = "block";
            button.style.display = "none";
        }
        function hideClaimedDetails(button) {
            var details = button.parentNode;
            var claimButton = details.parentNode.querySelector('button');
            details.style.display = "none";
            claimButton.style.display = "block";
        }
        function hideForm(button) {
            var details = button.parentNode;
            var backButton = details.parentNode.querySelector('button');
            details.style.display = "none";
            backButton.style.display = "block";
        }
        
      function validateForm(itemId) {
            var idType = document.getElementById("idType_" + itemId).value;
            var idNumber = document.getElementById("idNumber_" + itemId).value;
            var phoneNumber = document.getElementById("phoneNumber_" + itemId).value;

            // Regular expression for Driving licence validation
            var drivingLicenceRegex = /^[A-Za-z]{2}\d{13}$/;

            // Regular expression for a minimum of 10 digits in phone number
            var phoneRegex = /^\d{10,}$/;

            if (idType === "") {
                alert("Please select an ID type.");
                return false;
            }

            if (idNumber === "") {
                alert("Please enter the ID number.");
                return false;
            }

            if (phoneNumber === "") {
                alert("Please enter the phone number.");
                return false;
            }

            if (idType === "Driving licence") {
                if (!drivingLicenceRegex.test(idNumber)) {
                    alert("Please enter a valid Driving licence number");
                    return false;
                }
            } else if (idType === "Aadhar card") { 
                if (idNumber.length < 12) {
                    alert("Please enter a valid Aadhar number");
                    return false;
                }
            } else if (idType === "Voter ID") {
                if (idNumber.length < 10) {
                    alert("Please enter a valid Voter ID number");
                    return false;
                }
            }

            if (!phoneRegex.test(phoneNumber)) {
                alert("Please enter a valid phone number");
                return false;
            }

            return true;
        }

        function validateQuantity() {
            var quantity = document.getElementById("quantity").value;

            if (quantity <= 0) {
                alert("Quantity must be greater than 0.");
                return false;
            }
            alert("Successfully inserted lost item")
            return true;
        }

    </script>
</body>
</html>
