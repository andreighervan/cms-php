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
                    if (isset($_POST['submit'])) {
                        $cat_title = $_POST['cat_title'];
                        if ($cat_title == "" || empty($cat_title)) {
                            echo "This field should  not be empty";
                        } else {
                            $query = "INSERT INTO categories (cat_title) ";
                            $query .= "VALUES ('{$cat_title}')";
                            $create_category_query = mysqli_query($conn, $query);
                            if (!$create_category_query) {
                                die("Query failed " . mysqli_error($conn));
                            }
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['delete'])) {
                        $the_cat_id = $_GET['delete'];
                        $query = "DELETE FROM categories WHERE cat_id={$the_cat_id} ";
                        $delete_query = mysqli_query($conn, $query);
                        header("Location:categories.php");
                    }
                    ?>
                    <?php
                    if (isset($_GET['edit'])) {
                        $cat_id = $_GET['edit'];
                        $query = "SELECT * FROM categories WHERE cat_id={$cat_id}";
                        $select_categories_id = mysqli_query($conn, $query);
                    }
                    ?>
                    <form action="categories.php" method="post">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        </div>
                    </form>
                    <input value="<?php if (isset($cat_title)) {
                        echo $cat_title;
                    }; ?>" name="cat_title">
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
                        $query = "SELECT * FROM categories";
                        $select_categories_sidebar = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            ?>
                            <tr>
                                <?php echo "<td>{$cat_id}</td>"; ?>
                                <?php echo "<td>{$cat_title}</td>"; ?>
                                <?php echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a>"; ?>
                                <?php echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a>"; ?>
                            </tr>
                            <?php
                        }
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
