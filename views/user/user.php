<?php

	// secure session
	// error_reporting(0);
	session_start();
	if (!isset($_SESSION['user'])) {
		header("location:login");
	}else{
		if(isset($_SESSION['admin'])){
			header("location:admin");
		}
	}

	// get database data 
	include "../../controls/connect.php";
	include "../../controls/user-crud.php";
	$sql = mysqli_query($db, "SELECT * FROM users WHERE id_user = '".$_SESSION['id']."'");
	$data = mysqli_fetch_array($sql);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width", initial-scale=1.0>
	<title>Selamat Datang</title>
	<link rel="stylesheet" href="assets/css/user.css">
</head>
<script type="text/javascript" src="assets/js/jQ.js"></script>
<?php include '../../controls/svg-icon.php'; ?>
<body>

	<div class="navigation">
		<div class="nav-img">
			<img src="assets/icons/logo4.png" draggable="false">
		</div>
		<div class="nav-title">Chameleon</div>
		<div></div>
		<div class="nav-logout"><?php icon('logout') ?></div>
	</div>

	<div class="user-profile">
		<div class="up-img">
			<img src="assets/images/users/<?php echo $_SESSION['id'] ?>.png">
			<div class="upi-change"><?php icon("change") ?></div>
		</div>
	</div>

	<div class="tutorial-box">
		<div class="tb-title">Silahkan pilih tutorial</div>
		<div class="tb-container">
			<div class="tb-card" data-learn="html">
				<div class="tbc-logo l-html">
					<img src="assets/icons/tutorials/html.png">
				</div>
				<div class="tbc-data">
					<div class="tbcd-title t-html">HTML</div>
				</div>
			</div>
			<div class="tb-card" data-learn="css">
				<div class="tbc-logo l-css">
					<img src="assets/icons/tutorials/css.png">
				</div>
				<div class="tbc-data">
					<div class="tbcd-title t-css">CSS</div>
				</div>
			</div>
			<div class="tb-card" data-learn="php">
				<div class="tbc-logo l-php">
					<img src="assets/icons/tutorials/php.png">
				</div>
				<div class="tbc-data">
					<div class="tbcd-title t-php">PHP</div>
				</div>
			</div>
			<div class="tb-card" data-learn="sql">
				<div class="tbc-logo l-sql">
					<img src="assets/icons/tutorials/mysql.png">
				</div>
				<div class="tbc-data">
					<div class="tbcd-title t-sql">MySQL</div>
				</div>
			</div>
			<div class="tb-card" data-learn="js">
				<div class="tbc-logo l-js">
					<img src="assets/icons/tutorials/js.png">
				</div>
				<div class="tbc-data">
					<div class="tbcd-title t-js">JavaScript</div>
				</div>
			</div>
		</div>
	</div>
	<?php if($_SESSION['popup'] == "yes") { ?>
	<div class="greet">
		<div class="greet-text">Selamat Datang <?php echo $_SESSION['user'] ?> !</div>
		<div class="greet-promotion">Kami menyarankan anda mencoba tutorial HTML terlebih dahulu</div>
		<div class="greet-html">HTML</div>
		<div class="greet-nothanks">Nggak Makasih</div>
	</div>
	<?php } ?>

	<div class="footer">Design By Chameleon Team</div>
</body>
</html>

<script type="text/javascript">

	$(".tb-card").on("click", function(){
		learn = $(this).attr("data-learn");
		window.location = "learn?learn="+learn+"&id=1";
	});
	$(".nav-logout").on("click", function(){
		window.location = "controls/user-crud.php?crud=logout";
	});

	// change image animation
	$(".upi-change").hide();
	$(".up-img").on("mouseover", function(){
		$(".up-img img").hide();
		$(".upi-change").show();
	}).on("mouseout", function(){
		$(".up-img img").show();
		$(".upi-change").hide();
	});

	// redirect user to edit profile
	$(".upi-change").on("click", function(){
		window.location = "update_user";
	});

	$(".greet-nothanks").on("click", function(){
		$(".greet").fadeOut();
		$.ajax({
			url: "controls/user-crud.php",
			method: "post",
			data: {
				crud: "closePopup"
			}
		})
	});

	$(".greet-html").on("click", function(){
		window.location = "learn?learn=html&id=1";
	});

</script>
