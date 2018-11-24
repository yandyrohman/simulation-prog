<?php

	// get type of crud
	$type['post'] = $_POST['crud'];

	#================== CRUD PROCESSOR ==================

	if ($type['post'] == "getTutorId") {

		$table = $_POST['table'];
		getTutorId($table);

	} elseif ($type['post'] == "addTutor") {

		$table = $_POST['table'];
		$learn = preg_replace("/_quest/", "", $table);
		$learn = strtoupper($learn);
		$learn = "<div class=\'q-learn\'>".$learn."</div>";

		$title = "<div class=\'q-title\'>".$_POST['title']."</div>";

		$c[0] = "/\{\{c/";
		$c[1] = "/c\}\}/";
		$c[2] = "&nbsp;<span class='q-code'>";
		$c[3] = "</span>&nbsp;";

		$b[0] = "/\{\{b/";
		$b[1] = "/b\}\}/";
		$b[2] = "&nbsp;<b>";
		$b[3] = "</b>&nbsp;";

		$i[0] = "/\{\{i/";
		$i[1] = "/i\}\}/";
		$i[2] = "&nbsp;<i>";
		$i[3] = "</i>&nbsp;";

		$u[0] = "/\{\{u/";
		$u[1] = "/u\}\}/";
		$u[2] = "&nbsp;<u>";
		$u[3] = "</u>&nbsp;";

		$s[0] = "/\{\{s/";
		$s[1] = "/s\}\}/";
		$s[2] = "&nbsp;<s>";
		$s[3] = "</s>&nbsp;";

		$x[0] = "/'|\"/";
		$x[1] = "\'";

		$quest = $_POST['quest'];
		$quest = preg_replace($c[0], $c[2], $quest);
		$quest = preg_replace($c[1], $c[3], $quest);
		$quest = preg_replace($b[0], $b[2], $quest);
		$quest = preg_replace($b[1], $b[3], $quest);
		$quest = preg_replace($i[0], $i[2], $quest);
		$quest = preg_replace($i[1], $i[3], $quest);
		$quest = preg_replace($u[0], $u[2], $quest);
		$quest = preg_replace($u[1], $u[3], $quest);
		$quest = preg_replace($s[0], $s[2], $quest);
		$quest = preg_replace($s[1], $s[3], $quest);
		$quest = preg_replace($x[0], $x[1], $quest);

		$quest = $learn.$title.$quest;

		$answer = $_POST['answer'];
		
		preg_match_all("/\[\[[0-9]*\]\]/", $answer, $loopValue_a);
		$loopValue_b = $loopValue_a[0][0];
		$loopValue_c = preg_replace("/\[\[/", "", $loopValue_b);
		$loopValue_d = preg_replace("/\]\]/", "", $loopValue_c);
		
		// pembuatan input
		for ($i=0; $i < $loopValue_d; $i++) { 
			preg_match_all("/\{\{".$i."[\w\W]*".$i."\}\}/", $answer, $inputValue);
			$value = $inputValue[0][0];
			$value = preg_replace("/\{\{".$i."/", "", $value);
			$value = preg_replace("/".$i."\}\}/", "", $value);
			$valueCount = strlen($value);
			$str = "<input class='anwer-input-user answer".$i."' data-answer='".$value."' maxlength='".$valueCount."' size='".$valueCount."'>";
			$answer = preg_replace("/\{\{".$i."[\w\W]*".$i."\}\}/", $str, $answer);
		}

		$strCount = "<input type='hidden' class='count-input' value='$loopValue_d'>";
		$answer = preg_replace("/\[\[[0-9]*\]\]/", $strCount, $answer);

		$result = $_POST['result'];
		$result = preg_replace($x[0], $x[1], $result);

		$creator = $_POST['creator'];

		addTutor($table,$quest,$answer,$result,$creator);
		
	} elseif ($type['post'] == "changeTutor") {

		$table = $_POST['table'];
		$id = $_POST['id'];
		$quest = $_POST['quest'];
		$quest = preg_replace("/'/", "\'", $quest);
		$answer = $_POST['answer'];
		$answer = preg_replace("/'/", "\'", $answer);
		$false_answer = $_POST['false_answer'];
		$false_answer = preg_replace("/'/", "\'", $false_answer);
		$result = $_POST['result'];
		$result = preg_replace("/'/", "\'", $result);
		changeTutor($table,$id,$quest,$answer,$false_answer,$result);

	} elseif ($type['post'] == "deleteTutor") {

		$table = $_POST['table'];
		$id = $_POST['id'];
		deleteTutor($table,$id);

	}

	#====================================================

	// get id
	function getTutorId($table_tutor) {

		include "connect.php";
		$table = $table_tutor."_quest";
		$sql = mysqli_query($db, "SELECT * FROM $table ORDER BY id_quest DESC");
		$data = mysqli_fetch_array($sql);
		$id = $data['id_quest'];
		$id = $id + 1;
		echo nullInc("00000", $id);

	}

	// addTutor
	function addTutor($table,$quest,$answer,$result,$creator) {

		include "connect.php";

		$x = mysqli_query($db, "SELECT * FROM $table ORDER BY id_quest DESC");
		$lastId = mysqli_fetch_array($x);
		$lastId = $lastId['id_quest'];
		$newId = $lastId + 1;

		$x_0 = "/'|\"/";
		$x_1 = "\'";

		$learn = preg_replace("/_quest/", "", $table);
		$script = file_get_contents("../views/learn/starter/initJs.php");

		$answer = $answer.$script;

		$open = fopen("../views/learn/".$learn."/".$newId."-".$learn.".php", "w");
		fwrite($open, $answer);
		fclose($open);

		$answer = preg_replace($x_0, $x_1, $answer);

		$sql = mysqli_query($db, "INSERT INTO $table VALUES('$newId','$quest','$answer','$result','$creator') ");

	}

	// changeTutor
	function changeTutor($table,$id,$quest,$answer,$false_answer,$result) {

		include "connect.php";

		$one = mysqli_query($db, "UPDATE $table SET quest = '$quest' WHERE id_quest = '$id'");
		$two = mysqli_query($db, "UPDATE $table SET answer = '$answer' WHERE id_quest = '$id'");
		$three = mysqli_query($db, "UPDATE $table SET false_answer = '$false_answer' WHERE id_quest = '$id'");
		$four = mysqli_query($db, "UPDATE $table SET result = '$result' WHERE id_quest = '$id'");

	}

	// deleteTutor
	function deleteTutor($table,$id) {

		include "connect.php";
		$sql = mysqli_query($db, "DELETE FROM $table WHERE id_quest = '$id'");

	}

	// null number increment
	function nullInc($pattern,$int) {

		$nullPattern = $pattern;
		$patternLen = strlen($nullPattern);
		$strLen = strlen($int);

		$null = substr($nullPattern, 0, $patternLen - $strLen);

		return $newInt = $null.$int;

	}
	
?>
