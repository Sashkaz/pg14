<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    else if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"])){
        ?>
        <input type="hidden" id="uid" value="<?php echo $_SESSION["uid"];?>"/>
        <input type="hidden" id="lang" value="<?php echo $_COOKIE["lang"];?>"/>
        <div class="nav-divider" id="main_checkbox">
            <h3><?php echo $lang["left-bar-filter"]["city"]; ?></h3>
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
        <?php
    }
?>



