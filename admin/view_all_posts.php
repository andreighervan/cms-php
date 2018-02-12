<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Content</th>
        <th>Date</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_content = $row['post_content'];
        $post_date = date('d-m-y');
        ?>
        <tr>
            <?php echo "<td>$post_id</td>"; ?>
            <?php echo "<td>$post_author</td>"; ?>
            <?php echo "<td>$post_title</td>"; ?>
            <?php
            $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
            $select_categories_id = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_title = $row['cat_title'];
            }
            ?>
            <?php echo "<td>{$cat_title}</td>"; ?>



            <?php echo "<td>$post_status</td>"; ?>
            <?php echo "<td><img src='../images/$post_image' class='img-responsive' width='100'/></td>"; ?>
            <?php echo "<td>$post_tags</td>"; ?>
            <?php echo "<td>$post_comments</td>"; ?>
            <?php echo "<td>$post_content</td>"; ?>
            <?php echo "<td>$post_date</td>"; ?>
            <?php echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>"; ?>
            <?php echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>"; ?>
        </tr>
        <?php
    }
    ?>
    <?php
    if(isset($_GET['delete'])){
       $the_post_id=$_GET['delete'];
        $query="DELETE FROM posts WHERE post_id={$the_post_id}";
        $delete_query=mysqli_query($conn,$query);
        header("Location:posts.php");
    }
    ?>
    </tbody>
</table>