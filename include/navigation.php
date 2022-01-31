<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<?php include "db.php"; ?>
<?php session_start(); ?>
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS Front</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
        if(isset($_SESSION['user_role'])) {
          if($_SESSION['user_role'] == 'admin') {
              
         ?>
           <li>
                <a href="admin">Admin</a>
            </li>
            
            <?php
              
               }
            else 
            {
            ?>
             <li>
                <a href="user"><?php
               echo  $_SESSION['user_name'];
                ?></a>
            </li>
            <?php
            }
            }
            ?>
            
            <?php
            
                if(isset($_SESSION['user_role'])) {
                    
                    if(isset($_GET['p_id'])){
                        
                        $the_post_id = $_GET['p_id'];
                        
                        echo "<li>
                <a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a>
            </li>";
                    }
                }
            
            ?>
            <li>
              <?php
               if(!isset($_SESSION['user_role'])) {
               ?>
                <a href="registeration.php">Registeration</a>
                
                <?php }
                else {
                    
                ?>
                
                <?php
                    ?>
                    <a href="include/logout.php">Logout</a>
                <?php
                }
                ?>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
