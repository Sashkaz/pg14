<?php
include("../_include/_models/db.php");
$db = new Database("localhost", "root", "", "projekt");
    if(isset($_POST) && !empty($_POST)){
        $flattenedInput = flattenArray($_POST["input"]);
        if($_POST["inputType"] == "cities"){
            $sql = "insert into city (name) values ";
        }elseif($_POST["inputType"] == "hashtags"){
            $sql = "insert into hashtaglist (name) values ";
        }elseif($_POST["inputType"] == "admins"){
            $sql = "insert into admin (firstName, lastName, email, password, adminPrivilege) values ";
        }
        for($i = 1; $i <= $_POST["inputAmmount"]; $i++){
            if($i < $_POST["inputAmmount"])
                $sql = $sql."('".$flattenedInput[$i-1]."'),";
            else
                $sql = $sql."('".$flattenedInput[$i-1]."')";
            
        }
        if($db->q($sql))
            echo 1;
        else
            echo mysqli_error($db->db)." ".$sql;
        
    }else{
        echo "Error";
    }

    function flattenArray(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
        
?>