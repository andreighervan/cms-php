<?php
include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
            }
            $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
            $select_all_posts_query = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>

                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span
                        class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
            }
            ?>
            <?php
            if (isset($_POST['create_comment'])) {
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
                $query .= "VALUES ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";
                $create_comment_query = mysqli_query($conn, $query);
                $query2 = "UPDATE posts SET post_comment_count=post_comment_count+1 ";
                $query2 .= "WHERE post_id=$the_post_id";
                $update_comment_count = mysqli_query($conn, $query2);
            }
            ?>
            <form action="" method="post">
                <div>
                    <label for="author">Author</label>
                    <input type="text" name="comment_author" class="form-control">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="comment_email" class="form-control">
                </div>
                <div>
                    <label for="comment">Comment</label>
                    <textarea name="comment_content" class="form-control"></textarea>
                </div>
                <div>
                    <br>
                    <input type="submit" name="create_comment" class="btn btn-primary">
                </div>
            </form>
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id={$the_post_id} ";
            $query .= "AND comment_status='approve' ";
            $query .= "ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($conn, $query);
            if (!$select_comment_query) {
                die("QUERY FAILED " . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                ?>
                <h4><?php echo $comment_author; ?></h4>
                <small><?php echo $comment_date; ?></small>
                <p><?php echo $comment_content; ?></p>
                <?php
            }
            ?>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <?php
        include 'includes/sidebar.php';
        ?>

    </div>
    <!-- /.row -->

    <?php
    include 'includes/footer.php';
    ?>
