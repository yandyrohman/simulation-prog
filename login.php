<?php 
	error_reporting(0);
	session_start();
	if (isset($_SESSION['user'])){
		header("location:user");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Login</title>
	<link rel="stylesheet" href="assets/css/login.css">
</head>
<script src="assets/js/jQ.js"></script>
<?php include 'controls/svg-icon.php'; ?>
<body>
	<!-- Error Message -->

	<?php if ($_GET['msg'] == 'error') { ?>
	<div class="error-msg">Username atau password salah<div><?php icon("close") ?></div></div>
	<?php } elseif($_GET['msg'] == 'regsuccess') { ?>
	<div class="regsuccess-msg">Daftar berhasil! Silahkan masuk<div><?php icon("close") ?></div></div>
	<?php } ?>	

<div class="frame">
	<div class="login-box">
		<div class="login-img"><img src="assets/icons/logo2.png"></div>
		<div class="login-title">sign in</div>
		<form action="controls/user-crud.php" method="post">
			<div class="login-input">
				<div class="li-icon">
					<?php icon("username"); ?>
				</div>
				<input type="text" name="username" placeholder="username" spellcheck="false" required="">
			</div>

			<div class="login-input">
				<div class="li-icon">
					<?php icon("password"); ?>
				</div>
				<input type="password" name="password" placeholder="password" spellcheck="false" required="">
			</div>
			<div class="hidden">
				<input type="hidden" name="crud" value="login">
			</div>
			<div class="action">
				<div class="signup">SIGN UP</div>
				<button type="submit">LOG IN</button>
			</div>
		</form>
		
	</div>
</div>
</body>
</html>

<script>

	// for signup
	$(".signup").on("click", function(){
		window.location = "signup";
	});

	// close message
	$(".error-msg div, .regsuccess-msg div").on("click", function(){
		$(".error-msg").fadeOut();
		$(".regsuccess-msg").fadeOut();
	});

</script>