<!-- 
  Details about hosting
 -->

<?php 
  define('db_server', 'localhost');
  define("db_username", "root");
  define("db_password", "");
  define("db_name", "buykaro");

  $conn = mysqli_connect(db_server, db_username, db_password, db_name);

  // to check connection 
  if(!$conn) {
    echo("Error : Cannot connect to the server...");
  }
?>