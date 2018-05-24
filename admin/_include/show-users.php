<?php include("_models/db.php"); ?>
<div><input type="text" name="search" placeholder="search" class="input-style1"></div>
<div class="table" id="user-table">
    <div class="tr th">
        <div class="td">User ID</div>
        <div class="td">First Name</div>
        <div class="td">Last Name</div>
        <div class="td">Email</div>
        <div class="td">Profile URL</div>
        <div class="td">Date of Birth</div>
        <div class="td">Gender</div>
        <div class="td">Public ID</div>
        <div class="td">Account Status</div>
        <div class="td">Last Login</div>
        <div class="td">Gender Preference</div>
    </div>
    <!--<div class="tr">
        <div class="td">1</div>
        <div class="td">Alexandru</div>
        <div class="td">Cheltuitor</div>
        <div class="td">acheltuitor@gmail.com</div>
        <div class="td">sö-lofjdköosdjöfsolkdsklmf</div>
        <div class="td">1993-10-04</div>
        <div class="td">1</div>
        <div class="td">213124234</div>
        <div class="td">1</div>
        <div class="td">10293012</div>
        <div class="td">45</div>
    </div>-->
    <?php
        $db = new Database("localhost", "root", "", "projekt");
        $req = $db->q("SELECT * FROM user");
        while ($row = $req->fetch_assoc()) {
            echo"
                <div class=tr>
                    <div class=td>$row[userID]</div>
                    <div class=td>$row[firstName]</div>
                    <div class=td>$row[lastName]</div>
                    <div class=td>$row[email]</div>
                    <div class=td>$row[profilePicURL]</div>
                    <div class=td>$row[dob]</div>
                    <div class=td>$row[gender]</div>
                    <div class=td>$row[publicID]</div>
                    <div class=td>$row[accountStatusID]</div>
                    <div class=td>$row[lastLogin]</div>
                    <div class=td>$row[genderPreference]</div>
                </div>
            ";
        }
    ?>
</div>