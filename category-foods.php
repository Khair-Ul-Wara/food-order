<?php include('partials/menu.php'); ?>
<?php
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    // Get category title based on id
    $sql = "SELECT title FROM category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    // Redirect to home page if category_id is not set
    header('location:'.SITEURL);
}
?>
<section class="food-search text-center">
        <div class="container">
            
            <h2>Foods in <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            // Get foods from database based on category id
            $sql = "SELECT * FROM food WHERE category_id=$category_id AND active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            // Check whether food available or not
            if ($count > 0) {
                // Food available
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            // Check whether image is available or not
                            if ($image_name == "") {
                                // Image not available
                                echo "<div class='error'>Image not available</div>";
                            } else {
                                // Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price ">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Food not available
                echo "<div class='error'>Food not available</div>";
            }
            ?>
            <div class="clearfix"></div>




            

            

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials/footer.php'); ?>
    <!-- footer Section Ends Here -->

</body>
</html>