<?php
if(isset($_POST['edit_user'])){
    $the_user_id=$_GET['edit_user'];
    $username=$_POST['username'];
    $user_firstname=$_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_password=$_POST['user_password'];
    $query="INSERT INTO users (user_firstname,user_lastname,user_role,username,user_email,user_password) ";
    $query.="VALUES ('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";
    $create_user_query=mysqli_query($conn,$query);
    if(!$create_user_query){
        die('query failed '.mysqli_error($conn));
    }

}
?>
<form action="" method="post">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_role">User role</label>
        <select name="user_role" id="" class="form-control" style="width: 150px;">
            <option value="subscriber">Select option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control"  name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input type="submit" name="edit_user" class="btn btn-primary" value="Add user">
    </div>

</form>