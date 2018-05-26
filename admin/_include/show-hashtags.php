<?php include("../_include/_models/db.php"); ?>
<div class="table-input">
    <div class="new-input">
        <button id="add-new-hashtag" class="custom-button1">Add New</button> 
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
        <div class="td">Hashtag ID</div>
        <div class="td">Name</div>
        <div class="td">Ammount of Users</div>
    </div>
</div>