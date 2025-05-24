<?php include('partials/menu.php'); ?>
 <?php
// Function to get category title by ID
function get_category_title($category_id) {
    global $conn;
    
    if($category_id == 0 || $category_id == null) {
        return "No Category";
    }
    
    $sql2 = "SELECT title FROM category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql2);
    
    if($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        return $row['title'];
    } else {
        return "Category Not Found";
    }
}
?>

    <div class="main-content ">
    <div class="wrapper">

       <h1>Manage food</h1>
       <br></br>
       <?php
            if(isset($_SESSION['add'])) // checking whether the session is set or not
            {
                echo $_SESSION['add']; // Displaying session message
                unset($_SESSION['add']); // Removing session message
            }
            if(isset($_SESSION['remove'])) // checking whether the session is set or not
            {
                echo $_SESSION['remove']; // Displaying session message
                unset($_SESSION['remove']); // Removing session message
            }
            if(isset($_SESSION['delete'])) // checking whether the session is set or not
            {
                echo $_SESSION['delete']; // Displaying session message
                unset($_SESSION['delete']); // Removing session message
            }
            if(isset($_SESSION['no-category-found'])) // checking whether the session is set or not
            {
                echo $_SESSION['no-category-found']; // Displaying session message
                unset($_SESSION['no-category-found']); // Removing session message
            }
            if(isset($_SESSION['update'])) // checking whether the session is set or not
            {
                echo $_SESSION['update']; // Displaying session message
                unset($_SESSION['update']); // Removing session message
            }
            if(isset($_SESSION['upload'])) // checking whether the session is set or not
            {
                echo $_SESSION['upload']; // Displaying session message
                unset($_SESSION['upload']); // Removing session message
            }
            if(isset($_SESSION['failed-remove'])) // checking whether the session is set or not
            {
                echo $_SESSION['failed-remove']; // Displaying session message
                unset($_SESSION['failed-remove']); // Removing session message
            }
        ?>
       <br></br>
       <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
       <br></br>

        <table>
            <tr>
                <th>Sr.No</th>
                <th>Title</th>
                <th >Description</th>
                <th>Price</th>
                <th>Image</th>
                
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <tr>
                <?php
                    // SQL query to get all food
                    $sql = "SELECT * FROM food";
                    // Execute the query
                    $res = mysqli_query($conn, $sql);
                    // Count rows
                    $count = mysqli_num_rows($res);
                    // Create a serial number variable
                    $sn = 1;

                    if ($count > 0) {
                        // Food available
                        while ($row = mysqli_fetch_assoc($res)) {
                            // Get the data
                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                        if($image_name != "") {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        } else {
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                    ?>
                                </td>
                              
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>
                            
                <?php
                        }
                    } else {
                        // Food not available
                        echo "<tr><td colspan='9' class='error'>Food not added yet.</td></tr>";
                    }
                ?>
            
            <!-- Table rows with data would go here -->
        </table>

       
        <div class="clearfix"></div>
</div>    
</div>

<?php include('partials/footer.php'); ?>