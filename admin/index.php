<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include("_include/head.php"); ?>
</head>
<body>
    <?php
        if(isset($_SESSION["adminID"]) && !empty($_SESSION["adminID"])){
            echo "<div class=admin-top-nav>";
                include("_include/admin-top-nav.php");
            echo "</div>";
        }
    ?>
    <div class="container">
        <?php 
            if(isset($_SESSION["adminID"]) && !empty($_SESSION["adminID"])){
                if(isset($_GET["users"]) && !empty($_GET["users"])){
                    include("_ajax/show-users.php");
                }else if(isset($_GET["locations"]) && !empty($_GET["locations"])){
                    include("_ajax/show-locations.php");
                }else if(isset($_GET["hashtags"]) && !empty($_GET["hashtags"])){
                    include("_ajax/show-hashtags.php");
                }else if(isset($_GET["admins"]) && !empty($_GET["admins"])){
                    include("_ajax/show-admins.php");
                }else{
                    include("_ajax/show-users.php");
                }

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