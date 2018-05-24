<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include("_include/head.php"); ?>
</head>
<body>
    <?php
        if(isset($_SESSION["adminID"])&&!empty($_SESSION["adminID"])){
            echo "<div class=admin-top-nav>";
                include("_include/admin-top-nav.php");
            echo "</div>";
        }
    ?>
    <div class="container">
        <?php 
            if(isset($_SESSION["adminID"])&&!empty($_SESSION["adminID"])){
                include("_include/show-users.php");
                echo "<script>";
                    include("_assets/_js/main.js");
                echo "</script>";
            }else{
                include("_include/login.php");
            }
        ?>
    </div>
</body>
</html>