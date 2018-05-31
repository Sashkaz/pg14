<?php
$validProfile = false;
if (isset($_GET['u']) )
{
    $targetUser = $_GET["u"];
    $db = new Database("localhost", "root", "", "projekt");
    $userQuery = "SELECT *
    FROM User
    WHERE publicID = ".$targetUser." limit 1";
    $userResult = $db->q($userQuery);
    if($userResult->num_rows == 0)
    {
        echo "Could not find profile.";
    }
    else
    {
        $validProfile = true;
    }
}
else if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"]))
{
    $curUser = $_SESSION["uid"];
    $ownPage = true;
    $userQuery = "SELECT *
    FROM User
    WHERE userID = ".$curUser." limit 1";
    $userResult = $db->q($userQuery);
    if($userResult->num_rows == 0)
    {
        echo "Could not find profile.";
    }
    else
    {
        $validProfile = true;
    }
}
if ($validProfile)
{
    $userRow = $userResult->fetch_assoc();
    $userID = $userRow["userID"];
    $userFirstName = $userRow["firstName"];
    $userLastName = $userRow["lastName"];
    $userEmail = $userRow["email"];
    $userPassword = $userRow["password"];
    $userPicture = $userRow["profilePicURL"];
    $userGender = $userRow["gender"];
    
    $userBirthday = $userRow["dob"];
    $userBirthdaySplit = explode("-", $userBirthday);
    $userBirthdayDay = $userBirthdaySplit[0];
    if ($userBirthdayDay < 10)
    {
        $userBirthdayDay = "0".$userBirthdayDay;
    }
    $userBirthdayMonth = $userBirthdaySplit[1];
    if ($userBirthdayMonth < 10)
    {
        $userBirthdayMonth = "0".$userBirthdayMonth;
    }
    $userBirthdayYear = $userBirthdaySplit[2];
    $userBirthdayFormat = date_format(date_create($userBirthdayYear."-".$userBirthdayMonth."-".$userBirthdayDay),"Y-m-d");

    $userPubID = $userRow["publicID"];
    $userAccountStatus = $userRow["accountStatusID"];
    $userGenderPref = $userRow["genderPreference"];
    $anyGender = false;
    if($userGenderPref == 0)
    {
        $anyGender = true;
    }
    

    if ($_SESSION["uid"] == $userID)
    {
    $ownPage = true;
    }
    else
    {
    $ownPage = false;
    }
    
    if ($ownPage)
    {
        ?>
        <div id="profile-page-container">
            <div class="profile-content-divider">
                <span class="profile-picture">
                    <?php
                    if ($userPicture != "null")
                    {
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($userPicture).'"/>';
                    }
                    else
                    {
                        echo '<img src="_assets/_img/150x150.jpeg"/>';
                    }
                    ?>
                </span>
                <span class="profile-name">
                    <?php echo $userFirstName." ".$userLastName."";
                    ?>
                </span>
            </div>
            <div class="profile-content-divider">
                <h3><?php echo $lang["my-profile"]["upload-pic"]; ?></h3>
                <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                    <input type="file" name="uploadImage">
                    <input type="submit" value="Upload">
                </form>
            </div>
            <div class="profile-content-divider" id="filter">
                <h3><?php echo $lang["my-profile"]["filter-options"]["header"]; ?></h3>
                <span class="left-side">
                    <div class="settings-title"><?php echo $lang["my-profile"]["filter-options"]["add-hashtag"]["header"]; ?></div>
                    <?php
                    $hashtagListQuery = "SELECT * FROM userhashtag WHERE userID = ".$curUser."";
                    $hashtagResults = $db->q($hashtagListQuery);
                    $hashtagNumber = 0;
                    while ( $row = $hashtagResults -> fetch_assoc ())
                    {
                        ?>
                        <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                        <?php
                        $hashtagNumber++;
                        $hashtagID = $row["hasthagListID"];
                        $hashtagNameQuery = "SELECT name FROM hashtaglist WHERE hashtagListID = ".$hashtagID."";
                        $hashtagNameResult = $db->q($hashtagNameQuery);
                        if($hashtagNameResult->num_rows == 0)
                        {
                            echo "Could not find hashtag.";
                        }
                        else
                        {
                            $hashtagNameRow = $hashtagNameResult->fetch_assoc();
                            $hashtagName = $hashtagNameRow["name"];
                            ?>
                            <div class="profile-added-items"><?php echo $hashtagName; ?>
                            <input type="hidden" name="removeHashtag" value="<?php echo $hashtagID; ?>">
                            <button type="submit" style="float: right;"><i class="fa fa-minus-circle"></i></button>
                            </div>
                            <?php
                        }
                        ?>
                        </form>
                        <?php
                    }
                    if ($hashtagNumber < 6)
                    {
                        ?>
                        <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                            <div class="profile-added-items">
                                <select name="addHashtag" style="float: left;">
                                <option value="none" disabled selected><?php echo $lang["my-profile"]["filter-options"]["add-hashtag"]["default"]; ?></option>
                                    <?php
                                    $allHashtagsQuery = "SELECT h.name, h.hashtagListID FROM hashtaglist h
                                    LEFT JOIN (SELECT userID, hasthagListID FROM userhashtag WHERE userID='$userID') uh ON uh.hasthagListID = h.hashtagListID
                                    WHERE uh.hasthagListID IS NULL";
                                    $allHashtagsResults = $db->q($allHashtagsQuery);
                                    while ( $row = $allHashtagsResults -> fetch_assoc ())
                                    {
                                        $curHashtagID = $row["hashtagListID"];
                                        $curHashtagName = $row["name"];
                                        ?>
                                        <option value="<?php echo $curHashtagID; ?>"><?php echo $curHashtagName; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" style="float: right;"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </form>
                        <?php
                    }

                    ?>
                </span>
                <span class="right-side">
                    <div class="settings-title"><?php echo $lang["my-profile"]["filter-options"]["add-location"]["header"]; ?></div>
                    <?php
                    $locationListQuery = "SELECT * FROM userlocation WHERE userID = ".$curUser."";
                    $locationResults = $db->q($locationListQuery);
                    $locationNumber = 0;
                    while ( $row = $locationResults -> fetch_assoc ())
                    {
                        ?>
                        <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                            <?php
                            $locationNumber++;
                            $locationID = $row["locationID"];
                            $locationInfoQuery = "SELECT * FROM location WHERE activityID = ".$locationID."";
                            $locationResult = $db->q($locationInfoQuery);
                            if($locationResult->num_rows == 0)
                            {
                                echo "Could not find location.";
                            }
                            else
                            {
                                $locationInfoRow = $locationResult->fetch_assoc();
                                $locationName = $locationInfoRow["name"];
                                ?>
                                <div class="profile-added-items">
                                <button type="submit" style="float: left;"><i class="fa fa-minus-circle"></i></button>
                                <?php echo $locationName; ?>
                                <input type="hidden" name="removeLocation" value="<?php echo $locationID; ?>">
                                </div>
                                <?php
                            }
                            ?>
                        </form>
                        <?php
                    }
                    if ($locationNumber < 6)
                    {
                        ?>
                        <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                        <div class="profile-added-items">
                        <button type="submit" style="float: left;"><i class="fa fa-plus-circle"></i></button>
                            <select name="addLocation" style="float: right;">
                                <option value="none" disabled selected><?php echo $lang["my-profile"]["filter-options"]["add-location"]["default"]; ?></option>
                                <?php
                                $allLocationsQuery = "SELECT l.name, l.activityID FROM location l
                                LEFT JOIN (SELECT userID, locationID FROM userlocation WHERE userID='$userID') ul ON ul.locationID = l.activityID
                                WHERE ul.locationID IS NULL";
                                $allLocationsResults = $db->q($allLocationsQuery);
                                while ( $row = $allLocationsResults -> fetch_assoc ())
                                {
                                    $curLocationID = $row["activityID"];
                                    $curLocationName = $row["name"];
                                    $curLocationAddress = $row["address"];
                                    ?>
                                    <option value="<?php echo $curLocationID; ?>"><?php echo $curLocationName; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </span>
                <div class="clear-line"></div>
                <div class="settings-title"><?php echo $lang["my-profile"]["filter-options"]["gender-preference"]["header"]; ?></div>
                <span class="left-side">
                <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                        <div class="profile-added-items">
                        <input type="hidden" name="changeGenderPref" value="0">
                        <button type="submit" class="profile-gender-btn <?php if($anyGender){echo "current";}?>"><?php echo $lang["my-profile"]["filter-options"]["gender-preference"]["any"]; ?></button>
                        </div>
                    </form>
                </span>
                <span class="right-side">
                    <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                        <div class="profile-added-items">
                        <input type="hidden" name="changeGenderPref" value="1">
                        <button type="submit" class="profile-gender-btn <?php if(!$anyGender){echo "current";}?>"><?php echo $lang["my-profile"]["filter-options"]["gender-preference"]["same"]; ?></button>
                        </div>
                    </form>
                </span>
                <div class="clear-line"></div>
            </div>
            <div class="profile-content-divider" id="account">
            <h3><?php echo $lang["my-profile"]["account-info"]["header"]; ?></h3>
            <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                <span class="left-side">
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["fname"]; ?><br><input type="text" name="firstName" class="custom-input1 split-input" placeholder='<?php echo $userFirstName; ?>' ></div>
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["email"]; ?><br><input type="email" name="email" class="custom-input1 split-input" placeholder='<?php echo $userEmail; ?>' ></div>



                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["dob"]; ?><br>
                    
                    <select name="year" class="custom-input1" >
                        <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["dob"]["y"]; ?></option>
                            <?php   
                                $x = 2002;
                                while($x > 1950){
                                    if ($userBirthdayYear == $x)
                                    {
                                        echo "<option value=$x selected>$x</option>";
                                    }
                                    else
                                    {
                                    echo "<option value=$x>$x</option>";
                                    }
                                    $x--;
                                }
                            ?>
                    </select>
                    <select name="month" class="custom-input1">
                        <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["dob"]["m"]; ?></option>
                            <?php                                
                                $x = 1;
                                while($x <= 12){
                                    $monthName = strftime('%B', mktime(0, 0, 0, $x));
                                    $monthNames = strftime("%B");
                                    if ($userBirthdayMonth == $x)
                                    {
                                        echo "<option value=$x selected>$monthName</option>";
                                    }
                                    else
                                    {
                                    echo "<option value=$x>$monthName</option>";
                                    }
                                    $x++;
                                }
                            ?>
                    </select> 
                    <select name="day" class="custom-input1" >
                        <option value="none" disabled selected><?php echo $lang["reg-form"]["placeholder"]["dob"]["d"]; ?></option>
                            <?php   
                                $x = 1;
                                while($x <= 31){
                                    if ($userBirthdayDay == $x)
                                    {
                                        echo "<option value=$x selected>$x</option>";
                                    }
                                    else
                                    {
                                    echo "<option value=$x>$x</option>";
                                    }
                                    $x++;
                                }
                            ?>
                    </select>
                    </div>
                    <p>
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["old-pwd"]; ?><br><input type="password" name="password" class="custom-input1 split-input"></div>
                    </p>
                </span>
                <span class="right-side">
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["lname"]; ?><br><input type="text" name="lastName" class="custom-input1 split-input" placeholder='<?php echo $userLastName; ?>' ></div>
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["new-pwd"]; ?><br><input type="password" name="newPassword" class="custom-input1 split-input"></div>
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["gender"]["header"]; ?><br>

                    <select name="gender" class="custom-input1" >
                        <option value=1 <?php if ($userGender == 1) { echo 'selected'; }?>><?php echo $lang["my-profile"]["account-info"]["placeholder"]["gender"]["m"]; ?></option>
                        <option value=2 <?php if ($userGender == 2) { echo 'selected'; }?>><?php echo $lang["my-profile"]["account-info"]["placeholder"]["gender"]["f"]; ?></option>
                        <option value=0 <?php if ($userGender == 0) { echo 'selected'; }?>><?php echo $lang["my-profile"]["account-info"]["placeholder"]["gender"]["o"]; ?></option>
                    </select>
                    </div>
                    <p>
                    <div class="field-container"><?php echo $lang["my-profile"]["account-info"]["placeholder"]["conf-pwd"]; ?><br><input type="password" name="confirmPassword" class="custom-input1 split-input"></div>
                    </p>
                </span>
                <input class="custom-button1 split-buttons" type="submit" style="margin: auto; display: block;" name="updateSettings" value = '<?php echo $lang["my-profile"]["account-info"]["update-button"]; ?>'/>
            </form>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div id="profile-page-container">
            <div class="profile-content-divider">
                <span class="profile-picture">
                    <?php
                    if ($userPicture != "null")
                    {
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($userPicture).'"/>';
                    }
                    else
                    {
                        echo '<img src="_assets/_img/150x150.jpeg"/>';
                    }
                    ?>
                </span>
                <span class="profile-name">
                    <?php echo $userFirstName." ".$userLastName."";
                    ?>
                </span>
            </div>
            <div class="profile-content-divider" id="contact-buddy">
        <a href="?show-messages=true&u=<?php echo $targetUser; ?>"><i class="fa fa-envelope"></i></a>
        <a href="_process/process-userrelation.php?addFriend=<?php echo $targetUser; ?>"><i class="fa fa-user-plus"></i></i></a>
        <a href="?blockBuddy=true&u=<?php echo $targetUser; ?>"><i class="fa fa-ban"></i></a>
            </div>
            <div class="profile-content-divider">
                <h3>Buddy Info</h3>
                <span class="left-side">
                    <div class="settings-title">Hashtags</div>
                    <?php
                    $hashtagListQuery = "SELECT * FROM userhashtag WHERE userID = ".$userID."";
                    $hashtagResults = $db->q($hashtagListQuery);
                    while ( $row = $hashtagResults -> fetch_assoc ())
                    {
                        ?>
                        <?php
                        $hashtagID = $row["hasthagListID"];
                        $hashtagNameQuery = "SELECT name FROM hashtaglist WHERE hashtagListID = ".$hashtagID."";
                        $hashtagNameResult = $db->q($hashtagNameQuery);
                        if($hashtagNameResult->num_rows == 0)
                        {
                            echo "Could not find hashtag.";
                        }
                        else
                        {
                            $hashtagNameRow = $hashtagNameResult->fetch_assoc();
                            $hashtagName = $hashtagNameRow["name"];
                            ?>
                            <div class="profile-added-items"><?php echo $hashtagName; ?></div>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </span>
                <span class="right-side">
                    <div class="settings-title">Locations</div>
                    <?php
                    $locationListQuery = "SELECT * FROM userlocation WHERE userID = ".$userID."";
                    $locationResults = $db->q($locationListQuery);
                    while ( $row = $locationResults -> fetch_assoc ())
                    {
                        ?>
                            <?php
                            $locationID = $row["locationID"];
                            $locationInfoQuery = "SELECT * FROM location WHERE activityID = ".$locationID."";
                            $locationResult = $db->q($locationInfoQuery);
                            if($locationResult->num_rows == 0)
                            {
                                echo "Could not find location.";
                            }
                            else
                            {
                                $locationInfoRow = $locationResult->fetch_assoc();
                                $locationName = $locationInfoRow["name"];
                                ?>
                                <div class="profile-added-items"><?php echo $locationName; ?></div>
                                <?php
                            }
                            ?>
                        <?php
                    }
                    ?>
                </span>
                <div class="clear-line"></div>
            </div>
        </div>
        <?php
    }
}

?>