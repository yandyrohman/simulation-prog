<div><input class='anwer-input-user answer0' data-answer='INSERT INTO' maxlength='11' size='11'> Customers <input class='anwer-input-user answer1' data-answer='(' maxlength='1' size='1'></div><div>CustomerName,&nbsp;</div><div>Address,&nbsp;</div><div>City,&nbsp;</div><div>Country <input class='anwer-input-user answer2' data-answer=')' maxlength='1' size='1'></div><div>VALUES <input class='anwer-input-user answer3' data-answer='(' maxlength='1' size='1'></div><div>'Ahmad',</div><div>'Jl. Asia Afrika',</div><div>'Bandung',</div><div>'Indonesia' <input class='anwer-input-user answer4' data-answer=')' maxlength='1' size='1'>;</div><div><br></div><div><input type='hidden' class='count-input' value='5'></div><div class="answer-alert"></div>
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