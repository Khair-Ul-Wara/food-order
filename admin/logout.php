<?php
include('../config/constants.php'); // Include constants.php file
session_destroy(); // Destroy the session
header('location:'.SITEURL.'admin/login.php'); // Redirect to login page
?>