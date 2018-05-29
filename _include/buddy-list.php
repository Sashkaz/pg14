<?php 
    if(!isset($db) && empty($db)){
        include("_models/db.php");
        $db = new Database("localhost", "root", "", "projekt");
    }
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
    $req = $db->q($sql);
    if($req->num_rows > 0){
        while ($row = $req->fetch_assoc()) {
            if($row["userID"] != null){
                echo "
                    <a class=prof-container href=?show-profile=true&u=$row[publicID]>
                        <div class=user-pic><img src=_assets/_img/150x150.jpeg ></div>
                        <div class=user-info>
                            <div class=profile-name>$row[firstName] $row[lastName]</div>
                            <div class=profile-verified>(v1) (v2) (a)</div>
                            <div class=profile-tag>
                                <span class=activity-tag>#Core</span>
                            </div>
                        </div>
                    </a>
                ";
            }
        }
    }
?>