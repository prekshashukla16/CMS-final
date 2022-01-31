<?php

if(isset($_POST['create_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    //$post_date = date('user_email');
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    //$post_comment_count = 4 ;
    $user_password = $_POST['user_password'];
        
    move_uploaded_file($user_image_temp, "../images/$user_image" );

    $query = "SELECT randSalt FROM users ";
        
        $select_randSalt_query = mysqli_query($connection, $query );
       
        if(!$select_randSalt_query) {
            die("FAILED QUERY" . mysqli_error($connection));
        }
        
        $row = mysqli_fetch_array($select_randSalt_query);
            
            $salt = $row['randSalt'];
            
            $user_password = crypt($user_password, $salt);

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_image, username,  user_email, user_password) ";

    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_image}','{$user_name}','{$user_email}','{$user_password}') ";

    $create_user = mysqli_query($connection, $query);

    confirm($create_user);  
    
    
    echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";
    
    }

?>
  

<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label class="form-control">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label class="form-control">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
     <div class="form-group">
        <label class="form-control">User Role</label>
        <select name="user_role" id="user_role">
        
         <option value="subscriberss"
         >Select Option</option>
        <option value="admin">Admin</option>    
        <option value="subscriber">Subscriber</option>
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-control">Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    <div class="form-group">
        <label class="form-control">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
        <label class="form-control">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    
    <div class="form-group">
        <label class="form-control">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    
    <div>
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
    
</form>