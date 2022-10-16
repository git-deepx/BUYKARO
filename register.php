<!-- 
  Author : Deepak Kumar Thakur
  Version : 1.69
-->

<!-- PHP code -->
<?php 
 include_once("config.php");
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $query = "select * from users where email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    
    if(is_array($row)) {
      $error = 'User already exists with this Email';
    }
    else {
      session_start(); 

      $name=mysqli_real_escape_string($conn,$_POST['name']);
      $city=$_POST['city'];
      $phone_number=$_POST['phone_number'];
      $address=mysqli_real_escape_string($conn,$_POST['address']);
      $password=md5($_POST['password']);
      $query="insert into users(name,city,address,email,phone_number,password) values('$name','$city','$address','$email','$phone_number','$password')";
      mysqli_query($conn, $query);

      $_SESSION['logged_in'] = true;
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['access'] = 'user';
      
      header('location: index.php');
      exit();
    }
  }
?>

<!-- Html code -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="description" content="Ecommerce Website" />
  <meta name="author" content="Deepak Kumar Thakur" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- symbols -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- CSS -->
  <link href="css/style_light.css" rel="stylesheet" />
  <title>Register</title>
</head>

<body>

  <!-- header -->
  <?php include "header.php" ?>

  <!-- register form -->
  <section class="container" style="margin-top: 90px;">
  <div class="row container">
        <?php
          if(isset($error)) {
            echo ('
              <div class="alert alert-danger alert-dismissible fade show container" role="alert" style="text-align: center;">
            '); 
            echo ($error); 
            echo('
                <button style="text-align: center;" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            ');
          }
        ?>
  </div>
  <div class="row" >
    <u><h2 class="display1 text-center text-uppercase">REgister</h2></u>
  </div>

    <div class="row py-3" style=" text-align: center;"><br/>
        <h6> <span style="border-style: dashed;" class="text-uppercase px-3 py-1">already a user? <a href= "login.php" > login</a> </span> </h6> 
        </div>
    <div class="row">      
      <div class="col-lg-6 offset-lg-3 col-sm-12 py-3">
        <form method="post" action="">
          <div class="form-group">
              <h6 class="text-uppercase">name</h6>
              <input class="form-control" type="text" required="true" placeholder="eg. Deep"  name="name">
              <br/>
          </div>
          <div class="form-group">
              <h6 class="text-uppercase">mobile number</h6>
              <input class="form-control" type="tel" placeholder="eg. 9876543210" required="true" pattern="[0-9]{10}$" name="phone_number">
              <br/>
          </div>
          <div class="form-group">
              <h6 class="text-uppercase">Email</h6>
              <input class="form-control" type="email" required="true" placeholder="eg. deep@gmail.com" title="please enter valid email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email">
              <br/>
            </div>
          <div class="form-group">
              <h6 class="text-uppercase">Password</h6>
              <input class="form-control" type="password" required="true" placeholder="xxxxxxxxx" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}$" title="must contain at least one number and one uppercase and lowercase letter, and at least 4 or more characters" name="password">
              <br/>
            </div>
          <div class="form-group">
            <h6 class="text-uppercase">City</h6>  
            <input class="form-control" type="text" required="true" placeholder="eg. Noida" name="city">
              <br/>
            </div>
          <div class="form-group">
            <h6 class="text-uppercase">Address</h6>  
            <input class="form-control" type="text" required="true" placeholder="eg. sec-69 block-c noida" name="address">
            <br/>
          </div>
          <button type = "submit" class="btn custom_orange_btn">Submit</button>
        </form>
      </div>
      
    </div>
  </section>

  <!-- Footer -->
  <?php include "footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>