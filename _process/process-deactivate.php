<?php
  session_start();
  include("../_include/_models/db.php");
  $deactivate = new Database("localhost", "root", "", "projekt");

  unset($_SESSION["active"]);
  $_SESSION["active"] = "";
  echo $_SESSION["userLocationActivityID"];
  $querydelete = "DELETE FROM `userlocationstatus` WHERE userLocationActivityID = $_SESSION[userLocationActivityID]";
  if ($req = $deactivate->q($querydelete))
  {
    header("Location: ../index.php");
  }
  else {
    echo false;
  }
?>
