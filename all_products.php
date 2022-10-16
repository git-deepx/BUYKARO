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
  <title>All Products</title>
</head>

<body>
  <!-- header -->
  <?php
  include "header.php";
  ?>

  <?php 

  $category = 'all';
  if(isset($_REQUEST['category'])) $category = base64_decode($_REQUEST['category']);

  if(isset($_REQUEST['sort_by'])) {
    $value = base64_decode($_REQUEST['sort_by']);
    if ($value == '1')  {
      if($category == 'all') $query = "SELECT * FROM items ORDER BY price ASC";
      else $query = "SELECT * FROM items WHERE category='$category' ORDER BY price ASC";
    }
    else if ($value == '2')  {
      if($category == 'all') $query = "SELECT * FROM items ORDER BY price DESC";
      else $query = "SELECT * FROM items WHERE category='$category' ORDER BY price DESC";
    }
    else if ($value == '3')  {
      if($category == 'all') $query = "SELECT * FROM items ORDER BY rating DESC";
      else $query = "SELECT * FROM items WHERE category='$category' ORDER BY rating DESC";
    }
    else {
      if($category == 'all') $query = "SELECT * FROM items ORDER BY name ASC";
      else $query = "SELECT * FROM items WHERE category='$category' ORDER BY name ASC";
    }
  }
  else {
    if($category == 'all') $query = "SELECT * FROM items ";
    else $query = "SELECT * FROM items WHERE category = '$category'";
  }

  ?>

  <!-- sort by -->
  <section class="sort_by_section container">
    <div class="row text-center">
            
      <div class=" col pt-3" style="display: inline-block;">
        <form method="get">
          CATEGORY:
          <div style="display: inline">
            <select name="category">
              <option value=' <?php echo(base64_encode('all')); ?>'>All</option>
              <option value=' <?php echo(base64_encode('electronics')); ?>' >Electronics</option>
              <option value=' <?php echo(base64_encode('grocery')); ?>' >Grocery</option>
              <option value=' <?php echo(base64_encode('clothing')); ?>' >clothing</option>
            </select>
          </div>
          <button class="btn custom_orange_btn mb-1" type="submit" value="Submit">Submit</button>
        </form>
      </div>

      <div class=" col pt-3" style="display: inline-block;">
        <form method="get">
          SORT BY:
          <div style="display: inline">
            <select name="sort_by">
              <option value="0" disabled>Sort By</option>
              <option value=' <?php echo(base64_encode('1')); ?>' >Price(Low to High)</option>
              <option value=' <?php echo(base64_encode('2')); ?>'>Price(High to Low)</option>
              <option value=' <?php echo(base64_encode('3')); ?>'>Rating</option>
              <option value=' <?php echo(base64_encode('4')); ?>'>Name</option>
            </select>
          </div>
          <button class="btn custom_orange_btn mb-1" type="submit" name = "category" value= <?php echo base64_encode($category); ?>> Submit</button>
        </form>
      </div>
      
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 pt-3">

      <?php
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
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

  <!-- Footer -->
  <?php include 'footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>