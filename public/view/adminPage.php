<?php
    @ob_start();
    session_start();
    $pageName = "E3T-Talents";
    $cssFile = "adminPageCss.css";
    include "/var/www/E3T/components/header.php";
?>
	<body>
		<form id="emailSearch">
			<div class="formBox">
				<div id="emailSearchLabel"><label  for="talentEmailInput">Search by email</label></div>
				<div id="talentEmailInputDiv"><input id="talentEmailInput"  type="email" name="talentEmailInput" placeholder=""></div>
				<input id="submitTalentEmail"  type="submit" value="Enter">
			</div>
		</form>

		<div class="profileBox">
			<div class="talentProfile">
				<img id="talentProfilePicture" src="imagePlaceholder/placeholder.jpg" alt="placeholder">
				<p id="talentName">Kratos</p>
				<p id="talentEmail">GodOfWar@gmail.com</p>
				<p id="talentPassword">Password</p>
				<p id="talentRating">Rating:****</p>

			</div>
			<div id="activityButtons">
			<input type="button" id="inactiveButton" value="Make Inactive">
			<input type="button" id="activeButton" value="Make Active">
			</div>
		</div>
	</body>


<?php

	include "/var/www/E3T/components/footer.html";


?>