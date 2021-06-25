$(function(){
	var map;
	
	function initialize() {

	  var mapProp = {
	    center: new google.maps.LatLng(-16.740370,-43.831310),
	    zoom:14,
	   	scrollwheel: false,
	     styles: [{
	    stylers: [{
	      saturation: -100
	    }]
	     }],
	    mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  
	  map=new google.maps.Map(document.getElementById("map"),mapProp);
	}

	function addMarker(lat,long,icon,content,showInfoWindow,openInfoWindow){
		  var myLatLng = {lat:lat,lng:long};

		  if(icon === ''){
			   var marker = new google.maps.Marker({
			    position: myLatLng,
			    map: map,
			    icon:icon
			  });
		  }else{
			  var marker = new google.maps.Marker({
			    position: myLatLng,
			    map: map,
			    icon:icon
			  });
		}

		  var infoWindow = new google.maps.InfoWindow({
	                content: content,
	                maxWidth:200
	        });

		  google.maps.event.addListener(infoWindow, 'domready', function() {

		   // Reference to the DIV which receives the contents of the infowindow using jQuery
		   var iwOuter = $('.gm-style-iw');

		   /* The DIV we want to change is above the .gm-style-iw DIV.
		    * So, we use jQuery and create a iwBackground variable,
		    * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
		    */
		   var iwBackground = iwOuter.prev();

		   // Remove the background shadow DIV
		   iwBackground.children(':nth-child(2)').css({'background' : 'rgb(255,255,255)'}).css({'border-radius':'0px'});

		   // Remove the white background DIV
		   iwBackground.children(':nth-child(4)').css({'background' : 'rgb(255,255,255)'}).css({'border-radius':'0px'});

		   // Moves the shadow of the arrow 76px to the left margin 
			iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'display:none;'});

			// Moves the arrow 76px to the left margin 
			iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'display:none;'});

		});
		  	if(showInfoWindow == undefined){
		        google.maps.event.addListener(marker, 'click', function () {
		              infoWindow.open(map, marker);
		         });
	    	}else if(openInfoWindow == true){
	    		infoWindow.open(map, marker);
	    	}
	}




	$('nav.mobile').click(function(){
		var listaMenu = $('nav.mobile ul');

		if(listaMenu.is(":hidden") == true){
			var icone = $("div.botao-menu-mobile i");
			icone.removeClass("fas fa-bars");
			icone.addClass("fas fa-times");
			listaMenu.slideToggle();
		}
		else{
			var icone = $("div.botao-menu-mobile i");
			icone.removeClass("fas fa-times");
			icone.addClass("fas fa-bars");
			listaMenu.slideToggle();
		}
	})

	if($('target').length > 0){
		var elemento = '#'+$('target').attr('target');
		var divScroll = $(elemento).offset().top;

		$('html,body').animate({'scrollTop': divScroll},600);

	}


	function dinamicLoad(){
		$('[realtime]').click(function(){
			
			var pagina = $(this).attr('realtime');
			$('.container-meio').hide();
			$('.container-meio').load(include_path+'pages/'+pagina+'.php');
			setTimeout(function(){
				initialize();
				addMarker(-16.740370,-43.831310,"","Minha Casa", undefined, true);
			},1000);
			$('.container-meio').fadeIn(1000);
			window.history.pushState("","",pagina);
			return false;
		});
	}
	dinamicLoad();


	function gerarUrl(valores) {

		var url = window.location.href;
		var dados = "";
		var primeiro = true;


		if(url.search("parametro")>=0){
			dados = url.split("?")[1];
			dados = dados.split("&")[0]+"&";
		}	

		url = url.split("?")[0]+"?"+dados;

		for(var name in valores){
			if(primeiro == true){
				url += name+'='+valores[name];
				primeiro = false;
			}
			else
				url += '&'+name+'='+valores[name];		
		}
		
		return url;
	}

	$(".pagina-indice").on("click","span",function(){

		var valores = {};

		valores['pagina'] = $(this).attr("value");

		valores['limite'] = $(".quantidade-paginas select").val();
	
		var url = gerarUrl(valores);

		//console.log(url);

		window.location.href = url;

	})

	$('.quantidade-paginas').on("change","select",function(){
		
		var valores = {};

		valores['pagina'] = 1;//$(".pagina-indice .ativado").attr("value");

		valores['limite'] = $(this).val();

		var url = gerarUrl(valores);

		//console.log(url);
		
		window.location.href = url; 
	
	})



	
})