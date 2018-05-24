<?php 
    session_start();
    include("../_include/_models/db.php");
    include("../_include/_models/form-authorizer.php");
    $db = new Database("localhost", "root", "", "projekt");
    $login = new formAuthorizer();
    
    if(isset($_POST) && !empty($_POST)){
        $inputArray = array($db->db, $_POST["email"], $_POST["password"]);
        if(($response = $login->userLogin($inputArray)) == 1){
            $sanitizedInput = $login->sanitizeInput($inputArray); 
            $sanitizedInput[2] = $login->hash($sanitizedInput[2]);
            $sql = "select userID, publicID, firstName, lastName from user where email = '$sanitizedInput[1]' and password = '$sanitizedInput[2]'";
            $matchUserData = $db->q($sql);
            if($matchUserData->num_rows == 1){
                $fetchUserID = $matchUserData->fetch_assoc();
                $_SESSION["uid"] = $fetchUserID["userID"];
                $_SESSION["uname"] = $fetchUserID["firstName"]." ".$fetchUserID["lastName"];
                header("Location: ../index.php");
            }else{
                echo "Incorrect Data ";//.mysqli_error($db->db);
            }
        }else{
            echo $response;
        }
    }
?>