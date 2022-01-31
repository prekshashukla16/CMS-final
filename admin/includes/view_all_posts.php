<?php

    if(isset($_POST['checkBoxArray'])) {
            
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            
           $bulk_options = $_POST['bulk_options'];
            
            switch($bulk_options) {
                case 'published': {
                    
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                    
                    $post_publish = mysqli_query($connection, $query);
                    
                    confirm($post_publish);
                    
                    break;
                }
                
                case 'draft': {
                    
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                    
                    $post_draft = mysqli_query($connection, $query);
                    
                     confirm($post_draft);
                    
                    break;
                }
                    
                    
                    
                case 'clone':
                    
                    $query = "SELECT * FROM posts WHERE post_id = {$checkBoxValue} ";
                    
                    $select_post_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_array($select_post_query)) {
                    
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        //$post_comment_count = 4 ;
                        $post_status = $row['post_status'];
                        
                    }

                        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    
    $query .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

    $clone_posts = mysqli_query($connection, $query);
    
     if(!$clone_posts) {
            die("QUERY FAILED" . mysqli_error($connection));
                        }

                    break;
                    
                    
                case 'delete': {
                    
                    $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                    
                    $post_delete = mysqli_query($connection, $query);
                    
                     confirm($post_delete);
                    
                    break;
                }
            }
            
        }
    }


?>
<?php include "../include/db.php"; ?>

<form action="" method="post">
<table class="table table-bordered table-hover">

       <div class="col-xs-4" id="bulkOptionContainer">
           <select name="bulk_options" id="" class="form-control">
               <option value="">Select Options</option>
               <option value="published">Publish</option>
               <option value="draft">Draft</option>
                <option value="clone">Clone</option>
               <option value="delete">Delete</option>
           </select>
       </div>
       
       <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-sucess" value="Apply"><a class="btn btn-primary" href='posts.php?source=add_posts.php'>Add New</a>
       </div>
       
        <thead>
            <tr>
               <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Images</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Count</th>
                <th>View Post</th>
                <th colspan="2">Update</th>
            </tr>
        </thead>
           <tbody>
               
    <?php
    global $connection;
    $query = "SELECT * FROM posts ORDER BY post_id DESC ";

    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];
    
    echo "<tr>";
    ?>
    <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
    
    <?php
    echo "<td>{$post_id}</td>";
    echo "<td>{$post_author}</td>";
    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        
    $query ="SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
    $select_categories_id = mysqli_query($connection, $query);
        
    while($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        
        echo "<td>{$cat_title}</td>";
    }
            
    echo "<td>{$post_status}</td>";
    echo "<td><img width='100' src='../images/$post_image' alt= 'image'></td>";
    echo "<td>{$post_tags}</td>";
    echo "<td><a href='../post.php?p_id={$post_id}'>$post_comment_count</a></td>";
    echo "<td>{$post_date}</td>";
    echo "<td>{$post_views_count}</td>";
    echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
   
    echo "</tr>";
        
    }
    ?>
    </tbody>
    </table>
</form>


<?php

    if(isset($_GET['delete'])) {
        global $connection;
        $the_post_id = $_GET['delete'];
        
        $query ="DELETE FROM posts WHERE post_id={$the_post_id}";
        
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
        
    }

?>