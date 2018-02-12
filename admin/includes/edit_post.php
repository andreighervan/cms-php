<?php
if(isset($_GET['p_id'])){
    $the_post_id=$_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id=$the_post_id";
$select_post_by_id = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_content = $row['post_content'];
    $post_date = date('d-m-y');
}
    ?>
<?php
if(isset($_POST['update_post'])){
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp=$_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_comment_count = 4;
    $post_date = date('d-m-y');
    move_uploaded_file($post_image_temp,"../images/$post_image");
    if(empty($post_image)){
        $query="SELECT * FROM posts WHERE post_id=$the_post_id";
        $select_image=mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }
    $query="UPDATE posts SET ";
    $query.="post_title='{$post_title}', ";
    $query.="post_author='{$post_author}', ";
    $query.="post_category_id='{$post_category_id}', ";
    $query.="post_status='{$post_status}', ";
    $query.="post_image='{$post_image}', ";
    $query.="post_tags='{$post_tags}', ";
    $query.="post_date=now(), ";
    $query.="post_content='{$post_content}' ";
    $query.="WHERE post_id={$the_post_id}";
    $update_post=mysqli_query($conn,$query);
}
?>

    <form action="" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label for="post_title">Post title</label>
            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
        </div>
        <div class="form-group">
            <label for="post_category_id">Post category id</label>
            <select name="post_category" id="" class="form-control" style="width: 150px;">
                <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                }
                echo "<option value='$cat_id'>{$cat_title}</option>";
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_author">Post author</label>
            <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
        </div>
        <div class="form-group">
            <label for="post_status">Post status</label>
            <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
        </div>
        <div class="form-group">
            <label for="post_image">Post image</label><br>
            <img src="../images/<?php echo $post_image;?>" width="100">
            <input type="file"  name="post_image">
        </div>
        <div class="form-group">
            <label for="post_tags">Post tags</label>
            <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
        </div>
        <div class="form-group">
            <label for="post_content">Post content</label>
            <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="update_post" class="btn btn-primary" value="Edit post">
        </div>

    </form>
