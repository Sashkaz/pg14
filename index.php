<html>
	<?php include("_include/head.php"); ?>
	<body>
		<?php 
			if(empty($_GET["register"]))
				include("_include/form-login.php"); 
			else 
				include("_include/form-register.php");
		?> 
	</body>
</html>
