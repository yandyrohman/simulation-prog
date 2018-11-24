<?php
	include "../../controls/svg-icon.php";
	$learn = $_GET['learn'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hasil</title>
	<meta name='viewport' content="width=device-width">
	<link rel="stylesheet" href="assets/css/result.css">
	<script type="text/javascript" src="assets/js/jQ.js"></script>
</head>
<body>
	<div class="container">
		<div class="result-box">
			<div class="grade"></div>
			<div align="center"><a href="user"><?php icon("home") ?></a></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$.ajax({
		url: "controls/user-crud.php",
		method: "post",
		data: {
			crud: "processResult",
			learn: "<?php echo $learn ?>"
		},
		success: function(result){
			$(".grade").html("Nilai Kamu : " + result);
		}
	});
</script>