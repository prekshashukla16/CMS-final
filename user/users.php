<?php include '../include/db.php'; ?>
<?php include 'includes/header.php'; ?>
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

</div>
</div>
<!-- /.row -->

   
   
    
    <?php
    if(isset($_GET['source'])) {
        $source = $_GET['source'];
    }
    
    else {
        $source = '';
    }
    
    switch($source) {
        case 'add_user.php';
        include "includes/add_user.php";
        break;
            
        case 'edit_user';
        include "includes/edit_user.php";
        break;
    
        default:
        include "includes/view_all_users.php";
        break;
    }
    ?>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->



<?php include "includes/footer.php" ?>