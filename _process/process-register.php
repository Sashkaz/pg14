<?php
    session_start();
    include("../_include/_models/db.php");
    include("../_include/_models/form-authorizer.php");
    $db = new Database("localhost", "root", "", "projekt");
    $createAccount = new formAuthorizer();
    if(isset($_POST) && !empty($_POST)){
        $inputArray = array($db->db, $_POST["first-name"], $_POST["last-name"], $_POST["email"], $_POST["pwd"], $_POST["re-pwd"],  $_POST["day"]."-".$_POST["month"]."-".$_POST["year"], $_POST["gender"]);
        if(($response = $createAccount->userRegistration($inputArray)) == 1){
            $sanitizedInput = $createAccount->sanitizeInput($inputArray); 
            $sanitizedInput[4] = $createAccount->hash($sanitizedInput[4]);
            $publicID = str_replace(" ", "", substr((string)microtime(), 2, 13));
            $sql = "INSERT INTO 
                    user    (firstName, lastName, email, password, profilePicUrl, dob, gender, publicID, accountStatusID, genderPreference) 
                    values  ('$sanitizedInput[1]', '$sanitizedInput[2]', '$sanitizedInput[3]', '$sanitizedInput[4]', 'null', '$sanitizedInput[6]', '$sanitizedInput[7]', '$publicID', '2', '0')";
                    //check if typed email already exists
                    if(mysqli_num_rows($db->q("select email from user where email = '".$sanitizedInput[3]."'")) == 0){
                        if($db->q($sql)){
                            $_SESSION["uid"] = $db->db->insert_id;
                            $_SESSION["full_name"] = $sanitizedInput[1]. " ".$sanitizedInput[2];
                            header("Location: ../index.php");
                        }else{
                            echo "Something went wrong ";//.mysqli_error($db->db)." ".$publicID;
                        }
                    }else{
                        echo "Account already exists.";
                    }
                    
        }else{
            echo $response;
        }
    }
?>