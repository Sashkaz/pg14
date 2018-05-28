<?php
    include("_include/_models/db.php");
    $db = new Database("localhost", "root", "", "projekt");
?>
<div class="nav-divider">
    <h3>Stad</h3>
    <ul class="nav-city-dropdown">
        <?php
            if($req = $db->q("select * from city")){
                while ($row = $req->fetch_assoc()) {
                    echo "
                        <li>
                            <input type=checkbox name=nav_city value=$row[cityID]>
                            <label for=nav_city>$row[name]</label>
                        </li>";
                }
            }else{
                echo false;
            }
        ?>
    </ul>
</div>
<div class="nav-divider">
    <h3>Gym</h3>
    <ul class="nav-location-dropdown">
        <?php
            if($req = $db->q("select * from location group by cityID")){
                while ($row = $req->fetch_assoc()) {
                    echo "
                        <li>
                            <input type=checkbox name=nav_location value=$row[activityID]>
                            <label for=nav_location>$row[name]</label>
                        </li>";
                }
            }else{
                echo false;
            }
        ?>
    </ul>
</div>
<div class="nav-divider">
    <h3>Hashtag</h3>
    <ul class="nav-tag-dropdown">
        <?php
            if($req = $db->q("select * from hashtaglist")){
                while ($row = $req->fetch_assoc()) {
                    echo "
                        <li>
                            <input type=checkbox name=nav_tag value=$row[hashtagListID]>
                            <label for=nav_tag>$row[name]</label>
                        </li>";
                }
            }else{
                echo false;
            }
        ?>
    </ul>
</div>
<div class="nav-divider">
    <h3>Now training</h3>
    <ul class="nav-user-status-check">
        <li>
            <input type="checkbox" name="nav-user-status" value="true">
            <label for="nav-user-status">Now training</label>
        </li>
    </ul>
</div>

