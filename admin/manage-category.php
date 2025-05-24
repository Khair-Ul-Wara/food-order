<?php include('partials/menu.php'); ?>

    <div class="main-content ">
    <div class="wrapper">

       <h1>Manage Category</h1>
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
       <a href="<?php echo SITEURL ;?>admin/add-category.php" class="btn-primary">Add Category</a>
       <br></br>

        <table>
            <tr>
                <th>Sr.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM category ";
                 // Query to get all categories
            $res = mysqli_query($conn, $sql); // Executing query
            $count = mysqli_num_rows($res); // Getting the number of rows in the database
            $sn = 1; // Creating a variable and assigning value to it
            if($count>0) // Checking whether the data is available in the database
            {
                while($row=mysqli_fetch_assoc($res)) // Fetching data from the database
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                                if($image_name!="") // Checking whether the image is available or not
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div class='error'>Image not added.</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                // We do not have data in the database
                echo "<tr><td colspan='6' class='error'>Category not added yet.</td></tr>";
            }
            ?>

            
            <!-- Table rows with data would go here -->
        </table>

       
        <div class="clearfix"></div>
</div>    
</div>

<?php include('partials/footer.php'); ?>