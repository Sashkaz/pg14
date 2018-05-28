<?php
    if(isset($_POST) && !empty($_POST)){
        $city = "";
        $location = "";
        $tag = "";
        foreach($_POST["input"] as $key=>$val){
            if($val[0] == "city"){
                $city = $city.$val[1]." ";
            }elseif($val[0] == "location"){
                $location = $location.$val[1]." ";
                
            }elseif($val[0] = "tag"){
                $tag = $tag.$val[1]." "; 
            }
                
        }
        echo $city." | ".$location." | ".$tag;
        // var_dump($_POST["input"]);
    }
?>