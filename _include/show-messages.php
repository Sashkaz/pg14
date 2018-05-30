<div class="messages-wrap">
    <?php
    if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"]))
    {
        $curUser = $_SESSION["uid"];
        if (isset($_GET['u']) )
        {
            $targetUser = $_GET["u"];
            $targetUserQuery = "SELECT userID, firstName, lastName, profilePicURL
            FROM User
            WHERE publicID = ".$targetUser." limit 1";
            $targetUserResult = $db->q($targetUserQuery);
            if($targetUserResult->num_rows == 0)
            {
                echo "Select target user";
            }
            else
                {
                $targetUserRow = $targetUserResult->fetch_assoc();
                $targetUserID = $targetUserRow["userID"];
                $targetUserFname = $targetUserRow["firstName"];
                $targetUserPic = $targetUserRow["profilePicURL"];
                $messageQuery = "SELECT * FROM messages WHERE (relatingUser = ".$curUser." AND relatedUser = ".$targetUserID.") OR (relatingUser =".$targetUserID." AND relatedUser = ".$curUser.")";
                $messageResults = $db->q($messageQuery);
                ?>
                <div id="message-header">
                <a href="?show-profile=true&u=<?php echo $targetUser; ?>"><?php echo $targetUserFname; ?></a>
                </div>
                <div id="message-container">
                    <?php
                while ( $row = $messageResults -> fetch_assoc ())
                            {
                                $messageContent = $row["message"];
                                $dateSent = $row["dateSent"];
                                $outgoing = false;
                                if ($row["relatingUser"] == $curUser)
                                {
                                    $outgoing = true;
                                }

                                ?>
                                <div class="clear-line">
                                    <?php
                                    if ($outgoing)
                                    {
                                        ?>
                                        <span class="outgoing-message">
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <span class="sender-profile">
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
                                        <span class="ingoing-message">
                                        <?php
                                    }
                                    echo $messageContent;
                                    ?>
                                </span>
                                <?php
                                if ($outgoing)
                                    {
                                        ?>
                                        <div class="outgoing-message-time">
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="ingoing-message-time">
                                        <?php
                                    }
                                    ?>
                                    <?php echo $dateSent; ?>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                    <div class="clear-line">
                    </div>
                </div>
                <div id="message-footer">
                    <form name="message" action="_process/process-send-message.php" method="POST" class="message-form">
                        <textarea name="message" placeholder='<?php echo $lang["messages"]["chat"]["message-placeholder"]; ?>'></textarea>
                        <input type="hidden" name="targetUser" value=<?php echo "".$targetUser.""; ?> />
                        <input type="submit" name="sendMsg" value ='<?php echo $lang["messages"]["chat"]["send-button"]; ?>'/>
                    </form>
                </div>
                <?php
            }
        }
        else
        {
            echo $lang["messages"]["select-conversation"];
        }
    }
    else
    {
        echo "You need to log in to see messages.";
    }
    ?>
</div>