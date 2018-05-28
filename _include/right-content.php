<link rel="stylesheet" type="text/css" href="_include/rightbar-css.css">
<?php
    $db = new Database("localhost", "root", "", "projekt");
?>
<ul class="right-bar-list">
    <?php
        if($req = $db->q("select * from location")){
            while ($row = $req->fetch_assoc())
            { echo    "<li class=right-bar-item><a class=right-bar-link href=# > $row[name] <br> <span style=font-size:10px;color:grey;font-style:italic>$row[address]</span> </a> </li>
            ";}
        }
        else
        {
            echo false;
        }
      ?>
    </ul>
