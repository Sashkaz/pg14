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
    die("You need to log in to see messages.");
}
if(isset($_POST["targetUser"]) && isset($_POST["message"]))
{
    $targetUser = mysqli_real_escape_string($db->db, $_POST["targetUser"]);
    $targetUserQuery = "SELECT userID
    FROM User
    WHERE publicID = ".$targetUser." limit 1";
    $targetUserResult = $db->q($targetUserQuery);
    if($targetUserResult->num_rows == 0)
    {
        die("Could not find target user");
    }
    $targetUserRow = $targetUserResult->fetch_assoc();
    $targetUserID = $targetUserRow["userID"];

    $message = mysqli_real_escape_string($db->db, $_POST["message"]);
    $message = trim($message);
    if ($message == "")
    {
        die("Empty message.");
    }
}
else
{
    die("Could not find post message or message receiver.");
}

$sendMessageQuery = "INSERT INTO messages (relatingUser, relatedUser, message, dateSent) VALUES (".$curUser.",".$targetUserID.",'".$message."', NOW())";
if(!$db->q($sendMessageQuery))
{
    die("Could not send message");
}
header("Location: ../index.php?show-messages=true&u=".$targetUser."#message-footer");
?>