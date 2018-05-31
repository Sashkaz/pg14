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
    echo "You need to log in to edit profile.<br>Returning to previous page.";
    header("Refresh:2; URL=../index.php?show-profile=true");
}

// Add Hashtag
if(isset($_POST["addHashtag"]))
{
    $hashtagID = mysqli_real_escape_string($db->db, $_POST["addHashtag"]);
    if ($hashtagID == "none")
    {
        echo "You need to select a hashtag to add.<br>Returning to previous page.";
        header("Refresh:2; URL=../index.php?show-profile=true");
    }
    else
    {
        $checkHashtagQuery = "SELECT hashtagListID
        FROM hashtaglist
        WHERE hashtagListID = ".$hashtagID." limit 1";
        $hashtagResult = $db->q($checkHashtagQuery);
        if($hashtagResult->num_rows == 0)
        {
            echo "Could not find hashtag.";
        }
        else
        {
            $duplicateHashtagQuery = "SELECT *
            FROM userhashtag
            WHERE hasthagListID = ".$hashtagID."
            AND userID = ".$curUser." limit 1";
            $duplicateHashtagResult = $db->q($duplicateHashtagQuery);
            if($duplicateHashtagResult->num_rows != 0)
            {
                echo "User and hashtag relation already exists.<br>Returning to previous page.";
                header("Refresh:2; URL=../index.php?show-profile=true");
            }
            else
            {
                $insertUserHashtagQuery = "INSERT INTO userhashtag (userID, hasthagListID) VALUES  ('$curUser', '$hashtagID')";
                if($db->q($insertUserHashtagQuery))
                {
                    header("Location: ../index.php?show-profile=true");
                }
                else
                {
                    echo "Unexpected error. Could not insert user hashtag relation to database.";
                }
            }
        }
    }
}

// Remove hashtag
if(isset($_POST["removeHashtag"]))
{
    $hashtagID = mysqli_real_escape_string($db->db, $_POST["removeHashtag"]);

    $removeUserHashtagQuery = "DELETE FROM userhashtag
    WHERE userID = ".$curUser." AND hasthagListID = ".$hashtagID."";
    $removeUserHashtagResult = $db->q($removeUserHashtagQuery);
    if($db->q($removeUserHashtagResult))
    {
        echo "Unexpected error. Could not remove user hashtag relation from database.";
    }
    else
    {
        header("Location: ../index.php?show-profile=true");
    }
}

// Change Gender Preference
if(isset($_POST["changeGenderPref"]))
{
    $genderPrefInput = mysqli_real_escape_string($db->db, $_POST["changeGenderPref"]);
    $genderPrefChangeQuery = "UPDATE user SET genderPreference = ".$genderPrefInput." WHERE userID=".$curUser."";
    $genderPrefChangeResult = $db->q($genderPrefChangeQuery);
    if($db->q($genderPrefChangeResult))
    {
        echo "Unexpected error. Could not change gender preference.";
    }
    else
    {
        header("Location: ../index.php?show-profile=true");
    }
}

// Add location
if(isset($_POST["addLocation"]))
{
    $locationID = mysqli_real_escape_string($db->db, $_POST["addLocation"]);
    if ($locationID == "none")
    {
        echo "You need to select a location to add.<br>Returning to previous page.";
        header("Refresh:2; URL=../index.php?show-profile=true");
    }
    else
    {
        $checkLocationQuery = "SELECT activityID
        FROM location
        WHERE activityID = ".$locationID." limit 1";
        $checkLocationResult = $db->q($checkLocationQuery);
        if($checkLocationResult->num_rows == 0)
        {
            echo "Could not find location.<br>Returning to previous page.";
            header("Refresh:2; URL=../index.php?show-profile=true");
        }
        else
        {
            $duplicateUserLocationQuery = "SELECT *
            FROM userlocation
            WHERE locationID = ".$locationID."
            AND userID = ".$curUser." limit 1";
            $duplicateUserLocationResult = $db->q($duplicateUserLocationQuery);
            if($duplicateUserLocationResult->num_rows != 0)
            {
                echo "User and location relation already exists.<br>Returning to previous page.";
                header("Refresh:2; URL=../index.php?show-profile=true");
            }
            else
            {
                $insertUserLocationQuery = "INSERT INTO userlocation (userID, locationID) VALUES  ('$curUser', '$locationID')";
                if($db->q($insertUserLocationQuery))
                {
                    header("Location: ../index.php?show-profile=true");
                }
                else
                {
                    echo "Unexpected error. Could not insert user location relation to database.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
            }
        }
    }
}

// Remove Location
if(isset($_POST["removeLocation"]))
{
    $locationID = mysqli_real_escape_string($db->db, $_POST["removeLocation"]);

    $removeUserLocationQuery = "DELETE FROM userlocation
    WHERE userID = ".$curUser." AND locationID = ".$locationID."";
    $removeUserLocationResult = $db->q($removeUserLocationQuery);
    if($db->q($removeUserLocationResult))
    {
        echo "Unexpected error. Could not remove user location relation from database.";
    }
    else
    {
        header("Location: ../index.php?show-profile=true");
    }
}

// Change Profile Picture
if(isset($_POST["uploadImage"]) || isset($_FILES["uploadImage"]))
{
    $imageName = $_FILES["uploadImage"]["name"]; 

    //Get the content of the image and then add slashes to it 
    $imagetmp = addslashes (file_get_contents($_FILES['uploadImage']['tmp_name']));
    $imageType = $_FILES["uploadImage"]["type"];
    $imageSize = $_FILES["uploadImage"]["size"];

    if (substr($imageType,0,5) == "image")
    {
        if ($imageSize <= 1024*1000)
        {
            $updateImageQuery = "UPDATE user SET profilePicURL = '$imagetmp' WHERE userID='$curUser'";
            if($db->q($updateImageQuery))
            {
                header("Location: ../index.php?show-profile=true");
            }
            else
            {
                echo "Unexpected error. Could not update profile picture.<br>Returning to previous page.";
                header("Refresh:2; URL=../index.php?show-profile=true");
            }
        }
        else
        {
            echo "Selected file is too large, please select a smaller file.<br>Returning to previous page.";
            header("Refresh:2; URL=../index.php?show-profile=true");
        }
    }
    else
    {
        echo "Selected file is not an image.<br>Returning to previous page.";
        header("Refresh:2; URL=../index.php?show-profile=true");
    }
}

// Change Account Information
if(isset($_POST["updateSettings"]))
{
    $userQuery = "SELECT *
    FROM User
    WHERE userID = ".$curUser." limit 1";
    $userResult = $db->q($userQuery);
    if($userResult->num_rows == 0)
    {
        echo "Could not find profile.<br>Returning to previous page.";
        header("Refresh:2; URL=../index.php?show-profile=true");
    }
    else
    {
        $userRow = $userResult->fetch_assoc();
        $userFirstName = $userRow["firstName"];
        $userLastName = $userRow["lastName"];
        $userEmail = $userRow["email"];
        $userPassword = $userRow["password"];
        $userBirthday = $userRow["dob"];
        $userGender = $userRow["gender"];
        
        function newHash($pwd){
            $salt = md5($pwd);
            $pwd = hash("sha256", $salt.$pwd.$salt);
            return $pwd;
        }
        //Initialize variables to prevent isset from causing errors later
        if(isset($_POST["firstName"]) && !empty($_POST["firstName"]))
        {
            $newFirstName = mysqli_real_escape_string($db->db, $_POST["firstName"]);
        }
        if(isset($_POST["lastName"]) && !empty($_POST["lastName"]))
        {
            $newLastName = mysqli_real_escape_string($db->db, $_POST["lastName"]);
        }
        if(isset($_POST["email"]) && !empty($_POST["email"]))
        {
            $newEmail = mysqli_real_escape_string($db->db, $_POST["email"]);
        }
        if(isset($_POST["newPassword"]) && !empty($_POST["newPassword"]))
        {
            $newPassword = mysqli_real_escape_string($db->db, $_POST["newPassword"]);
            $newPassword = newHash($newPassword);
        }
        if(isset($_POST["birthday"]) && !empty($_POST["birthday"]))
        {
            $newBirthday = mysqli_real_escape_string($db->db, $_POST["birthday"]);
            $newBirthday = date_format(date_create($newBirthday),"j-n-Y");
        }
        // New Birthday Input format
        $newBirthdayYear = mysqli_real_escape_string($db->db, $_POST["year"]);
        $newBirthdayMonth = mysqli_real_escape_string($db->db, $_POST["month"]);
        $newBirthdayDay = mysqli_real_escape_string($db->db, $_POST["day"]);
        $newBirthday = $newBirthdayDay."-".$newBirthdayMonth."-".$newBirthdayYear;
        if(isset($_POST["gender"]) && !empty($_POST["gender"]))
        {
            $newGender = mysqli_real_escape_string($db->db, $_POST["gender"]);
        }
        if(isset($_POST["password"]) && !empty($_POST["password"]))
        {
            $oldPassword = mysqli_real_escape_string($db->db, $_POST["password"]);
            $oldPassword = newHash($oldPassword);
        }
        if(isset($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"]))
        {
            $confirmOldPassword = mysqli_real_escape_string($db->db, $_POST["confirmPassword"]);
            $confirmOldPassword = newHash($confirmOldPassword);
        }
        if ($oldPassword != $confirmOldPassword)
        {
            echo "Old passwords do not match each other.<br>Returning to previous page.";
            header("Refresh:2; URL=../index.php?show-profile=true");
        }
        else if ($oldPassword == $userPassword)
        {
            //Compare input with current db entry
            if (isset($newFirstName) && $userFirstName != $newFirstName)
            {
                $firstNameChangeQuery = "UPDATE user SET firstName = '$newFirstName' WHERE userID='$curUser'";
                $firstNameChangeResult = $db->q($firstNameChangeQuery);
                if($db->q($firstNameChangeResult))
                {
                    echo "Unexpected error. Could not update Firstname.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
                else
                {
                    echo "Updated firstname.<br>";
                }
            }
            if (isset($newLastName) && $userLastName != $newLastName)
            {
                $lastNameChangeQuery = "UPDATE user SET lastName = '$newLastName' WHERE userID='$curUser'";
                $lastNameChangeResult = $db->q($lastNameChangeQuery);
                if($db->q($lastNameChangeResult))
                {
                    echo "Unexpected error. Could not update lastName.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
                else
                {
                    echo "Updated lastname.<br>";
                }
            }
            if (isset($newEmail) && $userEmail != $newEmail)
            {
                $emailChangeQuery = "UPDATE user SET email = '$newEmail' WHERE userID='$curUser'";
                $emailChangeResult = $db->q($emailChangeQuery);
                if($db->q($emailChangeResult))
                {
                    echo "Unexpected error. Could not update Email.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
                else
                {
                    echo "Updated email.<br>";
                }
            }
            if (isset($newPassword) && $userPassword != $newPassword)
            {
                $passwordChangeQuery = "UPDATE user SET password = '$newPassword' WHERE userID='$curUser'";
                $passwordChangeResult = $db->q($passwordChangeQuery);
                if($db->q($passwordChangeResult))
                {
                    echo "Unexpected error. Could not update Password.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
                else
                {
                    echo "Updated password<br>";
                }
            }
            if (isset($newBirthday) && $userBirthday != $newBirthday)
            {
                $birthdayChangeQuery = "UPDATE user SET dob = '$newBirthday' WHERE userID='$curUser'";
                $birthdayChangeResult = $db->q($birthdayChangeQuery);
                if($db->q($birthdayChangeResult))
                {
                    echo "Unexpected error. Could not update Birthday.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
                else
                {
                    echo "Updated birthday<br>";
                }
            }
            if (isset($newGender) && $userGender != $newGender)
            {
                $genderChangeQuery = "UPDATE user SET dob = '$newGender' WHERE userID='$curUser'";
                $genderChangeResult = $db->q($genderChangeQuery);
                if($db->q($genderChangeResult))
                {
                    echo "Unexpected error. Could not update gender.<br>Returning to previous page.";
                    header("Refresh:2; URL=../index.php?show-profile=true");
                }
                else
                {
                    echo "Updated Gender<br>";
                }
            }
            echo "Updated successfully.<br>Returning to previous page.";
            header("Refresh:2; URL=../index.php?show-profile=true");
        }
        else
        {
            echo "Invalid Password.<br>Returning to previous page.";
            header("Refresh:2; URL=../index.php?show-profile=true");
        }
    }
}
/* echo "Unexpected error. Could not update correctly.<br>Returning to previous page.";
header("Refresh:2; URL=../index.php?show-profile=true"); */
?>