<?php
    include("../_models/db.php");
    include("../../_assets/_lang/".$_POST["lang"].".php"); 
    $locationFilter = new Database("localhost", "root", "", "projekt");
?>
<dl class="dropdown location-drop"> 
  <dt>
      <a href="#">
          <span class="hida">Select</span>    
          <p class="multiSel location-multiSel"></p>  
      </a>
  </dt>
  <dd>
      <div class="mutliSelect location-select">
          <ul>
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
                if($req = $locationFilter->q($sql)){
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
    </dd>
</dl><!--
<dl class="dropdown"> 
    <dt>
        <a href="#">
            <span class="hida">Select</span>    
            <p class="multiSel"></p>  
        </a>
    </dt>
    <dd>
        <div class="mutliSelect hashtag">
            <ul>
        <?php
        /*
            if($req = $locationFilter->q("select * from hashtaglist")){
                while ($row = $req->fetch_assoc()) {
                    echo "
                        <li>
                            <input type=checkbox name=nav_tag value=$row[hashtagListID]>
                            <label for=nav_tag>$row[name]</label>
                        </li>";
                }
            }else{
                echo false;
            }*/
        ?>
            </ul>
        </div>
    </dd>
</dl>
<dl class="dropdown"> 
    <dt>
        <a href="#">
            <span class="hida">Select</span>    
            <p class="multiSel"></p>  
        </a>
    </dt>
    <dd>
        <div class="mutliSelect">
            <ul>
        <li>
            <input type="checkbox" name="nav-user-status" value="true">
            <label for="nav-user-status"><?php //echo $lang["left-bar-filter"]["activity"]["active"]; ?></label>
        </li>
        </ul>
        </div>
    </dd>
</dl>-->