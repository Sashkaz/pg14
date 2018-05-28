<?php
    $db = new Database("localhost", "root", "", "projekt");
?>
<div class="activity-container">
  <div class="active-fact">
    <?php
      if ($req = $db->q("SELECT * FROM userlocationstatus WHERE userLocationActivityID = $_POST[activity]"))
      {
        while ($row = $req->fetch_assoc())
        {
          echo "<h3>People active:count($row[userLocationActivityID])</h3>";
        }
      }
      else
      {
        echo false;
      }
    ?>
  </div>
</div>

<?php
/* TODO:
-se fakta om platsen man går aktiv på
-avbryta aktiv träning
-timestamp för aktiv
-inaktivera aktiv träning efter tid
-process sidor aktiv och inaktiv.
-vid inaktiv, droppa table
 ?>
