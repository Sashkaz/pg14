<?php
session_start();
include("../_include/_models/db.php");
$db = new Database("localhost", "root", "", "projekt");
if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"]))
{
    $curUser = $_SESSION["uid"];
}
else
{
    echo "You need to log in to connect to other users.<br>Returning to previous page.";
    header("Refresh:2; URL=../index.php?show-profile=true");
}

// Add Friend
if(isset($_GET["addFriend"]))
{
    $relationshipID = 1;
    $targetUser = mysqli_real_escape_string($db->db, $_GET["addFriend"]);
    $getUserIDQuery = "SELECT userID FROM user WHERE publicID = '$targetUser' limit 1";
    $userIDResult = $db->q($getUserIDQuery);
    if($userIDResult->num_rows == 0)
    {
        echo "Could not find user.<br>Returning to previous page.";
        header("Refresh:2; URL=../index.php?show-profile=true&u=".$targetUser."");
    }
    else
    {        
        $userRow = $userIDResult->fetch_assoc();
        $targetUserID = $userRow["userID"];
        $checkrelationshipQuery = "SELECT *
        FROM userrelationship
        WHERE (relatingUser = '$curUser' AND relatedUser = '$targetUserID')
        OR (relatingUser = '$targetUserID' AND relatedUser = '$curUser') limit 1";
        $checkrelationshipResult = $db->q($checkrelationshipQuery);
        if($checkrelationshipResult->num_rows == 0)
        {
            $createrelationshipQuery = "INSERT INTO userrelationship (relatingUser, relatedUser, relationshipID, accepted) 
            VALUES  ('$curUser', '$targetUserID', '$relationshipID', 1), 
            ('$targetUserID', '$curUser', '$relationshipID', 1)";
            if($db->q($createrelationshipQuery))
            {
                header("Location: ../index.php?show-profile=true&u=".$targetUser."");
            }
            else
            {
                /* echo $db->lastError(); */
                echo "Unexpected error. Could not create friend relation.<br>Returning to previous page.";
                header("Refresh:2; URL=../index.php?show-profile=true&u=".$targetUser."");
            }
        }
        else
        {
            $updaterelationshipQuery = "UPDATE userrelationship SET relationshipID = '$relationshipID' WHERE (relatingUser='$curUser' AND relatedUser='$targetUserID') OR (relatingUser='$targetUserID' AND relatedUser='$curUser')";
            if($db->q($updaterelationshipQuery))
            {
                header("Location: ../index.php?show-profile=true&u=".$targetUser."");
            }
            else
            {
                echo "Unexpected error. Could not add friend.<br>Returning to previous page.";
                header("Refresh:2; URL=../index.php?show-profile=true&u=".$targetUser."");
            }
        }
    }
}


// Remove Friend
if(isset($_GET["removeFriend"]))
{
    $targetUser = mysqli_real_escape_string($db->db, $_GET["removeFriend"]);
    $getUserIDQuery = "SELECT userID FROM user WHERE publicID = '$targetUser' limit 1";
    $userIDResult = $db->q($getUserIDQuery);
    if($userIDResult->num_rows == 0)
    {
        echo "Could not find user.<br>Returning to previous page.";
        header("Refresh:2; URL=../index.php?show-profile=true&u=".$targetUser."");
    }
    else
    {        
        $userRow = $userIDResult->fetch_assoc();
        $targetUserID = $userRow["userID"];
        $deleteRelationshipQuery = "DELETE FROM userrelationship
        WHERE (relatingUser = '$curUser' AND relatedUser = '$targetUserID')
        OR (relatingUser = '$targetUserID' AND relatedUser = '$curUser')";
        if ($db->q($deleteRelationshipQuery))
        {
            header("Location: ../index.php?show-profile=true&u=".$targetUser."");
        }
        else
        {
            echo "Unexpected error. Could not remove relation.<br>Returning to previous page.";
            header("Refresh:2; URL=../index.php?show-profile=true&u=".$targetUser."");
        }
    }
}


?>