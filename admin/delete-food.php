<?php include('../config/constants.php'); 
if(isset($_GET['id']) && isset($_GET['image_name'])) {
    // Get the ID and image name from the URL
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image file if it exists
    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        $remove = unlink($path);

        // Check if the image was removed successfully
        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to remove food image.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    // Delete the food from the database
    $sql = "DELETE FROM food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
