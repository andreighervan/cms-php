<?php
include 'includes/admin_header.php';
?>
<div id="wrapper">

    <?php
    include 'includes/admin_navigation.php';
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-xs-6">
                    <h1 class="page-header">
                        Categories
                    </h1>
                    <?php

                    insert_categories()

                    ?>
                    <?php

                    delete_categories()

                    ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        </div>
                    </form>
<?php
if(isset($_GET['edit'])) {

$cat_id=$_GET['edit'];
    include 'includes/update_categories.php';

}
?>

                </div>
                <div class="col-xs-6">
                    <h1>Categories list</h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        find_all_categories()

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
include 'includes/admin_footer.php';
?>
