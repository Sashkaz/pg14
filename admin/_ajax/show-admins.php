<?php include("../_include/_models/db.php"); ?>
<div class="table-input">
    <div class="new-input">
        <button id="add-new-admin" class="custom-button1">Add New</button> 
        <select>
            <?php
                for($i = 1; $i <=10; $i++){
                        echo "<option value=$i>$i</option>;";
                }
            ?>
        </select>
    </div>
    <div class="search-input">
        <input type="text" name="search" placeholder="search" class="input-style1">
    </div>    
</div>
<div class="table" id="user-table">
    <div class="tr th">
        <div class="td">Admin ID</div>
        <div class="td">First Name</div>
        <div class="td">Last Name</div>
        <div class="td">Email</div>
        <div class="td">Admin Privilege</div>
        <div class="td">Last Login</div>
        <div class="td">Action</div>
    </div>
    <?php
        $db = new Database("localhost", "root", "", "projekt");
        $req = $db->q("SELECT * FROM admin");
        while ($row = $req->fetch_assoc()) {
            echo"
                <div class=tr>
                    <div class=td>$row[adminID]</div>
                    <div class=td>$row[firstName]</div>
                    <div class=td>$row[lastName]</div>
                    <div class=td>$row[email]</div>
                    <div class=td>$row[adminPrivilege]</div>
                    <div class=td>$row[lastLogin]</div>
                    <div class=td>
                        <select name=admin_action id=admin_action>
                            <option value=1_$row[adminID]>Active</option>
                            <option value=2_$row[adminID]>Inactive</option>
                            <option value=3_$row[adminID]>Block</option>
                            <option value=4_$row[adminID]>Delete</option>
                        </select>
                    </div>
                </div>
            ";
        }
    ?>
</div>