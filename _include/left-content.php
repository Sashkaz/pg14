<?php
    include("_include/_models/db.php");
    $db = new Database("localhost", "root", "", "projekt");
?>
<div class="nav-divider" id="main_checkbox">
    <h3>Stad</h3>
    <ul class="nav-city-dropdown">
        <?php
            if($req = $db->q("select * from city")){
                while ($row = $req->fetch_assoc()) {
                    echo "
                        <li>
                            <input type=checkbox name=city value=$row[cityID]>
                            <label for=nav_city>$row[name]</label>
                        </li>";
                }
            }else{
                echo false;
            }
        ?>
    </ul>
</div>
<div id="rest-search"></div>


