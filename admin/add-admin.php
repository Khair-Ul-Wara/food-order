<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        
        <?php 
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name" required></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="user_name" placeholder="Enter your username" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php 
if(isset($_POST['submit'])) {
    // 1. Get the data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = md5($_POST['password']); // password encryption with md5

    // 2. Check if admin with same username already exists
    $check_sql = "SELECT * FROM admin WHERE username='$user_name'";
    $check_res = mysqli_query($conn, $check_sql);
    
    if(mysqli_num_rows($check_res) > 0) {
        // Admin with same username exists
        $_SESSION['add'] = "<div class='error'>Username already exists. Please choose a different username.</div>";
        header('location:'.SITEURL.'admin/add-admin.php');
        exit();
    }
    
    // 3. SQL query to save the data into database
    $sql = "INSERT INTO admin SET 
        fullname='$full_name',
        username='$user_name',
        password='$password'
    ";

    // 4. Execute the query and save in database
    $res = mysqli_query($conn, $sql);

    // 5. Check whether the data is inserted or not
    if($res == TRUE) {
        // Data inserted
        $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        // Failed to insert data
        $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>