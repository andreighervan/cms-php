<?php
if(isset($_POST['create_post'])){
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp=$_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_comment_count = 4;
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    move_uploaded_file($post_image_temp,"../images/$post_image");
    $query="INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
    $query.="VALUES ('{$post_category_id}','{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}') ";
    $create_post_query=mysqli_query($conn,$query);
    if(!$create_post_query){
        die('query failed '.mysqli_error($conn));
    }
}
?>
<form action="" enctype="multipart/form-data" method="post">
    <div class="form-group">
        <label for="post_title">Post title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post category id</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post image</label>
        <input type="file"  name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post content</label>
       <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish post">
    </div>

</form>