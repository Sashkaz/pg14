<div class="activity-container">
  <div class="quick-facts">
    <h4>Your are now active at 24/7!</h4>
  </div>
  <div class="active-fact">
    <?php
      if ($req = $db->q("SELECT * FROM userlocationstatus")) //WHERE userLocationActivityID = $_SESSION[userLocationActivityID]"
      {
        if ($row = $req->fetch_assoc())
        {
          echo "<p>People active: $row[userLocationActivityID]</p>";
        }
      }
      else
      {
        echo false;
      }
    ?>
  </div>
  <div class="orientation-on-active">
    <input class="custom-button1" type="submit" onclick="document.location.href='_process/process-deactivate.php'" name="drop-session" value="Cancel training">
  </div>
</div>
