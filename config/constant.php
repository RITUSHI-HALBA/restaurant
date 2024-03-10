<?php
// session starts
session_start();
// create constant
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'food-order');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD);
$db_select = mysqli_select_db($conn, DB_NAME);
?>