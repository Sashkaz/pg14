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
    echo "You need to log in to see messages.";
}

// Add Hashtag
if(isset($_POST["addHashtag"]))
{
    $hashtagID = mysqli_real_escape_string($db->db, $_POST["addHashtag"]);

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
        WHERE hashtagListID = ".$hashtagID."
        AND userID = ".$curUser." limit 1";
        $duplicateHashtagResult = $db->q($duplicateHashtagQuery);
        if($duplicateHashtagResult->num_rows != 0)
        {
            echo "User and hashtag relation already exists.";
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

    $checkLocationQuery = "SELECT activityID
    FROM location
    WHERE activityID = ".$locationID." limit 1";
    $checkLocationResult = $db->q($checkLocationQuery);
    if($checkLocationResult->num_rows == 0)
    {
        echo "Could not find location.";
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
            echo "User and location relation already exists.";
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
                echo "Unexpected error. Could not insert user location relation to database.";
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
    echo "Attempting to update profile picture.";
    $imageName = $_FILES["uploadImage"]["name"]; 

    //Get the content of the image and then add slashes to it 
    $imagetmp = addslashes (file_get_contents($_FILES['uploadImage']['tmp_name']));
    $imageType = $_FILES["uploadImage"]["type"];

    if (substr($imageType,0,5) == "image")
    {
        echo "image type is: ".$imageType;
        echo '<img src="data:image/jpeg;base64,'.base64_encode($imagetmp).'"/>';
        //Insert the image name and image content in image_table
        // Run this SQL Query to update DB to contain blobs
        // ALTER TABLE `user` CHANGE `profilePicURL` `profilePicURL` BLOB NULL DEFAULT NULL;
        $updateImageQuery = "UPDATE user SET profilePicURL = ".$imagetmp." WHERE userID=4";
        if($db->q($updateImageQuery))
        {
            echo "Uploaded: ".$imageName;
            echo "<br>";
            /* header("Location: ../index.php?show-profile=true"); */
        }
        else
        {
            echo "<br>";
            printf("Errormessage: %s\n", $db->lastError());
            echo "<br>";
            echo "Could not upload: ".$imageName;
            /* echo $updateImageQuery; */
            echo "Unexpected error. Could not update profile picture.";
        }
    }
    else
    {
        echo "Selected file is not an image.";
    }
}
?>