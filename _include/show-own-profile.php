<?php
if (isset($_GET['u']) )
{
    $targetUser = $_GET["u"];
}
else
{}
if(isset($_SESSION["uid"]) && !empty($_SESSION["uid"]))
{
    $curUser = $_SESSION["uid"];
    if (isset($_GET['u']) )
    {
        $targetUser = $_GET["u"];

?>