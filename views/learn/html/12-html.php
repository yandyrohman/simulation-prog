<div>&lt;html&gt;</div><div>&lt;body&gt;</div><div><br></div><div><div><br></div><div><div style="font-family: monospace;">&lt;h1&gt;Chameleon&lt;/h1&gt;<br></div><div style="font-family: monospace;">&lt;p&gt;Chameleon adalah&nbsp;<span style="font-family: arial;">&lt;<input class='anwer-input-user answer0' data-answer='em' maxlength='2' size='2'>&gt;</span>WEB<span style="font-family: arial;">&lt;/<input class='anwer-input-user answer1' data-answer='em' maxlength='2' size='2'>&gt;</span>&nbsp;belajar pemrograman online.&lt;/p&gt;</div><div style="font-family: monospace;"></div><div style="font-family: monospace;">&lt;/body&gt;</div></div></div><div><br></div><div><input type='hidden' class='count-input' value='2'></div><div>&lt;/body&gt;</div><div>&lt;/html&gt;</div><div class="answer-alert"></div>
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