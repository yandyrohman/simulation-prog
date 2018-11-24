<div><div>&lt;?php</div><div><div>$a = 1;&nbsp;</div><div><br></div><div><input class='anwer-input-user answer0' data-answer='do' maxlength='2' size='2'></div><div>&nbsp;{</div><div>&nbsp; &nbsp; echo $a;</div><div>&nbsp; &nbsp; $a++;</div><div>}&nbsp;</div><div><input class='anwer-input-user answer1' data-answer='while' maxlength='5' size='5'></div><div>&nbsp;($a&lt; 6);</div></div><div>?&gt;</div></div><div><input type='hidden' class='count-input' value='2'></div><div class="answer-alert"></div>
<style type="text/css">
	.answer-alert {
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		z-index: 99;
		background: rgba(0,0,0,0.7);
		display: grid;
		align-items: center;
		justify-content: center;
		font-family: arial;
		font-size: 50px;
		color: #FFF;
		user-select: none;
	}
</style>
<script type="text/javascript">
	$(".ab-show").on("click", function(){
		check = $(".anwer-input-user").val();
		if (check == "") {
			$(".anwer-input-user").each(function(){
				answer = $(this).attr("data-answer");
				$(this).val(answer);
			});
		} else {
			$(".anwer-input-user").each(function(){
				$(this).val("");
			});
		}
	});

	$(".answer-alert").hide();
	$(".ab-run").on("click", function(){
		$(".anwer-input-user").each(function(){
			realAnswer = $(this).attr("data-answer");
			userAnswer = $(this).val();
			if (realAnswer == userAnswer) {
				$(".answer-alert").html("Jawaban Benar!").css({"color":"#4caf04"}).fadeIn();
				$(".r-view").fadeIn();
			} else {
				$(".answer-alert").html("Jawaban Salah!").css({"color":"#f44336"}).fadeIn();
			}
		})
	});
	$(".answer-alert").on("click", function(){
		$(".answer-alert").fadeOut();
	});
</script>