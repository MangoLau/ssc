define(function(require,exports,module){
	require("resPath/validation/jquery.validate.min");
	var global = require("global");
	require.async("resPath/validation/jquery.methods.min",function(){
		require("resPath/validation/additional-methods");
	});
	function enterKeypress(){
		var $inp = $("#login-form input");
		$inp.keypress(function(e) {
			var key = e.which;
			if (key == 13) {
				//拼图验证码加载失败了
				if(global.captchaObj == null){
					popLogin();
				}else {
					var checkCode = global.captchaObj.getValidate();
					exports.userLoginDialog(checkCode);
				}
			}
		});
	}
	function loginValidate() {
		$("#login-form").validate({
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
					required:"用户名不能为空",
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
				error.addClass("error-lable");
				element.css("border","1px solid #c8220b").parent().css("margin-bottom","0px");
				element.parent().after(error);
			},
			success: function(label) {
				label.prev().css("margin-bottom","15px").find("input").css("border","1px solid #d2d2d2");
				label.parents("form").find(".no-content").html("");
				label.remove();
			}
		});
	}
	//弹出登录
	var popLogin = function(){
		var $loginForm=$("#login-form");
		if($loginForm.valid()){
			$.ajax({
				url:"/userAccount/popLogin",
				async:false,
				type:"POST",
				data:{
					"loginName":$.trim($loginForm.find("input[name='loginName']").val()),
					"password":$.trim($loginForm.find("input[name='password']").val()),
					"checkCode":$.trim($loginForm.find("input[name='checkCode']").val()),
					"check":$.trim($loginForm.find("input[name='check']").val())
				},
				dataType:"JSON",
				beforeSend: function(XMLHttpRequest){
					$("#loginNow").unbind();
				},
				success:function(d){
					if(d.success){
					    window.location.reload();
					}else{
						$loginForm.find("img").trigger("click");
						$loginForm.find("input[name='checkCode']").val("");
						$(".no-content").html(d.msg);
						return false;
					}
				},
				 complete: function(XMLHttpRequest, textStatus){
					 $("#loginNow").click(function(){
						 popLogin();
					 });
				 },
				error:function(xhr){
					$(".no-content").html("登录失败，请重试");
				}
			});
		}
	};
	//登录
	exports.loginSub = function(){
		var $masterLogin=$("#master-login");
		if($masterLogin.valid()){
			$.ajax({
				url:"/userAccount/popLogin",
				async:false,
				type:"POST",
				data:{
					"loginName":$.trim($masterLogin.find("input[name='loginName']").val()),
					"password":$.trim($masterLogin.find("input[name='password']").val()),
					"checkCode":$.trim($masterLogin.find("input[name='checkCode']").val()),
					"check":$.trim($masterLogin.find("input[name='check']").val())
				},
				dataType:"JSON",
				beforeSend: function(XMLHttpRequest){
					$("#master-login-sub").unbind();
				},
				success:function(d){
					if(d.success){
					    window.location.reload();
					}else{
						$("#change-one").trigger("click");
						$("#master_checkCode").val("");
						alert(d.msg);
						return false;
					}
				},
				 complete: function(XMLHttpRequest, textStatus){
					 exports.login();
				 },
				error:function(xhr){
					alert("登录失败，请重试!");
				}
			});
		}
	};
	
	
	exports.userLogin = function(checkCode){
		var $masterLogin=$("#master-login");
		if($masterLogin.valid()){
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
					"loginName":$.trim($masterLogin.find("input[name='loginName']").val()),
					"password":$.trim($masterLogin.find("input[name='password']").val()),
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
						$("#change-one").trigger("click");
						$("#master_checkCode").val("");
						alert(d.msg);
						global.initGeetest();
					}
				},
				 complete: function(XMLHttpRequest, textStatus){
					 $("#index-btn").click(function(){
						//拼图验证码加载失败了
						if(global.captchaObj == null){
							 exports.login();
						}else {
							var checkCode = global.captchaObj.getValidate();
							exports.userLogin(checkCode);
						}
					 });
				 },
				error:function(xhr){
					alert("登录失败，请重试");
				}
			});
		}
	};
	
	exports.userLoginDialog = function(checkCode){
		var $loginForm=$("#login-form");
		if($loginForm.valid()){
			$(".no-content").html("");
			if(!checkCode){
				$(".no-content").html("请先拖动验证码到相应位置");
				return;
			}
			$.ajax({
				url:"/userAccount/userlogin",
				async:false,
				type:"POST",
				data:{
					"loginName":$.trim($loginForm.find("input[name='loginName']").val()),
					"password":$.trim($loginForm.find("input[name='password']").val()),
					"geetest_challenge": checkCode.geetest_challenge,
                    "geetest_validate": checkCode.geetest_validate,
                    "geetest_seccode": checkCode.geetest_seccode
				},
				dataType:"JSON",
				beforeSend: function(XMLHttpRequest){
					$("#loginNow").unbind();
				},
				success:function(d){
					if(d.success){
					    window.location.reload();
					}else{
						$loginForm.find("img").trigger("click");
						$loginForm.find("input[name='checkCode']").val("");
						$(".no-content").html(d.msg);
						global.initGeetest(true);
						//return false;
					}
				},
				 complete: function(XMLHttpRequest, textStatus){
					 $("#loginNow").click(function(){
						//拼图验证码加载失败了
						if(global.captchaObj == null){
							popLogin();
						}else {
							var checkCode = global.captchaObj.getValidate();
							exports.userLoginDialog(checkCode);
						}
					 });
				 },
				error:function(xhr){
					$(".no-content").html("登录失败，请重试");
					global.initGeetest(true);
				}
			});
		}
	};
	
	
	//验证码切换
	exports.checkCodeImg = function(){
		$("#change-one").click(function(){
			$(this).prev("span").find("img").trigger('click');
		});
	};
	//登录验证
	exports.loginValidate = function(){
		$("#master-login").validate({
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
					required:"用户名不能为空",
					emailaddress:"邮箱格式不正确"
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
				error.css({"padding-left":"10px","font-size": "10px"});
				element.css("border","1px solid #c8220b");
				var $tips = $(".login-style11"); 
				if(error.attr("id") == "master_loginName-error"){
					if(error.text()){
						if($tips.html() == ""){
							$tips.html("").append(error);
						}else{
							var errorTips=$tips.find("label[id='master_loginName-error']");
							if(errorTips.size() > 0 && errorTips.text() != ""){
								if(error.text() != errorTips.text()){
									$tips.html("").append(error);
								}
							}
						}
					}
				}else if(error.attr("id") == "master_checkCode-error"){
					error.css({"margin-top":"-3px","padding-left":"5px"});
					if(error.text()){
						if($tips.html() == ""){
							$tips.html("").append(error);
						}else{
							var errorTips=$tips.find("label[id='master_checkCode-error']");
							if(errorTips.size() > 0 && errorTips.text() != ""){
								if(error.text() != errorTips.text()){
									$tips.html("").append(error);
								}
							}
						}
					}
				}else if(error.attr("id") == "master_password-error"){
					if(error.text()){
						if($tips.html() == ""){
							$tips.html("").append(error);
						}else{
							var errorTips=$tips.find("label[id='master_password-error']");
							if(errorTips.size() > 0 && errorTips.text() != ""){
								if(error.text() != errorTips.text()){
									$tips.html("").append(error);
								}
							}
						}
					}
				}
				$tips.show();
			},
			success: function(label) {
				var $loginTips=$(".login-style11");
				if(label.attr("id") == "master_loginName-error"){
					$("#master_loginName").removeAttr("style");
					if($loginTips.find("label[id='master_loginName-error']").size() > 0){
						$loginTips.html("").hide();
					}
				}else if(label.attr("id") == "master_checkCode-error"){
					$("#master_checkCode").removeAttr("style");
					if($loginTips.find("label[id='master_checkCode-error']").size() > 0){
						$loginTips.html("").hide();
					}
				}else if(label.attr("id") == "master_password-error"){
					$("#master_password").removeAttr("style");
					if($loginTips.find("label[id='master_password-error']").size() > 0){
						$loginTips.html("").hide();
					}
				}
				if($loginTips.find("label").size() == 0){
					$loginTips.html("").hide();
				}
			}
		});
	};
	exports.login = function(){
		$("#master-login-sub").unbind();
		$("#master-login-sub").click(function(){
			//拼图验证码加载失败了
			if(global.captchaObj == null){
				exports.loginSub();
			}else {
				var checkCode = global.captchaObj.getValidate();
				exports.userLogin(checkCode);
			}
		});
	};
	exports.enterKeypress = function(){
		var $inp = $("#master-login input");
		$inp.keypress(function(e) {
			var key = e.which;
			if (key == 13) {
				//拼图验证码加载失败了
				if(global.captchaObj == null){
					exports.loginSub();
				}else {
					var checkCode = global.captchaObj.getValidate();
					exports.userLogin(checkCode);
				}
			}
		});
	};
	$(function(){
		$("#loginNow").hover(function(){
			$(this).css("background-color", "#c8220b").css("color", "#FFFFFF");
		},function(){
			$(this).css("background-color", "#FFFFFF").css("color", "#c8220b");
		});
		$("#loginNow").click(function(){
			//拼图验证码加载失败了
			if(global.captchaObj == null){
				popLogin();
			}else {
				var checkCode = global.captchaObj.getValidate();
				exports.userLoginDialog(checkCode);
			}
		});
		$("#myModal_login .close").click(function(){
			var modal = $("#myModal_login");
			modal.find("form")[0].reset();
			modal.find("label").remove();
			modal.find("input").removeClass("error").css("border","");
		});
		loginValidate();
		enterKeypress();
		var inputFocuse=$(".login-div input[type=text]");
		var passwordFocuse=$(".login-div input[type=password]");
		inputFocuse.focus(function(){
			$(this).css("border","1px solid rgba(93,149,242,.75)");
			$(this).val('');
		});
		passwordFocuse.focus(function(){
			$(this).css("border","1px solid rgba(93,149,242,.75)");
			$(this).val('');
		});
	});
	
});