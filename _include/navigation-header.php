<?php if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"])){?>
<div class="profile-navigation-grid">
    <div class="profile-col">
        <img src="_assets/_img/150x150.jpeg" />
    </div>
    <div class="profile-col">
        <a href="?show-users=true" id="my-profile" class="custom-button1"><i class="fas fa-search"></i> Show Users</a>
    </div>
    <div class="profile-col">
        <a href="?show-profile=true" id="my-profile" class="custom-button1"><i class="fas fa-user-cog"></i> My Profile</a>
    </div>
    <div class="profile-col">
        <a href="?show-messages=true" id="buddy-list" class="custom-button1"><i class="fas fa-envelope"></i> Messages</a>
    </div>
    <div class="profile-col">
            <a href="?show-buddy-list=true" id="buddy-list" class="custom-button1"><i class="fas fa-address-book"></i> Buddy list</a>
    </div>
</div>
<div class="profile-col">
    <a href="_process/process-logout.php" class="custom-button1" ><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<?php }else{ ?>
<div class="form-wrapper">
    <form method="POST" action="_process/process-login.php" target="_self">
        <input type="submit" name="login" class="custom-button1" />
        <input type="text" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Password" >
    </form>
</div>
<?php }?>