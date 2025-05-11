<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br></br>
       
        <br></br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="user_name" placeholder="Enter your user name"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
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
if(isset($_POST['submit'])){
    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']); // password encryption with md5

    //2. SQL query to save the data into database
    $sql = "INSERT INTO admin SET 
        fullname='$full_name',
        username='$user_name',
        password='$password'
    ";

    //3. Execute the query and save in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //4. Check whether the (query is executed) data is inserted or not and display appropriate message
    if($res==TRUE){
        //Data inserted
        $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        //Failed to insert data
        $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}