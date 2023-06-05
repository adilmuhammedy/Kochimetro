<!-- Php code for notification  -->
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include FontAwesome icons CSS file -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- select2 dropdown  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />

    <!-- footer  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <link href="css/custom.css" rel="stylesheet" href="">
    <!-- <link href="css/check.css" rel="stylesheet" href=""> -->

</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Metro
  </a> -->
  <div class="lang">
    <p>Malayalam|English</p>
  </div>
  </nav>

  <div class="sec-nav">
    <div class="p2">
      Space1
    </div>
    <div class="p2">
      Space2
    </div>
  </div>

  <div class="container-fluid">
        <div class="row outer custom-row">
          <div class="col-4 inner custom-col">
            
            <div class="form-container">
              <form action="#" id="form">

                <div class="form-group">
                  <div class="heading1">
                    <h2 id="head1">PLAN YOUR JOURNEY</h2>
                  </div>
                  <br>
                  <label for="select1">From :</label>
                  <select id="select1" class="select2" style="width: 334.3px;">
                    <option value="" class="pholder" disabled selected hidden>Click to select</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    <option value="option4">Option 4</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                  </select>              
                </div>

                <div class="form-group" id="div1">
                  <label for="select2">To :</label>
                  <select id="select2" class="select2" style="width: 334.3px;">
                    <option value="" class="pholder" disabled selected hidden>Click to select</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    <option value="option4">Option 4</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                    <option value="option5">Option 5</option>
                  </select>              
                </div>

                <!-- <div class="form-group">
                  <label for="select3">Time slot :</label>
                  <label for="select4">No.of Passengers :</label>
                  <br>
                  <select id="select3">
                    <option value="" class="pholder" disabled selected hidden>Click to select</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    <option value="option4">Option 4</option>
                    <option value="option5">Option 5</option>
                  </select>   
                  
                  <select id="select4">
                    <option value="" class="pholder" disabled selected hidden>Click to select</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    <option value="option4">Option 4</option>
                  </select>   
                </div> -->

                <div class="form-group form-grp">
                  <div class="p1" id="div2">
                    <label for="select3">Time slot :</label>
                    <select class="select2" style="width: 160.48px;">
                      <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to select</option>
                      <option value="option1">Option 1</option>
                      <option value="option2">Option 2</option>
                      <option value="option3">Option 3</option>
                    </select>
                  </div>
                  <div class="p1">
                    <label for="select5">Ticket type :</label>
                    <select class="select2" style="width: 160.48px;">
                      <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to select</option>
                      <option value="option1">Option 1</option>
                      <option value="option2">Option 2</option>
                      <option value="option3">Option 3</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                    <label>No of Passengers :</label>
                    <input class="i" type="number" id="nop" required />
                </div>
                <br>
                <div class="buttons">
                    <button type="reset" id="my-reset-button" onclick="resetSelect2()">Reset</button>
                    <button type="button" id="fare">Show Route & Fare</button>
                </div>
                <br>
              </form>
            </div>
          </div>
          <div class="col-4 custom-col">

            <div class="search-container">
              <h2 class="search-heading">Know your station</h2>
              <div class="search-input-container">
                <div class="s-box">
                  <select id="select-box-1" class="select2" style="width: 250.88px;">
                    <option value="" class="pholder search-input search-input-container" disabled selected hidden>Click to select</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    <option value="option4">Option 4</option>
                  </select> 
                </div>  
                <button class="search-icon"><i class="fa fa-search"></i></button>
                <!-- <button class="search-button"></button> -->
              </div>
              <!-- <div class="search-dropdown">
                <div class="search-dropdown-item">Option 1</div>
                <div class="search-dropdown-item">Option 2</div>
                <div class="search-dropdown-item">Option 3</div>
              </div> -->
            </div>

            <br>

            <!-- <div class="col">
              <div class="matrix-container">
                <div class="row">
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 1" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 2" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 3" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 4" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 5" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 6" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 7" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 8" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                  <div class="col-4">
                    <button class="matrix-button">
                      <img src="https://via.placeholder.com/50x50" alt="Icon 9" class="img-fluid">
                      <span>&nbsp;Fare Calculator</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>        -->

            <!-- btn matrix -->

            <div class="btn-container">
              <div class="row">
                <div class="col-md-6">
                  <button class="btn-rect">
                    <div class="btn-inner">
                      <img src="/images/html_pic.jpg">
                      <div class="btn-divider"></div>
                      <div class="btn-name">Fare Calculator</div>
                    </div>
                  </button>
                </div>
                <div class="col-md-6">
                  <button class="btn-rect">
                    <div class="btn-inner">
                      <img src="/images/html_pic.jpg">
                      <div class="btn-divider"></div>
                      <div class="btn-name">Fare Calculator</div>
                    </div>
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn-rect">
                    <div class="btn-inner">
                      <img src="image3.jpg">
                      <div class="btn-divider"></div>
                      <div class="btn-name">Fare Calculator</div>
                    </div>
                  </button>
                </div>
                <div class="col-md-6">
                  <button class="btn-rect">
                    <div class="btn-inner">
                      <img src="image4.jpg">
                      <div class="btn-divider"></div>
                      <div class="btn-name">Fare Calculator</div>
                    </div>
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn-rect">
                    <div class="btn-inner">
                      <img src="image5.jpg">
                      <div class="btn-divider"></div>
                      <div class="btn-name">Fare Calculator</div>
                    </div>
                  </button>
                </div>
                <div class="col-md-6">
                  <button class="btn-rect">
                    <div class="btn-inner">
                      <img src="image6.jpg">
                      <div class="btn-divider"></div>
                      <div class="btn-name">Fare Calculator</div>
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
                <tbody>

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
                    <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                </div>
                <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
            </div>
            <p class="copyright">Company Name © 2018</p>
        </div>
    </footer>
  </div>
  
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>