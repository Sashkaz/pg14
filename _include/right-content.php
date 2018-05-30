<div id="activity-container">
    <ul class="right-bar-list">
        <?php
            if($req = $db->q("select * from location")){
                while ($row = $req->fetch_assoc())
                { echo    "<a class=right-bar-link href=_process/process-active.php?locationID=$row[activityID] ><li class=right-bar-item> $row[name] <br> <span class=right-bar-subtext>$row[address]</span></li></a>
                ";}
            }
            else
            {
                echo false;
            }
        ?>
    </ul>
</div>
