<div>&lt;html&gt;</div><div>&lt;body&gt;</div><div><input class='anwer-input-user answer0' data-answer='&lt;h1&gt;Hai&lt;/h1&gt;' maxlength='12' size='12'></div><div><br></div><div><input class='anwer-input-user answer1' data-answer='&lt;h2&gt;Hai&lt;/h2&gt;' maxlength='12' size='12'><br></div><div><br></div><div><input class='anwer-input-user answer2' data-answer='&lt;h3&gt;Hai&lt;/h3&gt;' maxlength='12' size='12'><br></div><div><br></div><div><input class='anwer-input-user answer3' data-answer='&lt;h4&gt;Hai&lt;/h4&gt;' maxlength='12' size='12'><br></div><div><br></div><div><input class='anwer-input-user answer4' data-answer='&lt;h5&gt;Hai&lt;/h5&gt;' maxlength='12' size='12'><br></div><div><br></div><div><input class='anwer-input-user answer5' data-answer='&lt;h6&gt;Hai&lt;/h6&gt;' maxlength='12' size='12'><br></div><div><input type='hidden' class='count-input' value='6'></div><div>&lt;/body&gt;</div><div>&lt;/html&gt;</div><div class="answer-alert"></div>
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