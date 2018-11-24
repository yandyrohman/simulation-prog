<?php
	// secure session
	session_start();
	if (!isset($_SESSION['user'])) {
		header("location:login");
	} else {
		if (!isset($_SESSION['admin'])) {
			header("location:user");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
</head>
<script type="text/javascript" src="assets/js/jQ.js"></script>

<body>

	<div class="navigation">
		<div class="nav-img"><img src="assets/images/users/USER-00001.png" alt=""></div>
		<div class="nav-menu nav-add">Add Tutorial</div>
		<div class="nav-submenu" data-learn="html">HTML</div>
		<div class="nav-submenu" data-learn="css">CSS</div>
		<div class="nav-submenu" data-learn="php">PHP</div>
		<div class="nav-submenu" data-learn="sql">SQL</div>
		<div class="nav-submenu" data-learn="js">JS</div>
		<!-- <div class="nav-menu nav-list-tutorial">List Tutorial</div> -->
		<!-- <div class="nav-menu nav-list-user">List User</div> -->
		<div class="nav-menu nav-logout">Logout</div>
	</div>
	
	<div class="container">
		<div class="container-title"></div>
		<div class="container-view">

			<div class="container-add-tutor">
				<input type="" name="" class="cv-learn" placeholder="Kategori" spellcheck="false"><br>
				<input type="" name="" class="cv-title" placeholder="Judul Tutorial" spellcheck="false">
				<div class="cv-quest" placeholder="Quest" spellcheck="false" contenteditable="true"></div>
				<div class="cv-answer" placeholder="Jawaban" spellcheck="false" contenteditable=""></div>
				<textarea class="cv-result" placeholder="Result jawaban" spellcheck="false"></textarea>
				<input type="hidden" class="cv-type" value="add">
				<input type="hidden" class="cv-id">
			</div>

			<div class="container-text-function">
				<div class="ctf-regular">
					<img src="assets/icons/regular.png">
				</div>
				<div class="ctf-warn">
					<img src="assets/icons/warn.png">
				</div>
				<div></div>
				<div class="ctf-submit">POST</div>
			</div>

			<div></div>

			<div class="container-list-tutor">
				<!-- pending -->
			</div>

			<div class="container-list-user">
				<table border="1">
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Password</th>
						<th>Email</th>
						<th>HTML</th>
						<th>CSS</th>
						<th>PHP</th>
						<th>SQL</th>
						<th>JS</th>
						<!-- <th colspan="2">Action</th> -->
					</tr>
					<?php
						include "../../controls/connect.php";
						$a = mysqli_query($db, "SELECT * FROM users");
						$c = mysqli_query($db, "SELECT * FROM quest_passed");
						while ($b = mysqli_fetch_array($a)) {
							$d = mysqli_fetch_array($c);
					?>
					<tr>
						<td><?php echo $b['id_user'] ?></td>
						<td><?php echo $b['username'] ?></td>
						<td><?php echo $b['password'] ?></td>
						<td><?php echo $b['email'] ?></td>
						<td><?php echo $d['html'] ?></td>
						<td><?php echo $d['css'] ?></td>
						<td><?php echo $d['php'] ?></td>
						<td><?php echo $d['sql'] ?></td>
						<td><?php echo $d['js'] ?></td>
						<!-- <td>Change</td>
						<td>Delete</td> -->
					</tr>
					<?php } ?>
				</table>
			</div>

		</div>
	</div>

</body>
</html>

<div class="send-msg">Menambah tutorial sukses!</div>

<script type="text/javascript">
	
	$(".container-add-tutor").hide();
	$(".container-list-tutor").hide();
	$(".container-list-user").hide();
	$(".container-text-function").hide();
	$(".nav-submenu").hide(); // always hide
	$(".send-msg").hide();

	// add tutorial animation
	$(".nav-add").on("click", function(){
		display = $(".nav-submenu").css("display");
		if (display == "none") {	
			$(".nav-submenu").slideDown();
			
		} else {
			$(".nav-submenu").slideUp();
		}
	});

	// add tutorial
	$(".nav-submenu").on("click", function(){
		category = $(this).attr("data-learn");
		$(".container-add-tutor").show();
		$(".container-list-tutor").hide();
		$(".container-list-user").hide();
		$(".container-text-function").fadeIn();
		$(".container-title").html("Add Tutorial");
		$(".cv-learn").val(category);
	});

	// add tutorial
	$(".ctf-submit").on("click", function(){
		table = $(".cv-learn").val();
		table = table + "_quest";
		id = $(".cv-id").val();
		title = $(".cv-title").val();
		quest = $(".cv-quest").html();
		answer = $(".cv-answer").html();
		result = $(".cv-result").val();
		creator = "yandy6man";

		$.ajax({
			url: "controls/admin-crud.php",
			method: "post",
			data: {
				table: table,
				title: title,
				quest: quest,
				answer: answer,
				result: result,
				creator: creator,
				crud: "addTutor"
			},
			success: function(){
				$(".send-msg").fadeIn();
			}
		});
	});

	// list tutorial
	$(".nav-list-tutorial").on("click", function(){
		$(".container-add-tutor").hide();
		$(".container-list-tutor").show();
		$(".container-list-user").hide();
		$(".container-text-function").hide();
		$(".container-title").html("List Tutorial");
	});

	// view list tutorial
	$(".clt-html").show();
	$(".clt-css").hide();
	$(".clt-php").hide();
	$(".clt-sql").hide();
	$(".clt-js").hide();
	$(".cltb").on("click", function(){
		view = $(this).attr("data-list");
		$(".container-list-tutor table").hide();
		$(".clt-"+view).show();
	});

	// delete tutorial
	$(".clt-delete").on("click", function(){

		value = $(this).attr("data-delete");
		value = value.split(",");
		learn = value[0];
		id = value[1];
		console.log(learn);
		learn = learn + "_quest";
		$.ajax({
			url: "controls/admin-crud.php",
			method: "post",
			data: {
				id: id,
				table: learn,
				crud: "deleteTutor"
			},
			success: function(){
				// 
			}
		})
	});

	// list user
	$(".nav-list-user").on("click", function(){
		$(".container-add-tutor").hide();
		$(".container-list-tutor").hide();
		$(".container-list-user").show();
		$(".container-text-function").hide();
		$(".container-title").html("List User");
	});

	// logout
	$(".nav-logout").on("click", function(){
		window.location = "controls/user-crud.php?crud=logout";
	});

	// text function
	$(".ctf-regular").on("click", function(){
		value = "<div class='q-regular'>&nbsp;</div>";
		$(".cv-quest").append(value);
	});

	$(".ctf-warn").on("click", function(){
		value = "<div class='q-warn'>&nbsp;</div>";
		$(".cv-quest").append(value);
	});

	// close send message
	$(".send-msg").on("click", function(){
		$(".send-msg").fadeOut();
	});

</script>
