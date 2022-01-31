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
Welcome to Dashboard


<small><?php 

    echo $_SESSION['user_name'];
     $_SESSION['user_id'];
    
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
        case 'add_posts.php';
        include "includes/add_posts.php";
        break;
            
        case 'edit_post';
        include "includes/edit_post.php";
        break;
    
        default:
        include "includes/view_all_posts.php";
        break;
    }
    ?>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->


<?php include "includes/footer.php" ?>