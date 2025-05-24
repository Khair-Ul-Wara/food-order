<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM food WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 && mysqli_num_rows($res2) == 1) {
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $category_id = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();
            }
        } else {
            header('location:'.SITEURL.'admin/manage-food.php');
            exit();
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" rows="5" cols="30"><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" required></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                        if ($current_image != "") {
                            echo "<img src='" . SITEURL . "images/food/" . $current_image . "' width='150px'>";
                        } else {
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" required>
                            <option value="">Select Category</option>
                            <?php
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            if ($res && mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $cid = $row['id'];
                                    $ctitle = $row['title'];
                                    $selected = $category_id == $cid ? "selected" : "";
                                    echo "<option value='$cid' $selected>$ctitle</option>";
                                }
                            } else {
                                echo "<option value=''>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == "No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if ($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get all the values
            $id = $_POST['id'];
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category_id = isset($_POST['category']) ? $_POST['category'] : 0;
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $image_name = $current_image;

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $original_name = $_FILES['image']['name'];
                $ext = pathinfo($original_name, PATHINFO_EXTENSION);
                $image_name = "Food-Name-" . rand(1000, 9999) . "." . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if (!$upload) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    exit();
                }

                if ($current_image != "" && file_exists("../images/food/" . $current_image)) {
                    unlink("../images/food/" . $current_image);
                }
            }

            // Update database
            $sql3 = "UPDATE food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category_id,
                featured = '$featured',
                active = '$active'
                WHERE id = $id";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3) {
                $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
            }
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit();
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
