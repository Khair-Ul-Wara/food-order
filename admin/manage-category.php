<?php include('partials/menu.php'); ?>

    <div class="main-content ">
    <div class="wrapper">

       <h1>Manage Category</h1>
       <br></br>
       <a href="add-admin.php" class="btn-primary">Add Category</a>
       <br></br>

        <table>
            <tr>
                <th>Sr.No</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>action</th>
            </tr>

            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>johndoe</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            <!-- Table rows with data would go here -->
        </table>

       
        <div class="clearfix"></div>
</div>    
</div>

<?php include('partials/footer.php'); ?>