<?php include("../_include/_models/db.php"); ?>
<div class="table-input">
    <div class="new-input">
        <button id="add_new_locations" class="custom-button1">Add New</button> 
        <select id="ammount_insert">
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
<div class="table">
    <div class="tr th">
        <div class="td">Location ID</div>
        <div class="td important">Name</div>
        <div class="td important">Description</div>
        <div class="td important">Address</div>
        <div class="td important">Indoor Gym</div>
        <div class="td important">City</div>
    </div>
    <?php
        $db = new Database("localhost", "root", "", "projekt");
        $req = $db->q("SELECT * FROM location left join city on location.cityID = city.cityID order by location.name and city.name");
        while ($row = $req->fetch_assoc()) {
            echo"
                <div class=tr>
                    <div class=td>$row[activityID]</div>
                    <div class=td>$row[name]</div>
                    <div class=td>$row[description]</div>
                    <div class=td>$row[address]</div>
                    <div class=td>".(($row["isGym"] == 1)? "True": "False")."</div>
                    <div class=td>".$row["city.name"]."</div>
                </div>
            ";
        }
    ?>