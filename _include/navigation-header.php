<div class="profile-navigation-grid">
    <div class="profile-col">
        <img src="_assets/_img/150x150.jpeg" />
    </div>
    <div class="profile-col">
        <a href="?show-profile=true" id="my-profile" class="custom-button1">My Profile</a>
    </div>
    <div class="profile-col">
        <a href="?show-messages=true" id="buddy-list" class="custom-button1">Messages</a>
    </div>
    <div class="profile-col">
            <a href="?show-buddy-list=true" id="buddy-list" class="custom-button1">Buddy list</a>
        </div>
</div>
<div class="form-wrapper">
    <form method="POST" action="_process/process-login.php" target="_self">
        <table>
            <tr>
                <td><input type="submit" name="login" class="custom-button1" /></td>
                <td><input type="text" name="email" placeholder="E-mail"></td>
                <td><input type="password" name="password" placeholder="Password" ></td>
            </tr>
            <!--<tr>
                <td><a href="?create-account=true" class="custom-button1">Skappa Konto</a></td>
                    
                <td><input type="submit" name="login" class="custom-button1" /></td>
            </tr>-->
        </table>
    </form>
</div>