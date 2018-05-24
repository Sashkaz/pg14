<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include("_include/head.php"); ?>
</head>
<body>
    <div class="container">
        <?php 
            if(isset($_SESSION["admin"])&&!empty($_SESSION["admin"])){
                include("_include/main.php");
            }else{
                include("_include/login.php");
            }
        ?>
    </div>
</body>
</html>