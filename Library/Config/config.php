<?php
$con = mysqli_connect("localhost","root","","astro");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
else{
    echo "database setyp domne";
}
?>