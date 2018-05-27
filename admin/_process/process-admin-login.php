<?php 
    session_start();
    include("../_include/_models/db.php");
    include("../_include/_models/admin-login.php");
    $db = new Database("localhost", "root", "", "projekt");
    $adminLogin = new adminLogin();

    if(isset($_POST["admin-login"]) && !empty($_POST["admin-login"])){
        $inputArray = Array($db->db, $_POST["email"], $_POST["pwd"]);
        if(($result = $adminLogin->userLogin($inputArray)) == 1){
            $sanitizedInput = $inputArray;
            $sanitizedInput[2] = $adminLogin->hash($sanitizedInput[2]);
            $matchData = $db->q("select adminID, firstName, lastName from admin where email = '$sanitizedInput[1]' and password = '$sanitizedInput[2]'");
            if($matchData->num_rows == 1){
                $fetchUserID = $matchData->fetch_assoc();
                $_SESSION["adminID"] = $fetchUserID["adminID"];
                $_SESSION["adminFullName"] = $fetchUserID["firstName"]." ".$fetchUserID["lastName"];
                header("Location: ../index.php");
            }else{
                echo "no such account";
            }
        }else{
            echo $result;
        }
    }
?>