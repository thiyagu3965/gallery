<?php
include_once 'connectdb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
 img {
  max-width: 100%;
  height: auto;
}
  </style>
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

    <?php
    
    $select=$pdo->prepare("SELECT * FROM tbl_gallery ORDER BY id DESC");
    $select->execute();
    while($row=$select->fetch(PDO::FETCH_OBJ)){
        echo '
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="thumbnail" href="#">
            
            <img src="images/'.$row->filepath.'" class="img-responsive img-rounded" >
            </a> 
         </div>

           
        ';
    }
    
    
    ?>
    
    

    <div class="modal fade" role="dialog" id="thiyagu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src='' id="model-img" height="100%" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('img').on('click',function(){
        var src=$(this).attr('src');
        $("#model-img").attr('src',src);
        $("#thiyagu").modal('show');
    });    
});

</script>

</body>
</html>
