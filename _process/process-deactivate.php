<?php
  session_start();
  include("../_include/_models/db.php");
  $db = new Database("localhost", "root", "", "projekt");

  unset($_SESSION["active"]);
  $_SESSION["active"] = "";
  $querydelete = "DELETE FROM `userlocationstatus` WHERE userLocationActivityID = $_SESSION[userLocationActivityID]";
  if ($req = $db->q($querydelete))
  {
    header("Location: ../index.php");
  }
  else {
    echo false;
  }
?>
