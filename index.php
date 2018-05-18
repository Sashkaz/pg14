<html>
	<?php include("_include/head.php"); ?>
	<body>
		<nav id="nav-wrapper">
			<div class="nav-city-wrapper">
				<h3>Stad</h3>
				<ul class="nav-city-dropdown">
					<li>
						<input type="checkbox" name="nav-city" value="1">
						<label for="nav-city">Linköping</label>
					</li>
					<li>
						<input type="checkbox" name="nav-city" value="2">
						<label for="nav-city">Malmö</label>
					</li>
					<li>
						<input type="checkbox" name="nav-city" value="3">
						<label for="nav-city">Uppsala</label>	
					</li>
					<li>
						<input type="checkbox" name="nav-city" value="4">
						<label for="nav-city">Stockholm</label>		
					</li>
				</ul>
			</div>
			<div class="nav-location-wrapper">
				<h3>Stad</h3>
				<ul class="nav-location-dropdown">
					<li>
						<input type="checkbox" name="nav-location" value="1">
						<label for="nav-location">24/7</label>
					</li>
					<li>
						<input type="checkbox" name="nav-location" value="2">
						<label for="nav-location">Wellness</label>
					</li>
					<li>
						<input type="checkbox" name="nav-location" value="3">
						<label for="nav-location">Friskis&Svettis</label>	
					</li>
					<li>
						<input type="checkbox" name="nav-location" value="4">
						<label for="nav-location">SATS</label>		
					</li>
				</ul>
			</div>
			<div class="nav-tag-wrapper">
				<h3>Hashtag</h3>
				<ul class="nav-tag-dropdown">
					<li>
						<input type="checkbox" name="nav-tag" value="1">
						<label for="nav-tag">Crossfit</label>
					</li>
					<li>
						<input type="checkbox" name="nav-tag" value="2">
						<label for="nav-tag">Styrketräning</label>
					</li>
					<li>
						<input type="checkbox" name="nav-tag" value="3">
						<label for="nav-tag">Cardio</label>	
					</li>
					<li>
						<input type="checkbox" name="nav-tag" value="4">
						<label for="nav-tag">Zumba</label>		
					</li>
				</ul>
			</div>
			<div class="nav-status-wrapper">
				<h3>Now training</h3>
				<ul class="nav-user-status-check">
					<li>
						<input type="checkbox" name="nav-user-status" value="true">
						<label for="nav-user-status">Now training</label>
					</li>
				</ul>
			</div>
		</nav>
		<?php 
			/*include("_include/activity-list.php");
			
			if(empty($_GET["register"]))
				include("_include/form-login.php"); 
			else 
				include("_include/form-register.php");*/
		?> 
	</body>
</html>
