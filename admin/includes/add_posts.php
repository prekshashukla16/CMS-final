<?php

if(isset($_POST['create_post'])) {
    
    $post_category_id = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_date = date('d-m-y');
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    //$post_comment_count = 4 ;
    $post_status = $_POST['post_status'];
        
    move_uploaded_file($post_image_temp, "../images/$post_image" );


    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    
    $query .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);
    
    confirm($create_post_query);
    
     if(!$create_post_query) {
            die("QUERY FAILED" . mysqli_error($connetion));
        }
    
       
        $the_post_id = mysqli_insert_id($connection);
        
        echo "<p class='bg-success'>Post is Created :" . " " . " <a href='../post.php?p_id={$the_post_id}'>View Post</a>" . " or " . " <a href='posts.php'>Edit More Posts</a></p>";
    
    }

?>
  

<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label class="form-control">Post Title</label>
        <input class="form-control" type="text" name="post_title">
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
        <input type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
    <label class="form-control">Post Status</label>
    <select name='post_status' id=''>
        <option value="draft">Select Option</option>
        <option value="draft">Draft</option>
        <option value="published">Publish</option>
    
    </select>
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label class="form-control">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" rows="10" cols="30"></textarea>
    </div>
    
    <div>
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
    
</form>