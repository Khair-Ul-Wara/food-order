<?php include('../config/constants.php');
if(isset($_GET['id']) && isset($_GET['image_name'])) {
    // Get the ID and image name from the URL
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image file if it exists
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);
        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    // Delete the category from the database
    $sql = "DELETE FROM category WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>