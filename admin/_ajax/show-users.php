<?php include("_include/_models/db.php"); ?>
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
        <div class="td">Last Login</div>
        <div class="td">Gender Preference</div>
        <div class="td">Account Status</div>
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
        <div class=td>
            <select name=admin_action id=admin_action>
                <option value=1>Awaiting Confirmation</option>
                <option value=2>Active</option>
                <option value=3>Inactive</option>
                <option value=4>Block</option>
                <option value=5>Delete</option>
            </select>
        </div>
    </div>-->
    <?php
        $db = new Database("localhost", "root", "", "projekt");
        $req = $db->q("SELECT * FROM user left join accountstatustype on accountstatustype.accountStatusID = user.accountStatusID");
        while ($row = $req->fetch_assoc()) {
            echo"
                <div class=tr>
                    <div class=td>$row[userID]</div>
                    <div class=td>$row[firstName]</div>
                    <div class=td>$row[lastName]</div>
                    <div class=td>$row[email]</div>
                    <div class=td>$row[profilePicURL]</div>
                    <div class=td>$row[dob]</div>
                    <div class=td>";
                        if($row["gender"] == 1)
                            echo "Man";
                        else if($row["gender"] == 2)
                            echo "Kvinna";
                        else 
                            echo "Annat";
                    echo "</div>
                    <div class=td>$row[publicID]</div>
                    <div class=td>$row[lastLogin]</div>
                    <div class=td>$row[genderPreference]</div>
                    <div class=td>
                        <select name=admin_action id=admin_action autocomplete=off>
                            <option value=1_$row[userID] ".(($row["accountStatusID"] == 1)? "selected='selected'":"")." >Awaiting Confirmation</option>
                            <option value=2_$row[userID] ".(($row["accountStatusID"] == 2)? "selected='selected'":"")." >Active</option>
                            <option value=3_$row[userID] ".(($row["accountStatusID"] == 3)? "selected='selected'":"")." >Inactive</option>
                            <option value=4_$row[userID] ".(($row["accountStatusID"] == 4)? "selected='selected'":"")." >Block</option>
                            <option value=5_$row[userID]>Delete</option>
                        </select>
                    </div>
                </div>
            ";
        }
    ?>
</div>