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
  <title>BUY KARO</title>
</head>

<body>

  <?php include('header.php');
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
  }
  ?>
  <?php
  if (isset($_REQUEST['item_id'])) {
    $item_id = $_REQUEST['item_id'];
    $item_id = base64_decode($item_id);
    $query = "SELECT * FROM items WHERE id = $item_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $quantity = $row['quantity'];
    $rating = (int)$row['rating'];
    $category = $row['category'];
    $price = $row['price'];
    $seller = $row['seller'];
    $information = $row['information'];
  }
  ?>

  <section class="buy_product container">
    <div class="row" style="padding: 10px 10px 10px 10px;">
      <h1 class="text-center" style="font-weight: 650;padding: 10px 10px 10px 10px;"> PRODUCT DETAILS </h1>
      <div class="col-lg-6 col-md-6" style="margin: 10px 0px 10px 0px;">
        <img src='./images/items/<?php echo ($item_id); ?>.png' style="width: 100%; height: 350px; border-radius: 20px 20px 20px 20px;">
        <div class="text-center" style="background-color: rgba(255, 99, 71, 0.5); border-radius: 20px 20px 20px 20px;"> Hurry only
          <?php echo "<span style='color: red;'> $quantity </span>"; ?> left</div>
      </div>

      <div class="col-lg-6 col-md-6">
        <div class="row">
          <div class="col"><b>Product Id:</b>
            <div> <?php echo ($item_id); ?> </div>
          </div>
          <div class="col"><b>Product Name:</b>
            <div> <?php echo ($name); ?> </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col"><b>Rating:</b>
            <div>
              <?php while ($rating--) {
                echo ("<img style='width: 15px; height:23px; padding-bottom: 8px' src='../project/images/star.png'>");
              }
              ?>
            </div>
          </div>
          <div class="col"><b>Category:</b>
            <div> <?php echo ($category); ?> </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col"><b>Price:</b>
            <div>₹ <?php echo ($price); ?> </div>
          </div>
          <div class="col"><b>Seller:</b>
            <div> <?php echo ($seller); ?> </div>
          </div>
        </div>
        <br>
        <div class="col"><b>Information:</b>
          <div align='justify'> <?php echo ($information); ?> </div>
        </div>
        <br>
        <div class="row text-center">
          <form method="post" action="checkout.php">
            <label>Quantity to Buy :</label>
            <input type="number" name='qty' min="1" max=<?php echo ($quantity); ?> required>
            <button class="btn custom_orange_btn" type="submit" name='item_id' value=<?php echo ($item_id); ?>>Buy Now</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php include('footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>