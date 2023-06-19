<!DOCTYPE html>
<html>

<head>
  <title>Lost and Found Items</title>
  <link rel="stylesheet" type="text/css" href="lost-found.css">
</head>

<body>

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
            <th>Date of Found</th>
            <th>Location Found</th>
            <th>Item Description</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <?php foreach ($lostItems as $item): ?>
            <tr>
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
</body>

</html>
