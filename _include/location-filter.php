<?php
    if(!isset($db) && empty($db)){
        include("_models/db.php");
        $db = new Database("localhost", "root", "", "projekt");
    }
?>
<div class="nav-divider">
    <h3>Gym</h3>
    <ul class="nav-location-dropdown">
        <?php
        $restSQL = "";
        $baseSQL =" select location.*, location.name as locationName
                    from location
                    left join city 
                        on location.cityID = city.cityID
                    where 
                       
                ";
            foreach($_POST["city"] as $key=>$val){
                $restSQL = (($restSQL == "")? $restSQL."city.cityID = ".$val[1]: $restSQL." OR city.cityID = ".$val[1]); 
            }
            $sql = $baseSQL.$restSQL;
            if($req = $db->q($sql)){
                while ($row = $req->fetch_assoc()) {
                    echo "
                        <li>
                            <input type=checkbox name=nav_location value=$row[activityID]>
                            <label for=nav_location>$row[locationName]</label>
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