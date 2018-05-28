<?php
if(isset($_POST["input"]) && !empty($_POST["input"])){
    if(!isset($db) && empty($db)){
        include("../_include//_models/db.php");
        $db = new Database("localhost", "root", "", "projekt");
    }
    $location = "";
    $tag = "";
    $restSQL = "";
    $baseSQL =" select user.userID, firstName, lastName, publicID, profilePicURL from user 
                left join userlocation 
                    on user.userID = userlocation.userID 
                left join location 
                    on userlocation.locationID = location.activityID
                right join userhashtag 
                    on user.userID = userhashtag.userID 
                right join hashtaglist 
                    on userhashtag.hasthagListID = hashtaglist.hashtagListID 
                where 
    ";
    foreach($_POST["input"] as $key=>$val){
        if($val[0] == "location"){
            $restSQL = (($restSQL == "")? $restSQL."location.activityID = ".$val[1]: $restSQL." OR location.activityID = ".$val[1]);    
        }elseif($val[0] = "tag"){
            $restSQL = (($restSQL == "")? $restSQL."hashtaglist.hashtagListID = ".$val[1]: $restSQL." OR hashtaglist.hashtagListID = ".$val[1]);
        }     
    }
    echo $baseSQL.$restSQL." group by user.userID";
}
?>