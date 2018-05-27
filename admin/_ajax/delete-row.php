<?php
include("../_include/_models/db.php");
$db = new Database("localhost", "root", "", "projekt");
    if(isset($_POST) && !empty($_POST)){
        if($_POST["table"] == "cities"){
            $restSQL = "city where cityID = ";
        }elseif($_POST["table"] == "hashtags"){
            $restSQL = "hashtaglist where hashtagListID = ";
        }elseif($_POST["table"] == "locations"){
            $restSQL = "location where activityID = ";
        }elseif($_POST["table"] == "admins"){
            $restSQL = "admin where adminID = ";
        }
        $sql = "delete from $restSQL $_POST[rowID]";
        if($db->q($sql)){
            echo 1;
        }else{
            echo mysqli_error($db->db)." ".$sql;
        }
    }
?>