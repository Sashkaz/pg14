<div class="table new-table-input">
    <div class="tr th">
        <div class="td">Add New <?php echo $_POST["type"]; ?></div>
    </div>
    <?php
        for($i = 0; $i < $_POST["ammount"]; $i++){
            echo    "<div class=tr>
                        <div class=td><input type=text id=".$i."_new_".$_POST["type"]." ></div>
                    </div>";
        }
    ?>
    <div class="tr">
        <div class="td"><button id="cancel" class="custom-button1">Cancel</button></div>
        <div class="td"><button id="request_add_<?php echo $_POST["type"]?>" class="custom-button1">Add Created</button></div>
    </div>
</div>