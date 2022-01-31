<?php


if(isset($_GET['edit_user'])) {
   $the_user_id = $_GET['edit_user'];
    
    global $connection;
    $query = "SELECT * FROM users WHERE user_id=$the_user_id";

    $select_user_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_user_id)) {
    $user_id = $row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
    $user_name = $row['username'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
//    $post_comment_count = $row['post_comment_count'];
//    $post_date = $row['post_date'];
//    
    }
    
}
    

if(isset($_POST['edit_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    //$post_date = date('user_email');
//    $user_image = $_FILES['image']['name'];
//    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    //$post_comment_count = 4 ;
    $user_password = $_POST['user_password'];
        
//    move_uploaded_file($user_image_temp, "../images/$user_image" );
//    
//    
//     if(empty($user_image)) {
//            $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
//            
//            $select_user_image = mysqli_query($connection, $query);
//            
//            while($row = mysqli_fetch_array($select_user_image)) {
//                $user_image = $row['user_image'];
//            }
//        }
//    
        $query = "SELECT randSalt FROM users ";
        
        $select_randSalt_query = mysqli_query($connection, $query );
       
        if(!$select_randSalt_query) {
            die("FAILED QUERY" . mysqli_error($connection));
        }
        
        $row = mysqli_fetch_array($select_randSalt_query);
            
        $salt = $row['randSalt'];
            
        $hash_password = crypt($user_password, $salt);


        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role ='{$user_role}', ";
//        $query .= "user_image = '{$user_image}', ";
        $query .= "username = '{$user_name}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hash_password}' ";
        $query .= "WHERE user_id = {$the_user_id} ";
        
        $edit_user_id = mysqli_query($connection, $query);
        
        confirm($edit_user_id);
        
        if(!$edit_user_id) {
            die("QUERY FAILED" . mysqli_error($connetion));
        }
        
    
        echo "<p class='bg-success'>User is Updated :" . " " . " <a href='users.php'>View Users?</a></p>";
        }
?>
  

<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label class="form-control">Firstname</label>
        <input  value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label class="form-control">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    
     <div class="form-group">
        <label class="form-control">User Role</label>
        <select name="user_role" id="user_role">
        
         <option value="<?php echo $user_role; ?>"
         ><?php echo $user_role; ?></option>
         
         
         <?php
            
            if($user_role == 'admin') {
                echo "<option value='subscriber'>subscriber</option>" ;
            }
            
            else {
                echo "<option value='admin'>admin</option>";
            }
            
        ?>
         
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-control">Image</label>
        <input type="file" class="form-control" name="image">
        <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
        
    </div>
    
    <div class="form-group">
        <label class="form-control">Username</label>
        <input value="<?php echo $user_name; ?>" type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
        <label class="form-control">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    
    
    <div class="form-group">
        <label class="form-control">Password</label>
        <input type="password" value="<?php //echo 
    //$user_password; 
        ?>" autocomplete="off" class="form-control" name="user_password">
    </div>

    
    <div>
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
    
</form>