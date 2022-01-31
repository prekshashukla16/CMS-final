<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>
 
 <?php 

    if(isset($_POST['submit'])) {
        $user_firstname = $_POST['firstname'];
        $user_lastname = $_POST['lastname'];
        $user_name = $_POST['username'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        
        if(!empty( $user_firstname) && !empty( $user_lastname) && !empty( $user_name) && !empty($user_email) && !empty($user_password)) {
            
        
        $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
        $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
        $user_name = mysqli_real_escape_string($connection, $user_name);
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);
        
        $query = "SELECT randSalt FROM users ";
        
        $select_randSalt_query = mysqli_query($connection, $query );
       
        if(!$select_randSalt_query) {
            die("FAILED QUERY" . mysqli_error($connection));
        }
        
        $row = mysqli_fetch_array($select_randSalt_query);
            
            $salt = $row['randSalt'];
            
            $user_password = crypt($user_password, $salt);
        
        $query = "INSERT INTO users(user_firstname, user_lastname, username,  user_email, user_password, user_role) ";

        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_name}','{$user_email}','{$user_password}','subscriber' ) ";

    $register_user = mysqli_query($connection, $query);
        
     if(!$register_user) {
            die("FAILED QUERY" . mysqli_error($connection));
     }
            
            $message = "Your registeration is complete.";
        }
        
        else {
            $message = "The fields cannot be empty";
        }
        
    }

    else {
        $message = "";
    }
        

 ?>
    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                    <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
                        </div>
                         <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
