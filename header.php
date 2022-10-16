<!-- header starts -->
<section class = "header_section">
  <nav class="navbar fixed-top navbar-expand-lg py-2">
    <div class="container">
      
      <!-- <div class="mode_sm"></div> -->

      <a class="navbar-brand text-center" href="index.php">
        <img src="images/logo.png" alt=""/>
        <b> <span style="color: #fc5d35">BUY</span> <span style="color: #F8F6EA">KARO</span></b>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#my_nav" aria-controls="my_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-white"><i class="bi bi-list-nested"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="my_nav">
        <ul class="navbar-nav ms-auto mb-lg-0">
          <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php"> HOME</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php"> About US</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php #category"> Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="all_products.php"> All Products</a></li>
          <li class="text-white"><hr class="dropdown-divider"></li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li>
          <?php 
            if(isset($_SESSION['email'])) {
              echo('<div class="dropdown">
                <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ');
              if($_SESSION['access'] == 'admin') {
                echo('<img class="pb-1" src="images/admin.png" style= "height= "15px"; width= "25px";> ');
              }
              else {
                echo('<img class="pb-1" src="images/user.png" style= "height= "10px"; width= "20px";> ');
              }
              echo($_SESSION['name']);
              echo ('
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="order.php">My Orders</a>
                  <a class="dropdown-item" href="account.php">MY Account</a>
                ');
                if($_SESSION['access'] == 'admin') {
                  echo(' <a class="dropdown-item" href="dashboard.php">Dashboard</a> ');
                }
                echo('
                  <hr class="dropdown-divider">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
                </div>
              ');
            }
            else {
              echo ('<a class="btn custom_orange_btn" href="login.php"><i class="fas fa-sign-in-alt"></i> Login/Register</a>');
            }
          ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</section>

<!-- fake margin -->
<section class="fake_margin" style="color: transparent;">fdsahjbflk</section>