<?php
include('../config/constants.php'); ?>

<html>
<head>
    <title>Food-order Login System</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">

</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>
        <?php
        // Display session message
        if(isset($_SESSION['login'])){
            echo $_SESSION['login']; // Display session message
            unset($_SESSION['login']); // Remove session message
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message']; // Display session message
            unset($_SESSION['no-login-message']); // Remove session message
        }
        ?>
        <form action="" method="POST" class="text-center">

          Username:  <input type="text" name="username" placeholder="Username" required><br><br>

          Password:  <input type="password" name="password" placeholder="Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary" ><br><br>
 
    <p class="text-center">Created by - <a href="#">Khair Ul Wara</a></p>

    </form>
    </div>
    <html>
<?php
// Check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    // Process for login
    // 1. Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password encryption with md5

    // 2. SQL query to check whether the user with username and password exists or not
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    // 3. Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1){
        // User available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset it

        // Redirect to home page/dashboard
        header('location:'.SITEURL.'admin/index.php');
    }else{
        // User not available and login failed
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        // Redirect to login page   
        header('location:'.SITEURL.'admin/login.php');
    }
}
?>
    