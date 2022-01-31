<?php include '../include/db.php'; ?>
<?php include 'includes/header.php'; ?>



<?php

    if(isset($_SESSION['user_name'])) {
        
        $user_name = $_SESSION['user_name'];
        
        $query = " SELECT * FROM users WHERE username = '{$user_name}' ";
        
        $user_query = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_array($user_query)) {
                $user_id = $row['user_id'];
                $user_name = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role= $row['user_role'];

        }
    }

    ?>
    
    <?php

if(isset($_POST['edit_profile'])) {

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
//        
//    move_uploaded_file($user_image_temp, "../images/$user_image" );
//    



        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role ='{$user_role}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "username = '{$user_name}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE username = '{$user_name}' ";
        
        $edit_user_id = mysqli_query($connection, $query);
        
        confirm($edit_user_id);
        
        if(!$edit_user_id) {
            die("QUERY FAILED" . mysqli_error($connetion));
        }
        
        }

?>

<div id="wrapper">



<!-- Navigation -->
<?php include "includes/navigation.php"; ?>




<div id="page-wrapper">

<div class="container-fluid">


<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
Welcome to ADMIN


<small><?php 

    echo $_SESSION['user_name'];
    
        ?>
</small>
</h1>
        

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
        
         <option value="subscriber"
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
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>

    
    <div>
        <input class="btn btn-primary" type="submit" name="edit_profile" value="Edit Profile">
    </div>
    
</form>    
    
</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->


</div>

     
        <!-- /#page-wrapper -->
        


<?php include "includes/footer.php" ?>