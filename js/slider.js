$(function (){
	var curSlide = 0;
	var maxSlide = $(".banner-single").length - 1;
	var delay = 5;

	function initSlide(){
		$(".banner-single").hide();
		$(".banner-single").eq(0).show();
		var content = $(".bullets").html();

		for(i=0;i<=maxSlide ;i++){
			if(i==0)
				content += '<span class="active-bullet"></span>';	
			else
				content += '<span></span>';
		}
		$(".bullets").html(content);

	}

	function changeSlide(){
		setInterval(function(){
			$(".banner-single").eq(curSlide).stop().fadeOut(1000);
			$(".bullets span").eq(curSlide).removeClass('active-bullet');
			curSlide++;
			if(curSlide > maxSlide)
				curSlide = 0;
			$(".banner-single").eq(curSlide).stop().fadeIn(1000);
			$(".bullets span").eq(curSlide).addClass('active-bullet');
		},delay * 1000);
	}

	$('body').on('click','.bullets span',function(){
		$(".banner-single").eq(curSlide).stop().fadeOut(1000);
		var currentBullet = $(this);
		curSlide = $(this).index();
		$(".bullets span").removeClass('active-bullet');
		currentBullet.addClass('active-bullet');
		$(".banner-single").eq(curSlide).stop().fadeIn(1000);

	})

	changeSlide();	
	initSlide();
})