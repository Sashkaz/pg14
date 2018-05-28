  <?php
    session_start();
    include("../_include/_models/db.php");
    $db = new Database("localhost", "root", "", "projekt");

$querylocation = "INSERT INTO userlocation (locationID, userID) VALUES ($_GET[locationID], $_SESSION[uid])";
if ($req = $db->q($querylocation))
{
  $generateactivity = "INSERT INTO userlocationstatus (startingTime) VALUES (CURRENT_TIMESTAMP)";
  if ($req = $db->q($generateactivity))
  {
    $supertable = "select
        userlocation.userLocationID,
        locationID,
        userID,
        userLocationActivityID,
        startingTime from userlocation
        left join
        userlocationstatus on userlocation.userLocationID = userlocationstatus.userLocationID";
    if ($req = $db->q($supertable))
    { if ($row = $req->fetch_assoc())
      {
        $queryactivity = "UPDATE userlocationstatus SET userLocationID = $row[userLocationID]";
        if ($row["userID"] = $_SESSION["uid"])
        {
          $db->q($queryactivity);
        }
      }
    }
  }
}
header("Location: ../index.php");
?>
