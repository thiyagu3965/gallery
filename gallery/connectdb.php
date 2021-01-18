<?php
    try{

        $pdo=new PDO('mysql:host=localhost;dbname=gallery','root','');
        // echo 'connection success';
       

    }catch(PDOException $f){
        echo $f->getMessage();
    }
?>