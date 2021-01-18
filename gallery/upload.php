<?php
include_once 'connectdb.php';


if(isset($_POST['submit'])){
    $f_name=$_FILES['myfile']['name'];  //name , array name
    $f_tmp=$_FILES['myfile']['tmp_name'];  // name , array temp name
    $f_extension=explode('.',$f_name);
    $f_extension=strtolower(end($f_extension));
    $f_newfile=uniqid().'.'.$f_extension;
    $store="images/".$f_newfile;    // foldername and file name
    if(move_uploaded_file($f_tmp,$store)){
        $productimage=$f_newfile;
        $insert=$pdo->prepare("INSERT INTO tbl_gallery(filepath) VALUES(:pimage)");
        $insert->bindParam(':pimage',$productimage);
        $insert->execute();
    }
}

if(isset($_POST['btndel'])){
  $delete=$pdo->prepare("DELETE FROM tbl_gallery WHERE id=".$_POST['btndel']);
  $delete->execute();

}

?>

    
    <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Gallery</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="upload.php">Upload</a></li>
      
    </ul>
  </div>
</nav>
  
<div class="container">
    <div class="col-lg-12">
        <h2 class="page-header">Vijay Photography</h2>
    </div>
    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <!-- <label class="control-label col-sm-2" for="email">Email:</label> -->
      <div class="col-sm-10">
        <input type="file" name="myfile" class="form-control" >
      </div>
    </div>
    <div class="form-group">      
      <div class="col-sm-10">
      <input type="submit" value="upload" name="submit">
      </div>
    </div>   
   
</div>  
<div class="col-md-10">
<table class="table table-striped table-bordered" id="myTable">
    <thead>
      <tr>
      <th>No</th>
        <th>Picture</th>

        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $select=$pdo->prepare("SELECT *  FROM tbl_gallery");
      $select->execute();
      while($row=$select->fetch(PDO::FETCH_OBJ)){
        echo '
        <tr>
        <td>'.$row->id.'</td>
        
        <td><img src="images/'.$row->filepath.'" class="img-responsive" height="80" width="80"></td>
        <td><button type="submit" class="btn btn-danger" value="'.$row->id.'" name="btndel"><span class="glyphicon glyphicon-trash"></span></button></td>
        </tr>
        
        
        ';
      }

      ?>
    
      
    </tbody>
</table>
</form>
</div>  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>
</html>
