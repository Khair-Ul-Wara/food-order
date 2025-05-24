<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
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
                        <input type="text" name="title" placeholder="Food Title" required>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" rows="5" cols="30" placeholder="Food Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Food Price" required>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <option value="">Select Category</option>
                            <?php
                                // PHP code to fetch categories from the database
                                $sql = "SELECT * FROM category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">Category not available</option>
                                    <?php
                                }
                            ?>
                            <!-- Options for categories will be populated here -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input  type="radio" name="featured" value="Yes"> Yes
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

            </form>
            <?php 
            if(isset($_POST['submit'])) {
                // Get the values from the form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No"; // Default value
                }
              if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No"; // Default value
                }
                // Check if image is selected
                if (isset($_FILES['image']['name'])) {
                    // Upload the image
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") {
                        // Rename the image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food-Name-" . rand(000, 999) . '.' . $ext;

                        // Upload the image
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/" . $image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check if image upload was successful
                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            header('location:' . SITEURL . 'admin/add-food.php');
                            die();
                        }
                    }
                } else {
                    // Set default image name if no image is selected
                    $image_name = "";
                }

                // Insert food into database
                $sql2 = "INSERT INTO food SET 
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                ";

                // Execute query
                $res2 = mysqli_query($conn, $sql2);

                // Check if food was added successfully
                if ($res2 == true) {
                    $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                    header('location:' . SITEURL . 'admin/add-food.php');
                }
            }   
            ?>

    </div>
</div>