<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('location: manage-admin.php');
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form> 
        <?php
        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
            // Get the values from the form
            // Current Password, New Password, Confirm Password
            $current_password =md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
            // Check if the current password is correct
            $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";
            // Execute the query
            $res = mysqli_query($conn, $sql);
            if($res==TRUE) {
                $count = mysqli_num_rows($res);
                if($count==1) {
                    if($new_password==$confirm_password) {
                        $sql2 = "UPDATE admin SET password='$new_password' WHERE id=$id";
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2==TRUE) {
                            $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                            header('location: manage-admin.php');
                        } else {
                            $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                            header('location: manage-admin.php');
                        }
                    } else {
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match.</div>";
                        header('location: manage-admin.php');
                    }
                } else {
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                    header('location: manage-admin.php');
                }
            }
        }
    ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>