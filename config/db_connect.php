<?php 

// create connection to db
$conn = mysqli_connect('localhost', 'test123', 'test123', 'customers_db');

// check connection
  if(!$conn){
    echo 'Connection Error ' . mysqli_connect_error();
  }

?>
