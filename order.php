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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet"> </link>
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"> </link>
  <title>My Orders</title>
</head>

<body>
  <!-- header -->
  <?php
  include "header.php";
  if(!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
  }
  ?>

  <!-- ordered items   -->
  <section class="order_section container">
    <h1 class="text-center text-uppercase" style="font-weight: 650;padding: 0px 10px 10px 10px;"> Order History </h1>

    <div class="row ">
      <div class="col">
        <table class="table table-hover" id = "my_orders">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Order Id</th>
              <th scope="col">Product</th>
              <th scope="col">Qty.</th>
              <th scope="col">Total(₹)</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>

          <?php
          $email = $_SESSION['email'];
          if (isset($_GET['item_id'])) {
            $item_id = $_GET['item_id'];
            $query = "SELECT * from ordered_items where item_id = '$item_id' and email = '$email' and status = 'success' order by ordered_on DESC";
          } else {
            $query = "SELECT * from ordered_items where email = '$email' and status = 'success' order by ordered_on DESC";
          }
          // echo($email);
          $result = mysqli_query($conn, $query);
          $i = 1;

          while ($row = mysqli_fetch_assoc($result)) {
            $item_id = $row['item_id'];
            $query = "SELECT * from items where id = '$item_id'";
            $result_items = mysqli_query($conn, $query);
            $items = mysqli_fetch_array($result_items);
            
            echo('<tr>');
            echo '<th scope="row">' . $i++ . '</th>';
            echo ' <td>' . $row['order_id'] . '</td>';
            echo ' <td><a href="buy.php?item_id='. base64_encode($item_id) .'">' . $items['name'] . ' (Pid-' . $items['id'] . ')' . '</a></td>';
            echo ' <td>' . $row['quantity'] . '</td>';
            echo ' <td>' . $row['amount'] . '</td>';
            echo ' <td>' . $row['ordered_on'] . '</td>';
            echo('</tr>');
          }
          ?>

        </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include "footer.php" ?>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#my_orders').DataTable();
    });
  </script>
</body>

</html>