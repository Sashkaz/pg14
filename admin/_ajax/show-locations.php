<?php include("../_include/_models/db.php"); ?>
<div><input type="text" name="search" placeholder="search" class="input-style1"></div>
<div class="table" id="user-table">
    <div class="tr th">
        <div class="td">City ID</div>
        <div class="td">Name</div>
    </div>
    <div class=tr>
        <div class=td>1</div>
        <div class=td>Uppsala</div>
    </div>
    <div class=tr>
        <div class=td>2</div>
        <div class=td>Stockholm</div>
    </div>
    <div class=tr>
        <div class=td>3</div>
        <div class=td>Linköping</div>
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