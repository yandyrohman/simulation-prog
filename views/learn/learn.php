<?php

	// secure session
	session_start();
	if (!isset($_SESSION['user'])) {
		header("location:login");
	}else {
		if (isset($_SESSION['admin'])) {
			header("location:admin");
		}
	}
	
	$learn = $_GET['learn'];
	$table = $learn."_quest";
	$id = $_GET['id'];

	include "../../controls/connect.php";
	$sql = mysqli_query($db, "SELECT * FROM $table WHERE id_quest = '$id'");
	$data = mysqli_fetch_array($sql);

	include "../../controls/svg-icon.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name='viewport' content="width=device-width">
	<title>Belajar</title>
	<link rel="stylesheet" href="assets/css/learn.css">
</head>
<script type="text/javascript" src="assets/js/jQ.js"></script>
<body>
	<div class="container">

		<div class="quest">
			<?php echo $data['quest'] ?>
		</div>

		<div class="answer">
			<div class="a-input"></div>
			<div class="a-buttons">
				<div class="ab-run"><?php icon("send") ?></div>
				<div class="ab-show"><?php icon("show") ?></div>
				<div></div>
				<div class="ab-back"><?php icon("back") ?></div>
				<div class="ab-home"><?php icon("home") ?></div>
				<div class="ab-next"><?php icon("next") ?></div>
			</div>
		</div>

		<div class="quest-show"></div>

		<div class="quest-hide"></div>

		<div class="result">
			<div class="r-head">HASIL</div>

			<div class="r-view"><?php echo $data['result'] ?></div>
		</div>

		<!-- <div class="result-cmd">
			<div class="rc-head">
				<div class="rch-title">Command Line</div>
				<div class="rch-close"></div>
				<div class="rch-minmax"></div>
				<div class="rch-hide"></div>
			</div>
			<div class="rc-view">Jadi gini gan</div>
		</div> -->

	</div>
</body>
</html>

<div class="view-grade">
	<a href="#">Lihat Nilai</a>
</div>

<style type="text/css">
	.view-grade {
		position: fixed;
		z-index: 555;
		width: 100%;
		height: 100%;
		background: rgba(255,255,255,0.7);
		display: grid;
		justify-content: center;
		align-items: center;
		font-family: arial;
		font-size: 20px;
	}

		.view-grade a {
			color: #FFF;
			text-decoration: none;
			padding: 10px;
			border-radius: 10px;
			background: #4CAF04;
		}
</style>

<script type="text/javascript">

	$.ajax({
		url: "views/learn/<?php echo $learn ?>/<?php echo $id ?>-<?php echo $learn ?>.php",
		method: "post",
		success: function(answerValue){
			$(".a-input").html(answerValue);
		}
	})

	// hide result
	$(".r-view").hide();

	// hide grade
	$(".view-grade").hide();

	// quest show (for mobile)
	$(".quest-show").on("click", function(){
		$(".quest-hide").show();
		$(".quest").show();
	});

	// quest hide (for mobile)
	$(".quest-hide").on("click", function(){
		$(".quest-hide").hide();
		$(".quest").hide();
	});

	status = "yes";

	// show (aborted increment grade)
	$(".ab-show").on("click", function(){
		status = "no";
	});

	// run
	$(".ab-run").on("click", function(){
		tutor = "<?php echo $id ?>";
		$.ajax({
			url: "controls/user-crud.php",
			method: "post",
			data: {
				crud: "process",
				learn: "<?php echo $learn ?>",
				id: "<?php echo $id ?>",
				status: status
			},
			success: function(){
				if (tutor == 20) {

					$(".view-grade").show();

				}
			}
		});
	});

	// to grade
	$(".view-grade").on("click", function(){
		window.location = "result?learn=<?php echo $learn ?>";
	});

	// back 
	$(".ab-back").on("click", function(){
		tutor = "<?php echo $id - 1 ?>";
		if (tutor <= 0) {
			window.location = "learn?learn=<?php echo $learn ?>&id=1";
		} else {
			window.location = "learn?learn=<?php echo $learn ?>&id=<?php echo $id - 1 ?>";
		}
	});

	// next
	$(".ab-next").on("click", function(){
		tutor = "<?php echo $id + 1 ?>";
		if (tutor > 20) {
			window.location = "learn?learn=<?php echo $learn ?>&id=20";
		} else {
			window.location = "learn?learn=<?php echo $learn ?>&id=<?php echo $id + 1 ?>";
		}
	});

	// home
	$(".ab-home").on("click", function() {
		window.location = "user";
	});

</script>