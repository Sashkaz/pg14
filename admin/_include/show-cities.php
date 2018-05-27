<?php include("../_include/_models/db.php"); ?>
<div class="table-input">
    <div class="new-input">
        <button id="add_new_cities" class="custom-button1">Add New</button> 
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
        <div class="td">City ID</div>
        <div class="td important">Name</div>
        <div class="td important">Action</div>
    </div>
    <?php
        $db = new Database("localhost", "root", "", "projekt");
        $req = $db->q("SELECT * FROM city order by name");
        while ($row = $req->fetch_assoc()) {
            echo"
                <div class=tr>
                    <div class=td>$row[cityID]</div>
                    <div class=td>$row[name]</div>
                    <div class=td><button id='delete_cities_$row[cityID]'> Delete</button></div>
                </div>
            ";
        }
    ?>
    <!--<div class=tr>
        <div class=td><input type="text" name="city"></div>
    </div>-->
</div>