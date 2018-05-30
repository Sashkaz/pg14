<?php 
    include("../_models/db.php");
    $filterUsers = new Database("localhost", "root", "", "projekt");
    $req = $filterUsers->q("SELECT * FROM user");
    if(isset($_POST["req"]) && !empty($_POST["req"])){
        $req = $filterUsers->q($_POST["req"]);
        // echo $_POST["req"];
    }
    if($req->num_rows > 0){
        while ($row = $req->fetch_assoc()) {
            if($row["userID"] != null){
                if ($row["profilePicURL"] != "null")
                {
                    $userPictureSrc= "data:image/jpeg;base64,".base64_encode($row["profilePicURL"]);
                }
                else
                {
                    $userPictureSrc= "_assets/_img/150x150.jpeg";
                }
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
