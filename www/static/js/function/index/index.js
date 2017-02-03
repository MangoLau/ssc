define(function(require, exports, module) {
	require("resPath/highchart/highcharts");
	require("resPath/validation/jquery.validate.min");
	require.async("resPath/validation/jquery.methods.min",function(){
		require("resPath/validation/additional-methods");
	});
	require("resPath/jquery.cookie/jquery.cookie");
	var global = require("global");
	global.toggleClass("active",global.naviBar,"naviIndex");
	exports.loadPopNotice = function(){
		var viewOver = $.cookie('popView');
		if(!viewOver){
			$.ajax({
				url:'/news/loadPopNotice',
				type:'POST',
				dataType:'JSON',
				async:false,
				success:function(d){
					var popNotice = d.loadPopNotice;
					if(popNotice.length > 0){
						var notice = popNotice[0];
						var $popNotice = $("#popNotice");
						var summary = notice.summary;
						if(summary.length > 50){
							$popNotice.find(".summary").html(summary.substring(0,50)+"....");
						}else{
							$popNotice.find(".summary").html(summary);
						}
						$popNotice.find("a").attr("data-attr",notice.id);
						$popNotice.show();
					}
				}
			});
		}
	};
	
	$(function() {
		leftNaviage();// 左侧导航栏
		indexLogValidate();
		global.wsCaipiaoNumber(false,true);
		global.loadNubmerPattern();
		global.loadPatternStatistic();
		if($("#userLogin").val() == ""){
			//加载验证码
			global.initGeetest();
		}
		
		var iniTodayNumberBuffer = new StringBuilder();
		var num = 0;
		for(var i = 1;i < 31;i++){
			num = i;
			num =  global.formatItem(num);
			iniTodayNumberBuffer.append('<tr>');
			iniTodayNumberBuffer.append('<td  class="text-right">'+num+'</td>');
			iniTodayNumberBuffer.append('<td id=todayNumber'+num+'></td>');
			iniTodayNumberBuffer.append('<td id=todayPattern'+num+'  class="border-right text-left"></td>');
			num =  30 + i;
			num = global.formatItem(num);
			iniTodayNumberBuffer.append('<td class="text-right">'+num+'</td>');
			iniTodayNumberBuffer.append('<td id=todayNumber'+num+'></td>');
			iniTodayNumberBuffer.append('<td id=todayPattern'+num+'  class="border-right text-left"></td>');
			num = 60 + i;
			num = global.formatItem(num);
			iniTodayNumberBuffer.append('<td class="text-right">'+num+'</td>');
			iniTodayNumberBuffer.append('<td id=todayNumber'+num+'></td>');
			iniTodayNumberBuffer.append('<td id=todayPattern'+num+'  class="border-right text-left"></td>');
			num = 90 + i;
			num = global.formatItem(num);
			iniTodayNumberBuffer.append('<td class="text-right">'+num+'</td>');
			iniTodayNumberBuffer.append('<td id=todayNumber'+num+'></td>');
			iniTodayNumberBuffer.append('<td id=todayPattern'+num+'  class="border-right text-left"></td>');
			iniTodayNumberBuffer.append('</tr>');
		}
		$("#todayNumberContent").html(iniTodayNumberBuffer.toString());
		
		global.loadTodayNumber();
		
		$("#index-btn").click(function(){
			//拼图验证码加载失败了
			if(global.captchaObj == null){
				indexLogin();
			}else {
				var checkCode = global.captchaObj.getValidate();
				userLogin(checkCode);
			}
		});
		enterKeypress();
		var moseNumber=$(".homePageMiddle1b2aa ul li");
		moseNumber.mouseover(function(){
			var index=$(this).index();
			var bgPosition=-(400+(index*97));
			$(this).css("background-position-x",bgPosition+"px");
		});
		moseNumber.mouseout(function(){
			var index=$(this).index();
			var bgPosition=-(index*97);
			$(this).css("background-position-x",bgPosition+"px");
		});
		
		$('.carousel').carousel({
			interval: 3000
		});
		exports.loadPopNotice();
		$("#popNotice a").click(function(){
			var dataUrl = $.trim($(this).attr("data-attr"));
			$.cookie('popView',"true");
			$("#popNotice").hide();
			window.open ( "/news/noticeDetail/"+dataUrl , "_blank"); 
		});
		$("#popNotice .xo").click(function(){
			$("#popNotice").hide();
		});
	});
	
	function enterKeypress(){
		var $inp = $("#index-login input");
		$inp.keypress(function(e) {
			var key = e.which;
			if (key == 13) {
				//拼图验证码加载失败了
				if(global.captchaObj == null){
					indexLogin();
				}else {
					var checkCode = global.captchaObj.getValidate();
					userLogin(checkCode);
				}
			}
		});
	};
	
	function leftNaviage() {
		var native1 = $(".homePageMiddle1a ul li a");
		native1.mouseover(function(){
			var nowIndex=$(this);
			if(!nowIndex.is('.active')){
				$(this).siblings().removeClass("hoverStyle");
				$(this).addClass("hoverStyle");
			}
		});
		native1.mouseout(function(){
			$(this).removeClass("hoverStyle");
		});
	};
	function indexLogValidate() {
		$("#index-login").validate({
			rules:{
				loginName:{
					required:true,
					//emailaddress:true
					accountName:true
				},
				password:{
					required:true,
					minlength:6
				},
				checkCode:{
					required:true,
					minlength:4
				}
			},
			messages:{
				loginName:{
					required:"用户名不能为空"
				},
				password:{
					required:"密码不能为空",
					minlength:'密码不能少于6位'
				},
				checkCode:{
					required:"验证码不能为空",
					minlength:'请输入4位验证码',
				}
			},
			errorPlacement: function(error, element) {
				error.addClass("error-lable").css({"font-size":"12px","margin":"0px","font-weight": "normal"});
				element.css("border","1px solid #c8220b").parent().parent("div").css("margin","0px");
				element.parent().parent("div").after(error);
			},
			success: function(label) {
				label.prev().css("margin-bottom","8px").find("input").css("border","1px solid #d2d2d2");
				label.parents("form").find(".no-content").html("");
				label.remove();
			}
		});
	};
	var indexLogin = function(){
		var $indexLogin=$("#index-login");
		if($indexLogin.valid()){
			$.ajax({
				url:"/userAccount/popLogin",
				async:false,
				type:"POST",
				data:{
					"loginName":$.trim($indexLogin.find("input[name='loginName']").val()),
					"password":$.trim($indexLogin.find("input[name='password']").val()),
					"checkCode":$.trim($indexLogin.find("input[name='checkCode']").val())
				},
				dataType:"JSON",
				beforeSend: function(XMLHttpRequest){
					$("#index-btn").unbind();
				},
				success:function(d){
					if(d.success){
					    window.location.reload();
					}else{
						$indexLogin.find("img").trigger("click");
						$indexLogin.find("input[name='checkCode']").val("");
						alert(d.msg);
						return false;
					}
				},
				 complete: function(XMLHttpRequest, textStatus){
					 $("#index-btn").click(function(){
						 indexLogin();
					 });
				 },
				error:function(xhr){
					alert("登录失败，请重试");
				}
			});
		}
	};
	
	var userLogin = function(checkCode){
		var $indexLogin=$("#index-login");
		if($indexLogin.valid()){
			if(!checkCode){
				$("#singleButtonDiaText").html("请先拖动验证码到相应位置");
				$("#singleButtonDia").modal("show");
				return;
			}
			$.ajax({
				url:"/userAccount/userlogin",
				async:false,
				type:"POST",
				data:{
					"loginName":$.trim($indexLogin.find("input[name='loginName']").val()),
					"password":$.trim($indexLogin.find("input[name='password']").val()),
					"geetest_challenge": checkCode.geetest_challenge,
                    "geetest_validate": checkCode.geetest_validate,
                    "geetest_seccode": checkCode.geetest_seccode
				},
				dataType:"JSON",
				beforeSend: function(XMLHttpRequest){
					$("#index-btn").unbind();
				},
				success:function(d){
					if(d.success){
					    window.location.reload();
					}else{
						$indexLogin.find("img").trigger("click");
						$indexLogin.find("input[name='checkCode']").val("");
						alert(d.msg);
						global.initGeetest();
					}
				},
				 complete: function(XMLHttpRequest, textStatus){
					 $("#index-btn").click(function(){
						//拼图验证码加载失败了
						if(global.captchaObj == null){
							indexLogin();
						}else {
							var checkCode = global.captchaObj.getValidate();
							userLogin(checkCode);
						}
					 });
				 },
				error:function(xhr){
					alert("登录失败，请重试");
				}
			});
		}
	};
});