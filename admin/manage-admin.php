<?php include('partials/menu.php'); ?>

<div class="main-content ">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br></br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br></br>
       <?php
       if(isset($_SESSION['add'])) // checking whether the session is set or not
       {
           echo $_SESSION['add']; // Displaying session message
           unset($_SESSION['add']); // Removing session message}
       }
       if(isset($_SESSION['delete'])) // checking whether the session is set or not
       {
           echo $_SESSION['delete']; // Displaying session message
           unset($_SESSION['delete']); // Removing session message}
       }
         if(isset($_SESSION['update'])) // checking whether the session is set or not
         {
              echo $_SESSION['update']; // Displaying session message
              unset($_SESSION['update']); // Removing session message}
         }
            if(isset($_SESSION['user-not-found'])) // checking whether the session is set or not
            {
                echo $_SESSION['user-not-found']; // Displaying session message
                unset($_SESSION['user-not-found']); // Removing session message}
            }
            if(isset($_SESSION['pwd-not-match'])) // checking whether the session is set or not
            {
                echo $_SESSION['pwd-not-match']; // Displaying session message
                unset($_SESSION['pwd-not-match']); // Removing session message}
            }
            if(isset($_SESSION['change-pwd'])) // checking whether the session is set or not
            {
                echo $_SESSION['change-pwd']; // Displaying session message
                unset($_SESSION['change-pwd']); // Removing session message}
            }
            if(isset($_SESSION['update-pwd'])) // checking whether the session is set or not
            {
                echo $_SESSION['update-pwd']; // Displaying session message
                unset($_SESSION['update-pwd']); // Removing session message}
            }
           
       ?>


        <table>
            <tr>
                <th>Sr.No</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>action</th>
            </tr>
<?php 
//query to get all admin
$sql = "SELECT * FROM admin";
//execute the query 
$res = mysqli_query($conn, $sql);
//check whether the query is executed or not    
if($res==TRUE)  
{
    $count = mysqli_num_rows($res); //function to get all the rows in database
    $sn=1; //create a variable and assign the value of 1 to it  
}
//check whether we have data in database or not 
if($count>0) //if count is greater than 0 then we have data in database 
{
    while($rows=mysqli_fetch_assoc($res)) //while loop to get all the data from database 
    {
        //get the individual data 
        $id = $rows['id'];
        $full_name = $rows['fullname'];
        $username = $rows['username'];
        ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
        <?php
    }
}
else //if count is not greater than 0 then we don't have data in database   
{
    //we don't have data in database    
    echo "<tr><td colspan='6'><div class='error'>Admin not added yet.</div></td></tr>";
}
?>  
        </table>


        <div class="clearfix"></div>
    </div>    
</div>

<?php include('partials/footer.php'); ?>