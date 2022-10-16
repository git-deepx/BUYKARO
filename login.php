<!-- 
  Author : Deepak Kumar Thakur
  Version : 1.69
-->

<?php 
  include_once('config.php');
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);

    if($row) {
      $password=md5($_POST['password']);

      if($row['password'] != $password) {
        $error = 'Wrong Password';
      }
      else {
        session_start();
        
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $email;
        $_SESSION['access'] = $row['access'];
        
        header('location: index.php');
        exit();
      }
    }
    else {
      $error = 'User Does not Exist!!!, Please Register First';
    }
  }
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- symbols -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- CSS -->
  <link href="css/style_light.css" rel="stylesheet" />
  <title>Login</title>
</head>

<body>

  <!-- header -->
  <?php 
    include "header.php"; 
    if(isset($_SESSION['logged_in'])) {
      header('location: index.php');
      exit();
    }
  ?>
  
  <!-- login form -->
  <section class="container"  style="margin-top: 20px;">
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
    <u><h2 class="display1 text-center text-uppercase">Login</h2></u>
  </div>

    <div class="row py-3" style=" text-align: center;"><br/>
        <h6> <span style="border-style: dashed;" class="text-uppercase px-3 py-1">New Here? lets Connect <a href= "register.php" > Register</a> </span> </h6> 
        </div>
          
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-sm-12 py-3">
          <form method="post" action="">
          <div class="form-group">    
          <h6 class="text-uppercase">Name</h6>
            <input class="form-control" type="email" required="true" placeholder="name@address.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="please enter valid email address" name="email" >
            <br/>
          </div>
          <div class="form-group">
            <h6 class="text-uppercase">Password</h6>
            <input class="form-control" required="true" placeholder="Enter Your password Here" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}$" title="Must contain at least number and one uppercase and lowercase letter, and at least 4 or more characters" name="password">
            <!-- <br/> -->
          </div> 
          <a href="#">forgot password?</a>
          <br><br>   
          <button class="btn btn1 custom_orange_btn">Submit</button>
          </form>
      </div>
    </div>
  </section>

  <!-- Footer start -->
  <?php include "footer.php" ?>
  <!-- Footer end -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
