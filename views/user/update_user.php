<?php

	include "../../controls/svg-icon.php";
	session_start();
	// session secure
	if (!isset($_SESSION['user'])) {
		header("location:login");
	}

	include "../../controls/connect.php";
	$id = $_SESSION['id'];
	$sql = mysqli_query($db, "SELECT * FROM users WHERE id_user = '$id'");
	$data = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profil</title>
	<meta name="viewport" content="width=device-width", initial-scale=1.0>
	<link rel="stylesheet" href="assets/css/edit.css">
	<script type="text/javascript" src="assets/js/jQ.js"></script>
</head>
<body>

	<div class="navigation">
		<div class="nav-img">
			<img src="assets/icons/logo4.png" draggable="false">
		</div>
		<div class="nav-title">Chameleon</div>
		<div></div>
		<div class="nav-logout"><?php icon('logout') ?></div>
	</div>

	<div class="container">
		<div class="edit-box">

			<form action="controls/user-crud.php" method="post" enctype="multipart/form-data">

			<input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
			<input type="hidden" name="crud" value="update">

			<div class="edit-part">
				<img src="assets/images/users/<?php echo $_SESSION['id'] ?>.png">
				<div></div>
				<label for="edit-image">UBAH</label>
				<input type="file" name="image" id="edit-image" hidden="true" >
			</div>

			<div class="edit-part">
				<div class="edit-icon">
					<?php icon("username") ?>
				</div>
				<input type="text" name="username" class="e-name" value="<?php echo $data['username'] ?>" spellcheck="false">
				<div class="edit-act" data-edit="e-name">UBAH</div>
			</div>

			<!-- <div class="edit-part">
				<div class="edit-icon">
					// <?php icon("phone") ?>
				</div>
				<input type="text" name="phone" class="e-hp">
				<div class="edit-act" data-edit="e-hp">UBAH</div>
			</div> -->

			<div class="edit-part">
				<div class="edit-icon">
					<?php icon("password") ?>
				</div>
				<input type="text" name="password" class="e-pass" value="<?php echo $data['password'] ?>" spellcheck="false">
				<div class="edit-act" data-edit="e-pass">UBAH</div>
			</div>

			<div class="edit-submit">
				<button type="submit">SUBMIT</button>
			</div>

			</form>

		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	
	$(".edit-act").on("click", function(){
		edit = $(this).attr("data-edit");
		$("."+edit).focus().select();
	});

</script>