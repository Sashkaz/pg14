<?php
    if(isset($_POST) && !empty($_POST)){
        $city = "";
        $location = "";
        $tag = "";
        $output = "";
        foreach($_POST["input"] as $key=>$val){
            // $output = K$output."; ".$val[0]."=".$val[1];
            if($val[0] = "city")
                $city = $city.$val[1]." ";
            elseif($val[0] = "location")
                $location = $location.$val[1]." ";
            elseif($val[0] = "tag")
                $tag = $tag.$val[1]." ";          
                /*if($v[0] = "city")
                    $city = $city.$v." ";
                elseif($val[$k] = "location")
                    $location = $location.$v." ";
                elseif($val[$k] = "tag")
                    $tag = $tag.$v." ";*/
                
            // }
        }
        echo "$city | $location | $tag";
        // var_dump($output);
        // var_dump($_POST["input"]);
    }
?>