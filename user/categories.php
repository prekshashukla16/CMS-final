<?php include "includes/header.php"; ?>

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


<div class="col-xs-6">
<?php
    
insert_categories();

?>

<form action="" method="post">
<div class="form-group">
<label for="cat_title">Add Category</label>
<input class="form-control" type="text" name="cat_title"></div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
</div>

</form>
<form action="" method="post">
<div class="form-group">
<label for="cat_title">Edit Category</label>

<?php //UPDATE AND INCLUDE 
global $connection;
if(isset($_GET['update'])) {

    $cat_id = $_GET['update'];
    

$query = 'SELECT * FROM categories WHERE cat_id ="'.$cat_id.'" ';
$select_categories_update = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_categories_update)) {
$cat_id = $row["cat_id"];
$cat_title = $row["cat_title"];
    
    
?>
<input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)) {echo $cat_title; } ?>" >

<?php } }?>

<?php //UPDATE QUERY
    if(isset($_POST['update'])) {
      $the_cat_title = $_POST['cat_title'];
      $query= "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
      $update_query = mysqli_query($connection, $query);
        if(!$update_query) {
            die('Query Failed' . mysqli_error($connection));
}
        }
    

?>

</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update" value="Edit Category">
</div>

</form>
</div>
<div class="col-xs-6">

<?php ?>
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Id</th>
<th>Category Title</th>
<th colspan="2">Update</th>
</tr>
</thead>
<tbody>
<?php
//FIND ALL CATEGORIES
findAllCategories();
    
?>

<?php //DELETE CATEGORIES
  if(isset($_GET['delete'])) {
      $the_cat_id = $_GET['delete'];
      $query= "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
      $delete_query = mysqli_query($connection, $query);
      
      header("Location: categories.php");
  }  
?>


</tbody>
</table>
</div>
</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->



<?php include "includes/footer.php" ?>