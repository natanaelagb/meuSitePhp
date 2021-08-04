$(function () {

	var include_path_painel = $('base').attr('base');
	var pagina = 1;
	var limite = 2;

	function gerarForm(form) {

		var url = '';

		for (var name in form) {
			url += '<input type="hidden" name="' + name + '" value="' + form[name] + '">'
		}

		return url;
	}


	if ($(window)[0].innerWidth < 1250) {
		var open = false;
	} else {
		var open = true;
	}



	$(".menu-btn").click(function () {

		var windowSize = $(window)[0].innerWidth;

		if (open) {
			$(".menu-btn").css("color", "white");
			$(".menu").animate({ "width": 0, "padding": 0 });
			$(".content").animate({ "width": "100%", "left": 0 });

			if (windowSize < 1250) {
				$(".overlay-menu").css("display", "none");
			}

			open = false;


		} else {

			$(".menu-btn").css("color", "#37474f");
			if (windowSize > 1250) {
				$(".content").animate({ "width": "80%", "left": "20%" });
				$(".menu").animate({ "width": "20%" });
			} else {
				$(".overlay-menu").css("display", "block");
				$(".menu").animate({ "width": "250px" });
				$(".menu").css("display", "block");
			}

			open = true;
		}

	})

	$(".overlay-menu").click(function () {

		$(".menu-btn").css("color", "white");
		$(".menu").animate({ "width": 0, "padding": 0 });
		$(".overlay-menu").css("display", "none");

		open = false;

	})

	$(window).resize(function () {
		var windowSize = $(window)[0].innerWidth;
		if (windowSize < 1250 && open) {

			$(".content").css("width", "100%");
			$(".content").css("left", "0");
			$(".overlay-menu").css("display", "block");
			$(".menu").css("width", "250px");
			$(".menu").css("display", "block");

		} else if (open) {

			$(".content").css("width", "80%");
			$(".content").css("left", "20%");
			$(".overlay-menu").css("display", "none");
			$(".menu").css("width", "20%");

		}

	})

	$(window).scroll(function () {
		if ($(this).scrollTop() == 0) {
			$("header").css({ "box-shadow": "none" });

		} else {
			$("header").css({ "box-shadow": "0 1px 2px 0 rgba(60,64,67,0.302), 0 2px 6px 2px rgba(60,64,67,0.149)" });

		}


	})

	$(".box-alert input").click(function () {
		$(".box-alert,.overlay-alert").css("display", "none");
	})

	$('[formato=data]').mask('99/99/9999');

	$('.quantidade-paginas').on("change", "select", function () {

		var form = {};

		form['pagina'] = $(".paginas .ativado").attr("value");

		form['limite'] = $(this).val();

		var url = gerarForm(form);

		$("#form").html(url);

		document.getElementById('form').submit();

	})


	$(".paginas").on("click", "span", function () {

		var form = {};

		form['pagina'] = $(this).attr("value");

		form['limite'] = $(".quantidade-paginas select").val();

		var url = gerarForm(form);

		$("#form").html(url);

		document.getElementById('form').submit();

	})

	$("table").on("click", "span", function () {

		//spans para ordenar

		var form = {};

		form['pagina'] = $(".paginas .ativado").attr("value");

		form['limite'] = $(".quantidade-paginas select").val();

		form['ordenar'] = $(this).attr("value");

		form['id'] = $(this).attr("id");

		var url = gerarForm(form);

		$('#form').html(url);

		document.getElementById('form').submit();

	})

	$('[actionBtn=deletar-depoimento]').click(function () {

		var resposta = confirm("Deseja excluir este depoimento?");
		if (resposta == true)
			return true;
		else
			return false;
	})
	$('[actionBtn=deletar-servico]').click(function () {

		var resposta = confirm("Deseja excluir este serviço?");
		if (resposta == true)
			return true;
		else
			return false;
	})
	$('[actionBtn=deletar-slide]').click(function () {

		var resposta = confirm("Deseja excluir este slide?");
		if (resposta == true)
			return true;
		else
			return false;
	})

	$('[actionBtn=deletar-categoria]').click(function () {

		var resposta = confirm("Deseja excluir esta categoria?");
		if (resposta == true)
			return true;
		else
			return false;
	})

})