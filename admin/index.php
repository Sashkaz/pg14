<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include("_include/_html/head.php"); ?>
</head>
<body>
    <div id="dialog"></div>
    <?php
        if(isset($_SESSION["adminID"]) && !empty($_SESSION["adminID"])){
            echo "<div class=admin-top-nav>";
                include("_include/_html/admin-top-nav.php");
            echo "</div>";
        }
    ?>
    <div class="container">
        <?php 
            if(isset($_SESSION["adminID"]) && !empty($_SESSION["adminID"])){
                if(isset($_GET["users"]) && !empty($_GET["users"])){
                    include("_include/show-users.php");
                }else if(isset($_GET["cities"]) && !empty($_GET["cities"])){
                    include("_include/show-cities.php");
                }else if(isset($_GET["hashtags"]) && !empty($_GET["hashtags"])){
                    include("_include/show-hashtags.php");
                }else if(isset($_GET["admins"]) && !empty($_GET["admins"])){
                    include("_include/show-admins.php");
                }else{
                    include("_include/show-users.php");
                }
                
                include("_assets/_js/main.js");
            }else{
                include("_include/_html/login.php");
            }
        ?>
    </div>
</body>
</html>