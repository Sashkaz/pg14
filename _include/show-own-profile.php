<link rel="stylesheet" type="text/css" href="_include/profile.css">
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
    $targetUser = $_SESSION["uid"];
    $ownPage = true;
    $userQuery = "SELECT *
    FROM User
    WHERE userID = ".$targetUser." limit 1";
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
                <h3>Upload Profile Picture</h3>
                <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                    <input type="file" name="uploadImage">
                    <input type="submit" value="Upload">
                </form>
            </div>
            <div class="profile-content-divider" id="filter">
                <h3>Filter Options</h3>
                <span class="left-side">
                    <div class="settings-title">Hashtags</div>
                    <?php
                    $hashtagListQuery = "SELECT * FROM userhashtag WHERE userID = ".$targetUser."";
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
                            <input type="text"  value="<?php echo $hashtagName; ?>" class="readonly" readonly>
                            <input type="hidden" name="removeHashtag" value="<?php echo $hashtagID; ?>">
                            <button type="submit"><i class="fa fa-minus-circle"></i></button>
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
                            <select name="addHashtag">
                            <option value="none" disabled selected>Add Hashtag</option>
                                <?php
                                $allHashtagsQuery = "SELECT * FROM hashtaglist";
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
                            <button type="submit"><i class="fa fa-plus-circle"></i></button>
                        </form>
                        <?php
                    }

                    ?>
                    <div class="settings-title">Gender Preference</div>
                    <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                    <input type="hidden" name="changeGenderPref" value="0">
                    <div class="input-describer">Any Gender</div><button type="submit"><i class="
                    <?php 
                    if($anyGender)
                    {
                        echo "fa fa-dot-circle";
                    }
                    else
                    {
                        echo "fa fa-circle";
                    }
                    ?>
                    "></i></button>
                    </form>
                    <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                    <input type="hidden" name="changeGenderPref" value="1">
                    <div class="input-describer">Same Gender Only</div><button type="submit"><i class="
                    <?php 
                    if(!$anyGender)
                    {
                        echo "fa fa-dot-circle";
                    }
                    else
                    {
                        echo "fa fa-circle";
                    }
                    ?>
                    "></i></button>
                    </form>
                </span>
                <span class="right-side">
                    <div class="settings-title">Locations</div>
                    <?php
                    $locationListQuery = "SELECT * FROM userlocation WHERE userID = ".$targetUser."";
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
                                <button type="submit"><i class="fa fa-minus-circle"></i></button>
                                <input type="text"  value="<?php echo $locationName; ?>" class="readonly" readonly>
                                <input type="hidden" name="removeLocation" value="<?php echo $locationID; ?>">
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
                        <button type="submit"><i class="fa fa-plus-circle"></i></button>
                            <select name="addLocation">
                                <option value="none" disabled selected>Add Location</option>
                                <?php
                                $allLocationsQuery = "SELECT * FROM location";
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
                        </form>
                        <?php
                    }
                    ?>
                </span>
                <div class="clear-line"></div>
            </div>
            <div class="profile-content-divider" id="account">
            <h3>Account Information</h3>
            <form method="POST" action="_process/process-edit-profile.php" enctype="multipart/form-data">
                <span class="left-side">
                    <div class="field-container">Firstname:<br><input type="text" name="firstName" value="<?php echo $userFirstName; ?>"></div>
                    <div class="field-container">Email:<br><input type="email" name="email" value="<?php echo $userEmail; ?>"></div>
                    <div class="field-container">Age:<br><input type="date" name="birthday" max="2002-01-01" value="<?php echo $userBirthdayFormat; ?>"></div>
                    <p>
                    <div class="field-container">Old Password:<br><input type="password" name="password" ></div>
                    </p>
                </span>
                <span class="right-side">
                    <div class="field-container">Lastname:<br><input type="text" name="lastName" value="<?php echo $userLastName; ?>"></div>
                    <div class="field-container">New Password:<br><input type="password" name="newPassword"></div>
                    <div class="field-container">Gender:<br><input type="radio" name="gender" value="1" <?php if ($userGender == 1) { echo 'checked="checked"'; }?>> Male
                    <input type="radio" name="gender" value="2" <?php if ($userGender == 2) { echo 'checked="checked"'; }?>> Female
                    <input type="radio" name="gender" value="0" <?php if ($userGender == 0) { echo 'checked="checked"'; }?>> Other</div>
                    <p>
                    <div class="field-container">Confirm Old Password:<br><input type="password" name="confirmPassword" ></div>
                    </p>
                </span>
                <input type="submit" name="updateSettings" value="Update">
            </form>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        Other User Page
        options
        Hashtag list
        Locations
        Send Message
        Add to buddy list
        Block User
        <?php
    }
}

?>