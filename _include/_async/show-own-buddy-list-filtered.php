<?php 
    include("../_models/db.php");
    $buddyFilter = new Database("localhost", "root", "", "projekt");
    if(!isset($_SESSION["uid"]) && empty($_SESSION["uid"])){
        session_start();
    }
    $sql = "select user.userID, firstName, lastName, publicID, profilePicURL from user 
    left join userrelationship
    on user.userID = userrelationship.relatedUser
    where userrelationship.relatingUser = $_SESSION[uid]";

    if(isset($_POST["search"]) && !empty($_POST["search"])){
        $sql = $_POST["search"];
    }
    $req = $buddyFilter->q($sql);
    if($req->num_rows > 0){
        while ($row = $req->fetch_assoc()) {
            if ($row["profilePicURL"] != "null")
            {
                $userPictureSrc= "data:image/jpeg;base64,".base64_encode($row["profilePicURL"]);
            }
            else
            {
                $userPictureSrc= "_assets/_img/150x150.jpeg";
            }
            if($row["userID"] != null){
                echo "
                    <a class=prof-container href=?show-profile=true&u=$row[publicID]>
                        <div class=user-pic><img src=$userPictureSrc></div>
                        <div class=user-info>
                            <div class=user-name>$row[firstName] $row[lastName]</div>
                            <div class=profile-verified>(v1) (v2) (a)</div>
                        </div>
                    </a>
                ";
            }
        }
    }
?>