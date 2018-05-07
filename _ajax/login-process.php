<?php
    session_start();
    include("../_include/_models/db.php");
    $db = new Database();
    function h($content, $connection){
        return  mysqli_real_escape_string($connection, $content);
    }
    if(isset($_POST) && !empty($_POST)){
        if(empty($_POST["email"])){
            echo "Var god och fyll i mejlet."; 
        }
        elseif(!preg_match("/.+@.+\..+/", $_POST["email"])){
            echo "Ogiltig mejl."; 
        }
        else {
            $email = h($_POST["email"], $db->db);
        }
        //password check
        if(empty($_POST["pwd"])){
            echo "Var god och fyll i lösenordet."; 
        }
        else {
            $salt = md5(h($_POST["pwd"], $db->db));
            $pwd = hash("sha256", $salt.h($_POST["pwd"], $db->db).$salt);
        }
        //check if any errors have occurred
            $matchUserData = $db->q("select * from user where email = '".$email."' and password = '".$pwd."'");
            if($matchUserData->num_rows > 0){
                $fetchUserID = $matchUserData->fetch_assoc();
                $_SESSION["uid"] = $fetchUserID["userID"];
                $_SESSION["name"] =  $fetchUserID["name"];
            }                  
            else {
                echo "Fel mejl eller lösenord";
            }  
    }else {
        echo "Unable to access page.";
    }
?>