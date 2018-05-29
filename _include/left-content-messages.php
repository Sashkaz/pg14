<?php
include("_include/_models/db.php");
if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"]))
{
    $curUser = $_SESSION["uid"];
    $db = new Database("localhost", "root", "", "projekt");
    $conversationQuery = "SELECT DISTINCT relatingUser as targetUser FROM messages WHERE relatedUser = ".$curUser."
    UNION
    SELECT DISTINCT relatedUser as targetUser FROM messages WHERE relatingUser = ".$curUser."";
    $conversationResults = $db->q($conversationQuery);
?>
<div id="conversation-container">
    <?php
    while ( $row = $conversationResults -> fetch_assoc ())
    {
        $targetUserID = $row["targetUser"];
        $lastMessageQuery = "SELECT * FROM messages WHERE (relatedUser = ".$curUser." AND relatingUser =".$targetUserID.") OR (relatedUser = ".$targetUserID." AND relatingUser =".$curUser.") ORDER BY dateSent";
        $lastMessageResults = $db->q($lastMessageQuery);
        if($lastMessageResults->num_rows == 0)
        {
            echo "Could not find any message in selected conversation.";
        }
        else
            {
            $messageRow = $lastMessageResults->fetch_assoc();
            $messageContent = $messageRow["message"];
            $dateSent = $messageRow["dateSent"];
            if ($messageRow["relatingUser"] == $curUser)
            {
                $outgoing = true;
            }
            else
            {
                $outgoing = false;
            }
            $targetUserQuery = "SELECT firstName, lastName, profilePicURL, publicID
            FROM User
            WHERE userID = ".$targetUserID." limit 1";
            $targetUserResult = $db->q($targetUserQuery);
            if($targetUserResult->num_rows == 0)
            {
                echo "Could not find user";
            }
            else
            {
                $targetUserRow = $targetUserResult->fetch_assoc();
                $targetUserPubID = $targetUserRow["publicID"];
                $targetUserFname = $targetUserRow["firstName"];
                $targetUserPic = $targetUserRow["profilePicURL"];
                ?>
                <a href="?show-messages=true&u=<?php echo $targetUserPubID; ?>">
                    <div class="conversation-selector">
                        <span class="conversation-pic">
                            <?php
                            if ($targetUserPic != "null")
                            {
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($targetUserPic).'"/>';
                            }
                            else
                            {
                                echo '<img src="_assets/_img/150x150.jpeg"/>';
                            }
                            ?>
                        </span>
                        <span class="conversation-name">
                            <?php echo $targetUserFname; ?>
                        </span>
                    </div>
                </a>
                <?php
            }
        }
    }
    ?>
    </div>
    <?php
}
?>