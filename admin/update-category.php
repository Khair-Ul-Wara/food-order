<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br></br>
        <?php
            if(isset($_SESSION['update'])) // checking whether the session is set or not
            {
                echo $_SESSION['update']; // Displaying session message
                unset($_SESSION['update']); // Removing session message
            }
        ?>
        <br></br>

        <?php
            // Get the ID of the category to be updated
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                // SQL query to get the details of the selected category
                $sql = "SELECT * FROM category WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                
                if($count == 1) {
                    // Category found
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    // Category not found
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            } else {
                // Redirect to manage category page if ID is not set
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != "") {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            } else {
                                echo "<div class='error'>Image not added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>   
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            // Check if the form is submitted
            if(isset($_POST['submit'])) {
                // Get the values from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Check if a new image is selected
                if(isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    // Upload the new image if selected
                    if($image_name != "") {
                        // Auto rename our image
                        $ext = end(explode('.', $image_name)); // Get the extension of the image
                        $image_name = "Category_".rand(000, 999).'.'.$ext; // Rename the image

                        // Source path and destination path
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/category/".$image_name;

                        // Upload the image
                        $upload = move_uploaded_file($src, $dst);

                        // Check if the image is uploaded
                        if($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }

                        // Remove the current image if it exists
                        if($current_image != "") {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove == false) {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image; // Keep the current image name
                    }
                } else {
                    $image_name = $current_image; // Keep the current image name
                }

                // Update the category in the database
                $sql2 = "UPDATE category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Check if the query executed successfully
                if($res2 == true) {
                    $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
        <div class="clearfix"></div>
        <?php include('partials/footer.php'); ?>
    </div>
</div>