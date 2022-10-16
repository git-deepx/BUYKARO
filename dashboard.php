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

  <!-- categories -->
  <section class="category_section container" id="category">
    <div class=" mb-5">
      <h1 class="text-center" style="font-weight: 650;padding: 10px 10px 10px 10px;"> ADMIN DASHBOARD </h1>
    </div>

    <div class="row">

      <div class="col-lg-4 col-md-6 col-sm-12" style=" margin: 10px 0px 10px 0px;">
        <div class="custom_card custom_card_electronics">
          <div class="container-fluid text-center pb-3">
            <a class="btn custom_orange_btn" href="order_logs.php" style="font-size: 20px;">
              Order Logs
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12" style=" margin: 10px 0px 10px 0px;">
        <div class="custom_card custom_card_grocery">
          <div class="container-fluid text-center pb-3">
            <a class="btn custom_orange_btn" href="all_products.php?category=<?php echo base64_encode('grocery') ?>" style="font-size: 20px;">
              Manage Users
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

  <!-- Footer start -->
  <?php include "footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>