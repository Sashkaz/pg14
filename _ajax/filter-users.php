<?php
include("../_include/_models/db.php");
$db = new Database("localhost", "root", "", "projekt");
if(isset($_POST["input"]) && !empty($_POST["input"])){
    $location = "";
    $tag = "";
    $restSQL = "";
    $baseSQL =" select user.userID, firstName, lastName, publicID, profilePicURL from user 
                right join userlocation 
                    on user.userID = userlocation.userID 
                left join location 
                    on userlocation.locationID = location.activityID
                right join userhashtag 
                    on user.userID = userhashtag.userID 
                left join hashtaglist 
                    on userhashtag.hasthagListID = hashtaglist.hashtagListID 
                where  user.userID != $_POST[uid] and 
    ";
    foreach($_POST["input"] as $key=>$val){
        if($val[0] == "location"){
            $restSQL = (($restSQL == "")? $restSQL."location.activityID = ".$val[1]: $restSQL." OR location.activityID = ".$val[1]);    
        }elseif($val[0] = "tag"){
            $restSQL = (($restSQL == "")? $restSQL."hashtaglist.hashtagListID = ".$val[1]: $restSQL." OR hashtaglist.hashtagListID = ".$val[1]);
        }     
    }
    echo $baseSQL."(".$restSQL.") group by user.userID";
}elseif(isset($_POST["buddySearch"]) && !empty($_POST["buddySearch"])){
    echo "select user.userID, firstName, lastName, publicID, profilePicURL from user 
        left join userrelationship
        on user.userID = userrelationship.relatedUser
        where userrelationship.relatingUser = $_POST[uid] and (user.firstName like '%$_POST[buddySearch]%' or user.lastName like '%$_POST[buddySearch]%')";
}
?>