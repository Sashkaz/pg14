<?php
	session_start();
	if(isset($_SESSION['adminID']) || !empty($_SESSION['adminID'])){
		session_unset();
		session_destroy(); 
		header("Location: ../index.php");
	}
?>