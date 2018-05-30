<?php if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"])){
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
        <a href="?show-users=true" id="show-users" class="custom-button1 <?php if($page=="show-users"){ echo 'current';}?>"><i class="fas fa-search"></i> <?php echo $lang["top-nav-buttons"]["show-users"]; ?></a>
    </div>
    <div class="profile-col">
        <a href="?show-profile=true" id="my-profile" class="custom-button1 <?php if($page=="show-profile"){ echo 'current';}?>"><i class="fas fa-user-cog"></i> <?php echo $lang["top-nav-buttons"]["my-profile"]; ?></a>
    </div>
    <div class="profile-col">
        <a href="?show-messages=true" id="my-messages" class="custom-button1 <?php if($page=="show-messages"){ echo 'current';}?>"><i class="fas fa-envelope"></i> <?php echo $lang["top-nav-buttons"]["messages"]; ?></a>
    </div>
    <div class="profile-col">
            <a href="?show-buddy-list=true" id="buddy-list" class="custom-button1 <?php if($page=="show-buddy-list"){ echo 'current';}?>"><i class="fas fa-address-book"></i> <?php echo $lang["top-nav-buttons"]["buddy-list"]; ?></a>
    </div>
</div>
<div class="profile-col">
    <a href="_process/process-logout.php" class="custom-button1" ><i class="fas fa-sign-out-alt"></i> <?php echo $lang["top-nav-buttons"]["logout-button"]; ?></a>
</div>
<div class="profile-col lang">
    <select class="custom-input1" name="lang_selector">
        <option value="en" <?php echo (($_COOKIE["lang"] == "en")? "selected":"")?>>EN</option>
        <option value="sv" <?php echo (($_COOKIE["lang"] == "sv")? "selected":"")?>>SV</option>
    </select>
</div>
<?php }else{ ?>
<form method="POST" action="_process/process-login.php" target="_self" class="form-wrapper profile-col">
    <input type="submit" name="login" class="custom-button1" value='<?php echo $lang["login-form"]["login-button"]; ?>' />
    <input type="text" name="email" class="custom-input2" placeholder=<?php echo $lang["login-form"]["placeholder"]["email"]; ?> >
    <input type="password" name="password" class="custom-input2" placeholder=<?php echo $lang["login-form"]["placeholder"]["pwd"]; ?> >
</form>
<div class="profile-col lang">
    <select class="custom-input1" name="lang_selector">
        <option value="en" <?php echo (($_COOKIE["lang"] == "en")? "selected":"")?>>EN</option>
        <option value="sv" <?php echo (($_COOKIE["lang"] == "sv")? "selected":"")?>>SV</option>
    </select>
</div>
<?php }?>