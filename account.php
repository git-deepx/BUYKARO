<!-- 
  Author : Deepak Kumar Thakur
  Version : 1.69
-->

<?php
include_once('config.php');
session_Start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Site Metas -->
  <meta name="description" content="Ecommerce Website" />
  <meta name="author" content="Deepak Kumar Thakur" />

  <!-- scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <!-- CSS -->
  <link href="css/style_light.css" rel="stylesheet" />
  <title>My Account</title>
</head>

<body>
  <!-- header -->
  <?php
  include "header.php";

  if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
  }
  ?>

  <!-- account  -->
  <section class="account_section container" style="padding-top: 20px;">
    <div class="row">

      <div class="col-lg-6">
        <?php
        $email = $_SESSION['email'];
        $query = "select * from users where email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        ?>
        <h1 class="text-center" style="font-weight: 650;padding: 10px 10px 10px 10px;"> Personal Information </h1>

        <div class="row">
          <div class="col text-end">
            <h5> Customer ID: </h5>
          </div>
          <div class="col">
            <h5 style="font-weight: 350;"> <?php echo ($row['id']) ?> </h5>
          </div>
        </div>
        <div class="row">
          <div class="col text-end">
            <h5> Name: </h5>
          </div>
          <div class="col">
            <h5 style="font-weight: 350;"> <?php echo ($row['name']) ?> </h5>
          </div>
        </div>
        <div class="row">
          <div class="col text-end">
            <h5> Phone Number: </h5>
          </div>
          <div class="col">
            <h5 style="font-weight: 350;"> <?php echo ($row['phone_number']) ?> </h5>
          </div>
        </div>
        <div class="row">
          <div class="col text-end">
            <h5> Email: </h5>
          </div>
          <div class="col">
            <h5 style="font-weight: 350;"> <?php echo ($row['email']) ?> </h5>
          </div>
        </div>
        <div class="row">
          <div class="col text-end">
            <h5> City: </h5>
          </div>
          <div class="col">
            <h5 style="font-weight: 350;"> <?php echo ($row['city']) ?> </h5>
          </div>
        </div>
        <div class="row">
          <div class="col text-end">
            <h5> Address: </h5>
          </div>
          <div class="col">
            <h5 style="font-weight: 350;"> <?php echo ($row['address']) ?> </h5>
          </div>
        </div>
      </div>

      <div class="col-lg-6" style="padding-top: 30px;">
        <?php
        if (!isset($_GET['name']) && !isset($_GET['phone_number']) && !isset($_GET['city']) && !isset($_GET['address']) && !isset($_GET['new_password'])) {
          echo ('
                <h5 class= "text-uppercase  text-center"> Want to Update Profile?</h5>
                <h7 class= "text-center"> Choose from the options below you want to update </h7><br><br>
                
                <form action="" method="get">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="name" value="true" >Name
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="phone_number" value="true"> Phone number
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="city" value="true"> city
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="address" value="true"> address
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="new_password" value="true"> password
                  </div>
                  <button type="submit" class="btn btn1 custom_orange_btn mt-3">Submit</button>
                </form>
            ');
        } else {
          echo (' <form method="POST" action="update.php"> ');
          if (isset($_GET['name'])) {
            echo ('
                <div class="form-group">
                  <h6 class="text-uppercase">name</h6>
                  <input class="form-control" type="text" required="true" placeholder="eg. Deep" pattern="[A-z0-9À-ž\s]{2,}$" name="name">
                  <br/>
                </div>
              ');
          }
          if (isset($_GET['phone_number'])) {
            echo ('
                <div class="form-group">
                <h6 class="text-uppercase">mobile number</h6>
                <input class="form-control" type="tel" placeholder="eg. 9876543210" required="true" pattern="[0-9]{10}$" name="phone_number">
                <br/>
              </div>
              ');
          }
          if (isset($_GET['city'])) {
            echo ('
              <div class="form-group">
              <h6 class="text-uppercase">City</h6>  
              <input class="form-control" type="text" required="true" placeholder="eg. Noida" pattern="[A-Za-z]{1,}$" name="city">
                <br/>
              </div>
              ');
          }
          if (isset($_GET['address'])) {
            echo ('
              <div class="form-group">
              <h6 class="text-uppercase">Address</h6>  
              <input class="form-control" type="text" required="true" placeholder="eg. sec-69 block-c noida" pattern="[A-z0-9À-ž\s]{2,}$" name="address">
              <br/>
            </div>
              ');
          }
          if (isset($_GET['new_password'])) {
            echo ('
                <div class="form-group">
                <h6 class="text-uppercase">New Password</h6>
                <input class="form-control" type="password" required="true" placeholder="xxxxxxxxx" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}$" title="must contain at least one number and one uppercase and lowercase letter, and at least 4 or more characters" name="new_password">
                <br/>
              </div>
              ');
          }
          echo ('
            <div class="form-group">
                    <h6 class="text-uppercase">Current Password</h6>
                    <input class="form-control" type="password" required="true" placeholder="xxxxxxxxx" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}$" title="must contain at least one number and one uppercase and lowercase letter, and at least 4 or more characters" name="password">
                    <br/>
                  </div>
            ');
          echo (' 
              <button type = "submit" class="btn custom_orange_btn">Submit</button>
              </form> 
            ');
        }
        ?>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include "footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>