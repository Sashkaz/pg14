<?php 
    session_start();
    if(!isset($_COOKIE["lang"]) && empty($_COOKIE["lang"])){
        setcookie("lang", "en",  time()+60*60*24*30, "/projekt");
        header("Location: index.php");
    }
    include("_assets/_lang/".$_COOKIE["lang"].".php"); 
    include("_include/_models/db.php");
    $db = new Database("localhost", "root", "", "projekt");
?>
<!DOCTYPE html>
<html lang="<?php $_COOKIE["lang"]?>">
    <head>
        <?php include("_include/head.php"); ?>
    </head>
    <body>
        <div class="user-header">
            <?php include("_include/navigation-header.php"); ?>
        </div>
        <div id="master-container">
            <div id="title">
                <a href="index.php">Training Buddies</a>
            </div>
            <div id="left-bar">
                <div id="left-content">
                    <?php if(isset($_GET["show-messages"]) && !empty($_GET["show-messages"])){
                                include("_include/left-content-messages.php");
                            }
                            else
                            {
                                if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"])){
                                    include("_include/left-content.php");
                                }
                            }?>
                </div>
            </div>
            <div id="center-bar">
                <div id="center-content">
                    <?php
                        if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"])){
                            if(isset($_GET["show-profile"]) && !empty($_GET["show-profile"])){
                                include("_include/show-own-profile.php");
                            }elseif(isset($_GET["show-messages"]) && !empty($_GET["show-messages"])){
                                include("_include/show-messages.php");
                            }elseif(isset($_GET["show-buddy-list"]) && !empty($_GET["show-buddy-list"])){
                                include("_include/show-own-buddy-list-unfiltered.php");
                            }elseif(isset($_GET["show-users"]) && !empty($_GET["show-users"])){
                                include("_include/show-users-unfiltered.php");
                            }else{
                               include("_include/show-users-unfiltered.php");
                            }
                            include("_assets/_js/main.js");
                        }else{
                            include("_include/form-register.php");
                        }?>
                </div>
            </div>
            <div id="right-bar">
                <div id="right-content">
                    <?php if (isset($_SESSION["active"])&&!empty($_SESSION["active"]))
                    {
                      include("_include/right-content-active.php");
                    } else
                    {
                      include("_include/right-content.php");
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
