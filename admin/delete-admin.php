<?php include('../config/constants.php');
$id = $_GET['id'];  //get the id of admin to be deleted 
//create sql query to delete admin  
$sql = "DELETE FROM admin WHERE id=$id"; //sql query to delete admin    
//execute the query 
$res = mysqli_query($conn, $sql); //execute the query   
//check whether the query is executed or not    
if($res==TRUE) //if query executed successfully 
{
    //create session variable to display message 
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>"; //create session variable and assign value to it 
    header('location:'.SITEURL.'admin/manage-admin.php'); //redirect to manage admin page 
}
else //if query not executed successfully 
{   
    //create session variable to display message 
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later.</div>"; //create session variable and assign value to it 
    header('location:'.SITEURL.'admin/manage-admin.php'); //redirect to manage admin page 
}   
