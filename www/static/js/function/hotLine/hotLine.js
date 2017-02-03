define(function(require,exports,module){
	$(function(){
		$('.slide_min').on("click",function(){
			$("#floatDivBoxs").animate({right: '0'},300);
			$(this).hide();
		});
		$(".floatDtt").click(function(){
			$("#floatDivBoxs").animate({right: '-175px'},300);
			$(".slide_min").show();
		});
	});
});