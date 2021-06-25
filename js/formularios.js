$(function(){
	

	$('body').on("submit",".ajax-form",function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.overlay-loader').fadeIn();
			},
			url: include_path+'ajax/formularios.php',
			method:'post',
			dataType:'json',
			data: form.serialize()

		}).done(function(data){

			if(data.retorno){
				$('.overlay-loader').fadeOut();
				$('.sucesso').fadeIn();
				console.log('E-mail enviado com sucesso!');
				setTimeout(function(){
					$('.sucesso').fadeOut();
				},2500);
			}else{
				console.log('Ocorreu um erro ao enviar o e-mail!');
				$('.overlay-loader').fadeOut();
				$('.erro').fadeIn();
				setTimeout(function(){
					$('.erro').fadeOut();
				},2500);

			}

		})
		return false;
	})
	

})