define(function(require,exports,module){
	var global = require("global");
	//用户中心导航栏
	var userNavi = require("funPath/account/common/user_navibar");
	require("resPath/validation/jquery.validate.min");
	require.async("resPath/validation/jquery.methods.min",function(){
		require("resPath/validation/additional-methods");
	});
    require("resPath/swfupload/swfupload");
	require("resPath/swfupload/swfupload.queue");
	require("resPath/swfupload/fileprogress");
	require("resPath/swfupload/handlers");
	require("resPath/swfupload/swfobject");
	require("resPath/swfupload/fullAvatarEditor");
	
	global.toggleClass("active",userNavi.naviList,"userInfo");
	
	var emailValidate = function(){
		$("#new-email").validate({
			rules:{
				email:{
					required:true,
					emailaddress:true,
					commonEmail:true,
					maxlength:30,
					remote:{
						 url: "/userAccount/checkLoginName", 
						    type: "post",
						    dataType: "json",
						    data: {
						        "loginName": function() {
						            return $.trim($("#email").val());
						        }
						    }
					}
				}
			},
			messages:{
				email:{
					required:"新邮箱不能为空",
					remote:"邮箱已存在",
					maxlength:"邮箱最大长度为30个字符"
				}
			},
			errorPlacement:function(error, element) {
				error.css({"font-size":"12px","margin-left":"10px","font-weight": "normal"});
				element.after(error);	
			},
			success: function(label) {
				label.remove();
			}
		});
	};
	var nickNameValidate = function(){
		$("#new-nickName").validate({
			rules:{
				nickName:{
					required:true,
					rangelength:[3,12],
					nickNameRegex:true,
					remote:{
						url: "/userAccount/checkNinkName", 
						type: "post",
						dataType: "json",
						data: {
							"nickName":function(){
								return $.trim($("#nickName").val());
							}
						}
					}
				}
			},
			messages:{
				nickName:{
					required:"昵称不能为空",
					rangelength:"用户昵称为<span class='spsp'>3-12</span>位字符",
					remote:"用户昵称已存在"
				}
			},
			errorPlacement:function(error, element) {
				error.css({"font-size":"12px","margin-left":"10px","font-weight": "normal"});
				element.after(error);	
			},
			success: function(label) {
				label.remove();
			}
		});
	};
	var upEmail = function(){
		var $upEmail=$("#new-email");
		var $newEmailSub=$("#new-email-sub");
		var errorTips = $("#email").next();
		if($upEmail.valid()){
			$.ajax({
				url:'/userAccount/upAccountName',
				async:false,
				data:{
					"email":$.trim($upEmail.find("input[name='email']").val())
				},
				dataType:'JSON',
				type:'POST',
				beforeSend: function(XMLHttpRequest){
					$newEmailSub.unbind();
				},
				success:function(d){
					if(d.success){
						window.location.reload();
					}else{
						errorTips.html("").html(d.msg);
					}
				},
				complete: function(XMLHttpRequest, textStatus){
					$newEmailSub.click(function(){
						 upEmail();
					 });
				 },
				error:function (xhr){
					if(xhr.status  == "403"){
						global.loginDialog();
					}else{
						errorTips.html("").html("修改失败，请稍后重试！");
					}
				}
			});
		}
	};
	var upNickName = function(){
		var $upNickName=$("#new-nickName");
		var $newNickNameSub=$("#new-nickName-sub");
		var errorTips = $("#nickName").next();
		if($upNickName.valid()){
			$.ajax({
				url:'/userAccount/upNickName',
				async:false,
				data:{
					"nickName":$.trim($upNickName.find("input[name='nickName']").val())
				},
				dataType:'JSON',
				type:'POST',
				beforeSend: function(XMLHttpRequest){
					$newNickNameSub.unbind();
				},
				success:function(d){
					if(d.success){
						window.location.reload();
					}else{
						errorTips.html("").html(d.msg);
					}
				},
				complete: function(XMLHttpRequest, textStatus){
					$newNickNameSub.click(function(){
						upNickName();
					});
				},
				error:function (xhr){
					if(xhr.status  == "403"){
						global.loginDialog();
					}else{
						errorTips.html("").html("修改失败，请稍后重试！");
					}
				}
			});
		}
	};
	var emailAuth = function(){
		var auth = $("#email-auth");
		$.ajax({
			url:'/userAccount/sendAuthEmail',
			type:'POST',
			dataType:'JSON',
			async:false,
			beforeSend: function(XMLHttpRequest){
				auth.unbind();
			},
			success:function(d){
				if(d.success){
					var email = d.email;
					var emailSuff = email.substring(email.indexOf("@"));
					var emailUrl = global.emailUrl();
					var url = emailUrl[emailSuff];
					if(!url){
						url = "http://mail.qq.com";
					}
					var text = "<div style='text-align:center;'><span>认证邮件发送成功&nbsp;已发送至"+d.email+"</span></br>"
					+ "<a href='"+url+"' style='margin-top:10px;border-radius:4px;display: inline-block;" +
					"text-align: center;border: 1px solid transparent;" +
					"color: #ffffff;background-color: #ec1500;-weibkit-transition: all 0.3s;-moz-transition: all 0.3s;" +
					"width: 82px;line-height: 31px'>" 
					+ "去邮箱</a></div>";
					alert(text);
				}else{
					alert(d.msg);
				}
			},
			complete: function(XMLHttpRequest, textStatus){
				auth.click(function(){
					emailAuth();
				 });
			 },
			error:function(xhr){
				if(xhr.status == "403"){
					global.loginDialog();
				}else{
					alert("邮件发送失败，请稍后重试！");
				}
			}
		});
	};
	var headIngSettings = {
		    upload_url: "/userAccount/upHeadImg",
		    flash_url : "/static/js/resource/swfupload/swfupload.swf",
		    file_post_name:"file",
		    post_params : {
		           "JSESSIONID":$("#sessionId").val(),
		    },
			use_query_string:false,
			prevent_swf_caching:true,
			file_types : "*.gif;*.jpg;*.png;*.jpeg;",
			file_size_limit:"2MB",
			file_types_description : "",
			file_upload_limit : 0,
			file_queue_limit : 1,
			button_placeholder_id : "upHeadImg",
			
			button_width: 73,
			button_height: 82,
			button_text : '编辑头像',
			button_text_style : '.button {margin: 0px;float: right;line-height: 82px;color: #666666;}',
			button_text_top_padding: 30,
			button_text_left_padding: 10,
			button_window_mode:'transparent',
			button_cursor: SWFUpload.CURSOR.HAND,
			debug: false ,  
			file_queue_error_handler : shareFileErrorQueued,
			file_dialog_complete_handler : shareFileDialogComplete,
			upload_success_handler : shareUploadSuccess,
			upload_error_handler : shareUploadError,
	    };

var headImg = new SWFUpload(headIngSettings);
function shareFileDialogComplete(selectNumber,queuedNumber,uploadQueueNumber){
	headImg.startUpload();
}
function shareFileErrorQueued(file,code,message){
	switch(code){
	case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
		alert("亲，一次只能上传一个文件哦！");
		break;
	case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
		alert("亲，单个文件上传不能大于2M");
		break;
	case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
		alert("亲，您文件是空的");
		break;
	}
	 return false;
 }
function shareUploadSuccess(file,data,response){
	var data = $.parseJSON(data);
	if(data.success){
		$("#imgHead").attr("src",data.url);
	}
	else{
		alert(data.msg);
	}
}
function shareUploadError(file,code,message){
	alert("头像上传失败，请使用其他浏览器（chrome）");
}


$(function(){
	emailValidate();
	nickNameValidate();
	$("#new-email-sub").click(function(){
		upEmail();
	});
	$("#new-nickName-sub").click(function(){
		upNickName();
	});
	$("#email-auth").click(function(){
		emailAuth();
	});
	$(".close").click(function(){
		var colseForm = $(this).parent().next("form");
		colseForm[0].reset();
		colseForm.find("span").html("");
		colseForm.find("label").remove();
	});
});
});