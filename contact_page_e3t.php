<!DOCTYPE html>
<html lang="en">
	<head> 
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
		<title> E3T Contact us </title>
	</head>
	<body> 
		<div id="container">
			<header>
				<h1> header </h1>
			</header>
			<main>
			<div id="form">
				<h2> contact us </h2>
				<form method="GET" action="contact_page_e3t.php">
					<p class="labels"> <label for="name"> Name </label> </p>
					<p class="texts"> <input type="text" name="name"> </p>
					<p class="labels"> <label for="email"> Email </label> </p>
					<p class="texts"> <input type="email" name="email"> </p>
					<p class="labels"> <label for="comment"> Comment </label> </p>
					<p class="texts"> <textarea name="comment"> </textarea> </p>
					<p id="submit"> <input type="submit" value="send"> </p>
				</form>
			</div>
			<div id="contactinfo">
				<div class="contactbox">
					<img src="pictures/contact1.jpg" height="130px" width="100px">
					<h3> FirstName LastName </h3>
					<p class="texts"> manager </p>
					<p> name@mail.com </p>
					<p> +12 345 6789 </p>
				</div>
				<div class="contactbox">
					<img src="pictures/contact2.jpg" height="130px" width="100px">
					<h3> FirstName LastName </h3>
					<p class="texts"> manager </p>
					<p> name@mail.com </p>
					<p> +12 345 6789 </p>
				</div>
				<div class="contactbox">
					<img src="pictures/contact3.jpg" height="130px" width="100px">
					<h3> FirstName LastName </h3>
					<p class="texts"> manager </p>
					<p> name@mail.com </p>
					<p> +12 345 6789 </p>
				</div>
			</div>
			</main>
			<footer>
				<h1> footer </h1>
			</footer>
		</div>
	</body>
</html>