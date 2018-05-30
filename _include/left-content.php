<input type="hidden" id="uid" value="<?php echo $_SESSION["uid"];?>"/>
<input type="hidden" id="lang" value="<?php echo $_COOKIE["lang"];?>"/>
<dl class="dropdown city-drop"> 
    <dt>
        <a href="#" class="custom-button1">
            <span class="hida"><?php echo $lang["left-bar-filter"]["city"]; ?></span>    
            <p class="multiSel city-multiSel"></p>  
        </a>
    </dt>
    <dd>
        <div class="mutliSelect city-select">
            <ul>
            <?php
                if($req = $db->q("select * from city")){
                    while ($row = $req->fetch_assoc()) {
                        echo "
                            <li>
                                <input type='checkbox' id='$row[cityID]' name='city' value='$row[name]'>
                                <label for=city>$row[name]</label>
                            </li>";
                    }
                }else{
                    echo false;
                }
                ?>
            </ul>
        </div>
    </dd>
</dl>
<div id="rest-search"></div>  



