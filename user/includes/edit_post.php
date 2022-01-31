<!--<?php include "../../include/db.php"; ?> -->
<?php

if(isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];
    
    }
    global $connection;
    $query = "SELECT * FROM POSTS WHERE post_id = $the_post_id";

    $select_posts_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];
    
    }


    if(isset($_POST['update_post'])) {
        
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_views_count = $_POST['post_views_count'];


        
move_uploaded_file($post_image_temp, "../images/$post_image" );
        
        if(empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }
        
        
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_date = now(), ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_views_count = '{$post_views_count}' ";
        $query .= "WHERE post_id = {$the_post_id} ";
        
        $update_post = mysqli_query($connection, $query);
        
        confirm($update_post);
        
        if(!$update_post) {
            die("QUERY FAILED" . mysqli_error($connetion));
        }
        
        echo "<p class='bg-success'>Post is Updated :" . " " . " <a href='../post.php?p_id={$the_post_id}'>View Post</a>" . " or " . " <a href='posts.php'>Edit More Posts</a></p>";
    }
    
?>
        
<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label class="form-control">Post Title</label>
        <input value="<?php echo $post_title; ?>" class="form-control" type="text" name="post_title">
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Category</label>
        <select name="post_category" id="post_category">
            <?php
            global $connection;
            
            $query = "SELECT * FROM categories";
            
            $select_categories = mysqli_query($connection, $query);
            
            
            confirm($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row["cat_id"];
            $cat_title = $row["cat_title"];
                
            echo "<option value='{$cat_id}'>{$cat_title}</option>" ;
                
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
    <select name='post_status' id=''>
        <option value='<?php echo $post_status; ?>' class="value"><?php echo $post_status;  ?></option>
        
        <?php 
        
        if($post_status == 'published' ) {
             echo "<option value='draft'>draft</option>";
        }
        
        else {
            echo "<option value='published'>published</option>";
        }
         
        ?>
    
    </select>
    </div>
    
    
    <div class="form-group">
        <label class="form-control">Post Image</label>
        <input type="file" name="image">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label class="form-control">Post View Count</label>
        <input value="<?php echo $post_views_count; ?>" type="text" class="form-control" name="post_views_count">
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" rows="10" cols="30">
        <?php echo $post_content; ?>
        </textarea>
    </div>
    
    <div>
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
    
</form>