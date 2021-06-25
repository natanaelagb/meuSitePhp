$(function(){ 
/*
	$('body').on("submit","form",function(){
		var form = $(this);
		$.ajax({
			
			url: "http://localhost/Projeto_01/ajax/painel.php",
			method:'post',
			dataType: 'json',
			data: form.serialize()

		}).done(function(data){

			if(data.retorno){
				window.location.href = 'http://localhost/Projeto_01/painel/index.php';
			}else{
				var conteudo = $('body').html();
				conteudo += '<div class="overlay-alert" style="display:block;"></div>';
				conteudo += '<div class="box-alert" style="display:block;">';
				conteudo += '<p>Usuario ou Senha incorreta!</p>';
				conteudo += '<input type="button" name="acao" value="Ok"></div>';
				console.log(conteudo)
				$('body').html(conteudo);
				$('body').on("click","div.box-alert input",function(){
					$('.box-alert,.overlay-alert').css("display","none");
				})
			}
		})
		return false;
	})
*/
	$(".box-alert input").click(function(){
		$(".box-alert,.overlay-alert").css("display","none");
	})

})