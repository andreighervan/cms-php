<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username=$row['username'];
        $user_firstname=$row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        ?>
        <tr>
            <?php echo "<td>$user_id</td>"; ?>
            <?php echo "<td>$username</td>"; ?>
            <?php echo "<td>$user_firstname</td>"; ?>
            <?php echo "<td>$user_lastname</td>"; ?>
            <?php echo "<td>$user_email</td>";?>
            <?php echo "<td>$user_role</td>";?>
            <?php
           /* $query="SELECT * FROM posts WHERE post_id=$comment_post_id ";
            $select_post_id_query=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                ?>
                <?php echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>"; ?>

                <?php
            }*/
            ?>
            <?php echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>"; ?>
            <?php echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>"; ?>
            <?php echo "<td><a href='users.php?edit_user={$user_id}'>Edit</a></td>"; ?>
            <?php echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>"; ?>
        </tr>
        <?php
    }
    ?>
    <?php
    if(isset($_GET['delete'])){
        $the_user_id=$_GET['delete'];
        $query="DELETE FROM users  WHERE user_id={$the_user_id}";
        $delete_user_query=mysqli_query($conn,$query);
        header("Location:users.php");
    }
    ?>
    <?php
    if(isset($_GET['change_to_admin'])){
        $the_user_id=$_GET['change_to_admin'];
        $query="UPDATE users SET user_role='admin' WHERE user_id=$the_user_id ";
        $change_to_admin_query=mysqli_query($conn,$query);
        header("Location:users.php");
    }
    ?>
    <?php
    if(isset($_GET['change_to_sub'])){
        $the_user_id=$_GET['change_to_sub'];
        $query="UPDATE users SET user_role='subscriber' WHERE user_id=$the_user_id ";
        $change_to_sub_query=mysqli_query($conn,$query);
        header("Location:users.php");
    }
    ?>
    </tbody>
</table>