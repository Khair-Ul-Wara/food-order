<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br></br>

        <?php
            if(isset($_SESSION['add'])) // checking whether the session is set or not
            {
                echo $_SESSION['add']; // Displaying session message
                unset($_SESSION['add']); // Removing session message
            }
            if(isset($_SESSION['upload'])) // checking whether the session is set or not
            {
                echo $_SESSION['upload']; // Displaying session message
                unset($_SESSION['upload']); // Removing session message
            }
        ?>

        <br></br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
        </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
        </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['submit'])) // checking whether the submit button is clicked or not
        {
            // 1. Get the value from the form
            $title = $_POST['title'];
            // For radio input, we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No"; // Default value
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No"; // Default value
            }

            // 2. Upload the image if selected
            // Check whether the image is selected or not and set the value for image name accordingly
            if(isset($_FILES['image']['name']))
            {
                // Upload the image
                $image_name = $_FILES['image']['name']; // Getting the image name
                if($image_name != "")
                {
                    // Auto rename our image
                    $ext = end(explode('.', $image_name)); // Getting the extension of the image
                    $image_name = "Category_".rand(000, 999).'.'.$ext; // Renaming the image

                }
                else
                {
                    $image_name = ""; // Default value as blank
                }

                // Uploading the image to the folder
                $source_path = $_FILES['image']['tmp_name']; // Source path of the image
                $destination_path = "../images/category/".$image_name; // Destination path of the image

                // Finally, upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                if($upload==false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }
            }
            else
            {
                $image_name = ""; // Default value as blank
            }

            // 3. Insert into database
            $sql = "INSERT INTO category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'";

            // Execute query and save in database
            $res = mysqli_query($conn, $sql);

            // Check whether data is inserted or not
            if($res==true)
            {
                $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                header('location:'.SITEURL.'admin/add-category.php');
            }   
        }
        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>