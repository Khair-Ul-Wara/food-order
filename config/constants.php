<?php
session_start(); // Start the session
define('SITEURL', 'http://localhost/food-order/'); // Define the site URL
define('LOCALHOST', 'localhost'); // Define the localhost
define('DB_USERNAME', 'root'); // Define the database username
define('DB_PASSWORD', ''); // Define the database password
define('DB_NAME', 'food-order'); // Define the database name

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); // Connect to the database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Select the database
