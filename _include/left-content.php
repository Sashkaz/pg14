 
<style>
.dropdown {
    margin: 15% 5%;
    width: 90%;
    transform: translateY(-50%);

}
a {
    color: #fff;
}
.dropdown dd,
.dropdown dt {
    margin: 0px;
    padding: 0px;
}
.dropdown ul {
    margin: -1px 0 0 0;
}
.dropdown dd {
    position: relative;
}
.dropdown a,
.dropdown a:visited {
    color: #fff;
    text-decoration: none;
    outline: none;
    font-size: 12px;
}
.dropdown dt a {
    background-color: #4F6877;
    display: block;
    padding: 8px 20px 5px 10px;
    min-height: 25px;
    line-height: 24px;
    overflow: hidden;
    border: 0;
    max-width: 200px;
}
.dropdown dt a span,
    .multiSel span {
    cursor: pointer;
    display: inline-block;
    padding: 0 3px 2px 0;
}

.dropdown dd ul {
    background-color: #4F6877;
    border: 0;
    color: #fff;
    display: none;
    left: 0px;
    padding: 2px 5% 2px 5%;
    position: absolute;
    top: 2px;
    max-width: 173px;
    width: 90%;
    list-style: none;
    max-height: 150px;
    overflow: auto;
}
.dropdown span.value {
    display: none;
}
.dropdown dd ul li a {
    padding: 5px;
    display: block;
}
.dropdown dd ul li a:hover {
    background-color: #fff;
}
button {
    background-color: #6BBE92;
    width: 302px;
    border: 0;
    padding: 10px 0;
    margin: 5px 0;
    text-align: center;
    color: #fff;
    font-weight: bold;
}
</style>

<input type="hidden" id="uid" value="<?php echo $_SESSION["uid"];?>"/>
<input type="hidden" id="lang" value="<?php echo $_COOKIE["lang"];?>"/>
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
    </dd>
  <!--<button>Filter</button>-->
</dl>


  
<?php
    /*if (session_status() == PHP_SESSION_NONE) {
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
    }*/
    //include("_include/new-input.php");
?>



