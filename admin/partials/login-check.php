<?php
if(isset($_SESSION['user'])){
    // User is logged in
}else{
    // User is not logged in
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}