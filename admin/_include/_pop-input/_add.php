<div class="table new-table-input">
    <div class="tr th">
        <div class="td">Add New <?php echo ucfirst($_POST["type"]); ?></div>
    </div>
    <?php
    $placeHolder = [
                        "admins"=>["First name","Last Name", "Email", "Password", "Privelige"], 
                        "locations"=>["Name","Description", "Address", "Indoor", "CityID"], 
                        "cities"=>"City-Name", 
                        "hashtags"=>"Hashtag-Name"
                    ];
        for($i = 0; $i < $_POST["ammount"]; $i++){
            if($_POST["columns"] != 1){
               for($c = 0; $c < $_POST["columns"]; $c++){
                echo    "<div class=tr>
                            <div class=td><input type=text id=".$i."_".$c."_new_".$_POST["type"]." placeholder=".$placeHolder[$_POST["type"]][$c]."></div>
                        </div>";
                }
                if($i != ($_POST["ammount"]-1)){
                    echo "<div class=tr><div class=td></div></div>";
                } 
            }else{
                echo    "<div class=tr>
                            <div class=td><input type=text id=".$i."_new_".$_POST["type"]." placeholder=".$placeHolder[$_POST["type"]]."></div>
                        </div>";
            }
            
        }
    ?>
    <div class="tr">
        <div class="td"><button id="cancel" class="custom-button1">Cancel</button></div>
        <div class="td"><button id="request_add_<?php echo $_POST["type"]?>" class="custom-button1">Add Created</button></div>
    </div>
</div>