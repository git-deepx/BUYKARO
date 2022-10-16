<!--
  Author : Deepak Kumar Thakur
  Version : 1.69
-->


<?php
include_once 'config.php';
session_Start();
?>

<!DOCTYPE html>
<html>

<head>
  <?php include('head_tags.php'); ?>
  <title>Home</title>
</head>

<body>
  <!-- header -->
  <?php
  include "header.php";
  ?>

  <!-- display -->
  <section class="display_section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 style="font-weight: 600;"> WHAT <span style="color: #fc5d35">EXCITES</span> YOU... </h1>
        </div>
      </div>
      <img loading="lazy" src="images/display.png" class="img-fluid" alt="...">
    </div>
  </section>

  <!-- categories -->
  <section class="category_section container" id="category">
    <div class=" mb-5">
      <h1 class="text-center" style="font-weight: 650;padding: 10px 10px 10px 10px;"> EXPLORE THROUGH THE CATEGORIES </h1>
    </div>

    <div class="row">

      <div class="col-lg-4 col-md-6 col-sm-12" style=" margin: 10px 0px 10px 0px;">
        <div class="custom_card custom_card_electronics">
          <div class="container-fluid text-center pb-3">
            <a class="btn custom_orange_btn" href="all_products.php?category=<?php echo base64_encode('electronics') ?>" style="font-size: 20px;">
              ELECTRONICS
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12" style=" margin: 10px 0px 10px 0px;">
        <div class="custom_card custom_card_grocery">
          <div class="container-fluid text-center pb-3">
            <a class="btn custom_orange_btn" href="all_products.php?category=<?php echo base64_encode('grocery') ?>" style="font-size: 20px;">
              GROCERY
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12 col-sm-12" style=" margin: 10px 0px 10px 0px;">
        <div class="custom_card custom_card_clothing">
          <div class="container-fluid text-center pb-3">
            <a class="btn custom_orange_btn" href="all_products.php?category=<?php echo base64_encode('clothing') ?>" style="font-size: 20px;">
              CLOTHING
            </a>
          </div>
        </div>
      </div>

    </div>

  </section>

  <!-- top products -->
  <section class="top_products container mt-5">
    <div class="mb-2">
      <h1 class="text-center" style="font-weight: 650;padding: 10px 10px 0px 10px;"> PICK FROM OUR TOP PRODUCTS!!! </h1>
    </div>

    <div class="row">
      <h4 style="font-weight: 600; text-align: center;"> ELECTRONICS </h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
      <?php
      $query = "SELECT * FROM items WHERE category = 'electronics' ORDER BY rating DESC";
      $result = mysqli_query($conn, $query);

      for ($i = 1; $i <= 2; $i++) {
        $row = mysqli_fetch_assoc($result);
        $item_name = $row['name'];
        $item_id = $row['id'];
        $rating = (int) $row['rating'];
        $price = $row['price'];
        $information = $row['information'];
        echo ("
            <div class='col'>
              <div class='card h-100'>
                <img loading = 'lazy' src='./images/items/$item_id.png' class='card-img-top' >
                <div class='card-body'>
                  <h5 class='col text-start' style='display: inline'>$item_name</h5>
          ");
        while ($rating--) echo ("<img style='width: 15px; height:23px; padding-bottom: 8px' src='../project/images/star.png'>");
        echo ("<h5 class='col' style='float: right;'>₹ $price</h5>
                <p align='justify' class='card-text'>" . substr($information, 0, 185) . ". . .</p>
                </div>
                <a class='btn custom_orange_btn mb-2' href='buy.php?item_id=" . base64_encode($item_id) . "'>Buy Now </a>
              </div>
            </div>
          ");
      }
      ?>
    </div>

    <br>
    <div class="row">
      <h4 style="font-weight: 600; text-align: center;"> GROCERY </h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
      <?php
      $query = "SELECT * FROM items WHERE category = 'grocery' ORDER BY rating DESC";
      $result = mysqli_query($conn, $query);

      for ($i = 1; $i <= 2; $i++) {
        $row = mysqli_fetch_assoc($result);
        $item_name = $row['name'];
        $item_id = $row['id'];
        $rating = (int) $row['rating'];
        $price = $row['price'];
        $information = $row['information'];
        echo ("
            <div class='col'>
              <div class='card h-100'>
                <img loading = 'lazy' src='images/items/$item_id.png' class='card-img-top' >
                <div class='card-body'>
                  <h5 class='col text-start' style='display: inline'>$item_name</h5>
          ");
        while ($rating--) echo ("<img style='width: 15px; height:23px; padding-bottom: 8px' src='../project/images/star.png'>");
        echo ("<h5 class='col' style='float: right;'>₹ $price</h5>
                <p align='justify' class='card-text'>" . substr($information, 0, 185) . ". . .</p>
                </div>
                <a class='btn custom_orange_btn mb-2' href='buy.php?item_id=" . base64_encode($item_id) . "'>Buy Now </a>
              </div>
            </div>
          ");
      }
      ?>
    </div>

    <br>
    <div class="row">
      <h4 style="font-weight: 600; text-align: center;"> CLOTHING </h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
      <?php
      $query = "SELECT * FROM items WHERE category = 'clothing' ORDER BY rating DESC";
      $result = mysqli_query($conn, $query);

      for ($i = 1; $i <= 3; $i++) {
        $row = mysqli_fetch_assoc($result);
        $item_name = $row['name'];
        $item_id = $row['id'];
        $rating = (int) $row['rating'];
        $price = $row['price'];
        $information = $row['information'];
        echo ("
            <div class='col'>
              <div class='card h-100'>
                <img loading = 'lazy' src='images/items/$item_id.png' class='card-img-top' >
                <div class='card-body'>
                  <h5 class='col text-start' style='display: inline'>$item_name</h5>
          ");
        while ($rating--) echo ("<img style='width: 15px; height:23px; padding-bottom: 8px' src='../project/images/star.png'>");
        echo ("<h5 class='col' style='float: right;'>₹ $price</h5>
                <p align='justify' class='card-text'>" . substr($information, 0, 185) . ". . .</p>
                </div>
                <a class='btn custom_orange_btn mb-2' href='buy.php?item_id=" . base64_encode($item_id) . "'>Buy Now </a>
              </div>
            </div>
          ");
      }
      ?>
    </div>

  </section>

  <!-- sponser -->
  <section class="sponser_Section">

  </section>

  <!-- Footer start -->
  <?php include "footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>