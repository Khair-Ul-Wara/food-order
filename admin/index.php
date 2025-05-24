<?php include('partials/menu.php'); ?>

    <div class="main-content ">
    <div class="wrapper">

       <h1>Dashboard</h1>
       <br><br>
       <?php
        // Display session message
        if(isset($_SESSION['login'])){
            echo $_SESSION['login']; // Display session message
            unset($_SESSION['login']); // Remove session message
        }
        ?>
       <div class="col-4 text-center">
        
            <h1>5</h1>
            <br>
            <p>Categories</p>
        </div>
        <div class="col-4 text-center">
        
            <h1>5</h1>
            <br>
            <p>Categories</p>
        </div>
        <div class="col-4 text-center">
        
            <h1>5</h1>
            <br>
            <p>Categories</p>
        </div>
        <div class="col-4 text-center">
        
            <h1>5</h1>
            <br>
            <p>Categories</p>
        </div>
        
        <div class="clearfix"></div>
        
</div>
</div>
<?php include('partials/footer.php'); ?>
