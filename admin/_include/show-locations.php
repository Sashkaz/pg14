<?php include("../_include/_models/db.php"); ?>
<div class="table-input">
    <div class="new-input">
        <button id="add-new-city" class="custom-button1">Add New</button> 
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
        <div class="td">City ID</div>
        <div class="td">Name</div>
        <div class="td">Ammount of Gym/Locations</div>
        <div class="td">Ammount of Users</div>
    </div>
    <div class=tr>
        <div class=td>1</div>
        <div class=td>Uppsala</div>
        <div class=td>5</div>
        <div class=td>500</div>
    </div>
    <div class=tr>
        <div class=td>2</div>
        <div class=td>Stockholm</div>
        <div class=td>2</div>
        <div class=td>189</div>
    </div>
    <div class=tr>
        <div class=td>3</div>
        <div class=td>Linköping</div>
        <div class=td>50</div>
        <div class=td>794</div>
    </div>
    <?php
        $db = new Database("localhost", "root", "", "projekt");
        $req = $db->q("SELECT * FROM city");
        while ($row = $req->fetch_assoc()) {
            echo"
                <div class=tr>
                    <div class=td>$row[cityID]</div>
                    <div class=td>$row[name]</div>
                </div>
            ";
        }
    ?>
    <!--<div class=tr>
        <div class=td><input type="text" name="city"></div>
    </div>-->
</div>