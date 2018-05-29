<?php if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"])){
    if(!isset($db) && empty($db)){
        include("_models/db.php");
        $db = new Database("localhost", "root", "", "projekt");
    }
    $curUser = $_SESSION["uid"];
    $page = "default";
    if(isset($_GET["show-users"]))
    {
        $page = "show-users";
    }
    else if(isset($_GET["show-profile"]))
    {
        $page = "show-profile";
    }
    else if(isset($_GET["show-messages"]))
    {
        $page = "show-messages";
    }
    else if(isset($_GET["show-buddy-list"]))
    {
        $page = "show-buddy-list";
    }
    ?>
<div class="profile-navigation-grid">
    <div class="profile-col">
        <?php
        $userInfo = $db->q("SELECT * FROM user WHERE userID = '$curUser'");;
        $row = $userInfo->fetch_assoc();

        if ($row["profilePicURL"] != "null")
        {
            $userPictureSrc= "data:image/jpeg;base64,".base64_encode($row["profilePicURL"]);
        }
        else
        {
            $userPictureSrc= "_assets/_img/150x150.jpeg";
        }
        ?>
        <img src="<?php echo $userPictureSrc; ?>" />
    </div>
    <div class="profile-col">
        <a href="?show-users=true" id="show-users" class="custom-button1 <?php if($page=="show-users"){ echo 'current';}?>"><i class="fas fa-search"></i> Show Users</a>
    </div>
    <div class="profile-col">
        <a href="?show-profile=true" id="my-profile" class="custom-button1 <?php if($page=="show-profile"){ echo 'current';}?>"><i class="fas fa-user-cog"></i> My Profile</a>
    </div>
    <div class="profile-col">
        <a href="?show-messages=true" id="my-messages" class="custom-button1 <?php if($page=="show-messages"){ echo 'current';}?>"><i class="fas fa-envelope"></i> Messages</a>
    </div>
    <div class="profile-col">
            <a href="?show-buddy-list=true" id="buddy-list" class="custom-button1 <?php if($page=="show-buddy-list"){ echo 'current';}?>"><i class="fas fa-address-book"></i> Buddy List</a>
    </div>
</div>
<div class="profile-col">
    <a href="_process/process-logout.php" class="custom-button1" ><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<?php }else{ ?>
<div class="form-wrapper">
    <form method="POST" action="_process/process-login.php" target="_self">
        <input type="submit" name="login" class="custom-button1" />
        <input type="text" name="email" class="custom-input2" placeholder="E-mail">
        <input type="password" name="password" class="custom-input2" placeholder="Password" >
    </form>
</div>
<?php }?>