<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br></br>   
        <?php   
        //1. Get the ID of selected admin   
        $id = $_GET['id'];  
        //2. Create SQL query to get the details of selected admin  
        $sql = "SELECT * FROM admin WHERE id=$id";  
        //3. Execute the query  
        $res = mysqli_query($conn, $sql);   
        //4. Check whether the query is executed or not 
        if($res==TRUE)  
        {  
            //Check whether the data is available or not  
            $count = mysqli_num_rows($res); //function to get all the rows in database  
            if($count==1)  //check whether we have admin data or not  
            {  
                //Get the details  
                $row = mysqli_fetch_assoc($res);  
                $full_name = $row['fullname'];  
                $username = $row['username'];  
            }  
            else  
            {  
                //Redirect to manage admin page  
                header('location:'.SITEURL.'admin/manage-admin.php');  
            }  
        }   
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>    
        </form>
        <?php   
        //Check whether the button is clicked or not    
        if(isset($_POST['submit']))  
        {  
            //1. Get the values from the form to update  
            $id = $_POST['id'];  
            $full_name = $_POST['full_name'];  
            $username = $_POST['username'];  
            //2. Create SQL query to update admin  
            $sql = "UPDATE admin SET 
                fullname='$full_name',
                username='$username' 
                WHERE id=$id";  
            //3. Execute the query  
            $res = mysqli_query($conn, $sql);  
            //4. Check whether the query executed successfully or not  
            if($res==TRUE)  
            {  
                //Query executed and admin updated  
                $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";  
                header('location:'.SITEURL.'admin/manage-admin.php');  
            }  
            else  
            {  
                //Failed to update admin  
                $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";  
                header('location:'.SITEURL.'admin/manage-admin.php');  
            }  
        }   
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>