<?php

$pageName = "E3T-Talents";
$cssFile = "stylesheet.css";
include "/var/www/E3T/components/header.php";

?>
<div id="container">
	<div id="form">
		<h2> contact us </h2>
		<form method="POST" action="#">
			<p class="labels"> <label for="dataName"> Name </label> </p>
			<p class="texts"> <input type="text" name="dataName"> </p>
			<p class="labels"> <label for="dataEmail"> Email </label> </p>
			<p class="texts"> <input type="email" name="dataEmail"> </p>
			<p class="labels"> <label for="dataComment"> Comment </label> </p>
			<p class="texts"> <textarea name="dataComment"> </textarea> </p>
			<p id="submit"> <input type="submit" value="Send" id="submit2"> </p>
		</form>
	</div>
	
	<?php
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$dataName = filter_input(INPUT_POST,"dataName");
		$dataEmail = filter_input(INPUT_POST,"dataEmail");
		$dataComment = filter_input(INPUT_POST,"dataComment");
		
		$errors = array();
		$flag = 0;
		
		if($dataEmail = filter_input (INPUT_POST, "dataEmail", FILTER_VALIDATE_EMAIL)){
			echo "";
		}
		else {
			array_push($error, "<p> Your email should contain an '@' and end with '.com' </p>");
			$flag = 1;
		}
		
		if(str_word_count($dataComment) < 5) {
			array_push($error, "<p> Your comment should contain a minimum of 5 words </p>");
			$flag = 1;
		}
		
		if($flag == 0){

            echo "<script>alert('Message send')</script>";
        }
        else{
            foreach($errors as $error){
                echo $error;
            }
        }
	}
	?>
	
	<div id="contactInfo">
		<div class="contactBox">
			<div class="contactPicture">
				<img src="images/profilePictures/contact1.jpg" class="contactPortrait">
			</div>
			<div class="contactText">
				<h3> FirstName LastName </h3>
				<p class="texts"> manager </p>
				<p class="mail"> name@mail.com </p>
				<p class="phone"> +12 345 6789 </p>
			</div>
		</div>
		<div class="contactBox">
			<div class="contactPicture">
				<img src="images/profilePictures/contact2.jpg" class="contactPortrait">
			</div>
			<div class="contactText">
				<h3> FirstName LastName </h3>
				<p class="texts"> manager </p>
				<p class="mail"> name@mail.com </p>
				<p class="phone"> +12 345 6789 </p>
			</div>
		</div>
		<div class="contactBoxBottom">
			<div class="contactPicture">
				<img src="images/profilePictures/contact4.jpg" class="contactPortrait">
			</div>
			<div class="contactText">
				<h3> FirstName LastName </h3>
				<p class="texts"> manager </p>
				<p class="mail"> name@mail.com </p>
				<p class="phone"> +12 345 6789 </p>
			</div>
		</div>
	</div>
	
	</main>
</div>
	<?php

include "/var/www/E3T/components/footer.html";

?>
