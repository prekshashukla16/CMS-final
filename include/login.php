<?php include "db.php"; ?>

<?php session_start(); ?>

<?php

    if(isset($_POST['login'])) {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];    
    
    $user_name = mysqli_real_escape_string($connection, $user_name);
        
    $user_password = mysqli_real_escape_string($connection, $user_password);
    
    $query = "SELECT * from users WHERE username = '{$user_name}' ";
        
    $select_user = mysqli_query($connection, $query);
        if(!$select_user) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        
        
        while($row = mysqli_fetch_array($select_user)) {
            
            $db_user_id = $row['user_id'];
            $db_user_name = $row['username'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            $db_user_password = $row['user_password'];
            
        }
        
         $user_password = crypt($user_password, $db_user_password);
        
        if($user_name === $db_user_name && $user_password === $db_user_password) {
            
            echo $_SESSION['user_id'] =$db_user_id;
            $_SESSION['user_name'] =$db_user_name;
            $_SESSION['user_firstname'] =$db_user_firstname;
            $_SESSION['user_lastname'] =$db_user_lastname;
            $_SESSION['user_role'] =$db_user_role;
        
            
            if($_SESSION['user_role'] == 'admin'){
                
                header("Location: ../admin");
            }
            else {
                header("Location: ../user");
            }

        }
        
        
        else {
            
            header("Location: ../index.php");
        
            }
    }

?>