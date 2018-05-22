
<!DOCTYPE html>
<html lang="en">
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
                    <?php include("_include/left-content.php"); ?>
                </div>
            </div>
            <div id="center-bar">
                <div id="center-content">
                    <?php 
                        if(isset($_GET["show-register-form"]) && !empty($_GET["show-register-form"])){
                            include("_include/form-register.php");
                        }elseif(isset($_GET["show-user-profile"]) && !empty($_GET["show-user-profile"])){
                            include("_include/show-users.php");
                        } ?> 
                </div>
            </div>
            <div id="right-bar">
                <div id="right-content">
                    <?php include("_include/right-content.php")?>
                </div>
            </div>
        </div>
    </body>
</html>