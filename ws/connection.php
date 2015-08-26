<?php
  $hostname = 'localhost';
  $database = 'mygram';
  $username = 'u_mygram';
  $password = 'hzVYVmhXcycx2YdW';

  $connection = mysqli_connect($hostname, $username, $password, $database);

  if (mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_error();
  }
?>
