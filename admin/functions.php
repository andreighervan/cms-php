<?php

function insert_categories(){
    global $conn;
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
}

function find_all_categories(){
    global $conn;
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
}

function delete_categories(){
    global $conn;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$the_cat_id} ";
        $delete_query = mysqli_query($conn, $query);
        header("Location:categories.php");
    }
}
