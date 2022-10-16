<!DOCTYPE html>
<html>

<?php
include_once('config.php');
session_start();
?>

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
  <title>Checkout</title>
</head>

<body>
  <?php include('header.php');
  if(!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
  }
 ?>

  <?php
  if (!isset($_SESSION['email']) || !$_SERVER['REQUEST_METHOD'] == 'POST') {
    header('location: login.php');
    exit();
  } else {
    $item_id = $_POST['item_id'];
    $item_quantity = $_POST['qty'];

    $query = "SELECT * FROM items WHERE id = '$item_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $price = $row['price'];
    $item_name = $row['name'];
    // echo "$item_id";
    $price_to_pay = $item_quantity * $price;

    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    // echo ($email);
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $customer_id = $row['id'];
    $customer_name = $row['name'];
    $phone_number = $row['phone_number'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-yh:i:s');
    $current_timestamp = mysqli_real_escape_string($conn, $date);

    $order_id = md5($current_timestamp);
    // echo($order_id);
  }
  ?>

  <section class=" container">

    <div class="row">

      <h1 class="text-center" style="font-weight: 650;padding: 10px 10px 10px 10px;"> CHECKOUT DETAILS </h1>
      <div class="col-lg-6 offset-lg-3 col-sm-12 py-3 text-center">
        <form method="POST" action="./PaytmKit/pgRedirect.php">
          <div class="row">
            <div class="col text-end"> <b class="text-uppercase">CUSTOMER ID :</b> </div>
            <div class="col text-start"> <?php echo ($customer_id); ?> </div>
          </div> <br>
          <div class="row">
            <div class="col text-end"> <b class="text-uppercase">name :</b> </div>
            <div class="col text-start"> <?php echo ($customer_name); ?> </div>
          </div> <br>
          <div class="row">
            <div class="col text-end"> <b class="text-uppercase">mobile number :</b></div>
            <div class="col text-start"> <?php echo ($phone_number); ?> </div>
          </div><br>
          <div class="row">
            <div class="col text-end"> <b class="text-uppercase">Email :</b></div>
            <div class="col text-start"> <?php echo ($email); ?> </div>
          </div><br>
          <div class="row">
            <div class="col text-end"> <b class="text-uppercase">Address :</b> </div>
            <div class="col text-start"> <input type="text" placeholder="eg. sec-69 block-c noida" name="address" required> </div>
          </div><br>
          <div class="row">
            <div class="col text-end"> <b class="text-uppercase">Total Price (Rupees) :</b> </div>
            <div class="col text-start"> <?php echo ($price_to_pay); ?> </div>
          </div><br>

          <input type="hidden" name="ORDER_ID" value=<?php echo ($order_id); ?>>
          <input type="hidden" name="item_id" value=<?php echo ($item_id); ?>>
          <input type="hidden" name="item_quantity" value=<?php echo ($item_quantity); ?>>
          <input type="hidden" name="CUST_ID" value=<?php echo ($customer_id); ?>>
          <input type="hidden" name="INDUSTRY_TYPE_ID" value='Retail'>
          <input type="hidden" name="CHANNEL_ID" value='WEB'>
          <input type="hidden" name="TXN_AMOUNT" value=<?php echo ($price_to_pay); ?>>

          <button type="submit" class="btn btn1 custom_orange_btn">Proceed to Checkout</button>
        </form>
      </div>
    </div>

  </section>

  <!-- footer -->
  <?php include('footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>