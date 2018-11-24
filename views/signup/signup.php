<?php 
session_start();
if(isset($_SESSION['user'])){
	header("location:user");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width", initial-scale=1.0>
	<title>Daftar</title>
	<link rel="stylesheet" href="assets/css/signup.css">
</head>
<script src="assets/js/jQ.js"></script>
<?php include '../../controls/svg-icon.php'; ?>
<body>
	<div class="container">
		<div class="signup-box">
			<div class="signup-image">
				<img src="assets/icons/logo2.png" draggable="false">
			</div>
			<div class="signup-title">sign up</div>
			<div class="signup-form-container">
				<form action="controls/user-crud.php" method="post" class="signup-form">
					<div class="signup-input">
						<div class="su-icon"><?php icon("username"); ?></div>
						<input type="text" name="username" placeholder="username" class="user" spellcheck="false" required="">
					</div>
					<div class="signup-input">
						<div class="su-icon"><?php icon("password"); ?></div>
						<input type="password" name="password" placeholder="password" class="pass" spellcheck="false" required="">
					</div>
					<div class="signup-input">
						<div class="su-icon"><?php icon("email-signup"); ?></div>
						<input type="email" name="email" placeholder="email" class="email" spellcheck="false" required="">
					</div>
					<input type="hidden" name="crud" value="register">
					<button type="submit">Daftar!</button>
				</form>
			</div>
			<!-- <div class="signup-error">Isi semua form</div> -->
		</div>
	</div>
</body>
</html>

<!-- Username cek -->
<?php 

	
 ?>


<script type="text/javascript">

	$(".signup-error").hide();
	$("button").on("click", function(){
		user = $(".user").val();
		pass = $(".pass").val();
		email = $(".email").val();
		if (user == "" || email == "" || pass == "") {
			$(".signup-error").show();
		};
	});

</script>