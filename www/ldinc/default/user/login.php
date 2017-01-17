<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin.php',0,'会员登录'); ?>
<script language="javascript" type="text/javascript">
	var type=<?=$args[0]?>;
	function cue(){
		if(type == 1){
			art.dialog("由于您长时间未操作，系统已经自动退出，请重新登录！", function(){/*alert('yes');*/});
		}else if(type == 2){
			art.dialog("您的账号在其他地方登录，您被迫下线，如果这不是您自己的操作，请赶快修改密码！", function(){/*alert('yes');*/});
		}
	}
</script>
</head>
<body id="bg">
<div class="zhuce2">
 <div class="wjlogo" style="width:auto; height:auto;"><div class="flashlogo" style="margin-top:5px;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="280" height="68">
  <param name="movie" value="/logo.png" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  <embed src="/logo.png" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="280" height="68" wmode="transparent"></embed>
</object></div></div>
 <div class="zhucel">
  <p>　　会员注册 - 为了保障用户利益，本平台特些声明如下 ：<br />请广大用户认准本娱乐平台唯一地址:www.xianggang6.com以免造成不必要的损失。</p>
  
 </div>
<div id="reg" align="center" class="zhucer">
<form action="/index.php/user/logined" method="post" onajax="userBeforeLogin" enter="true" call="userLogin" target="ajax">
  <ul>
   <li><span>用户名：</span><input type="text"  maxlength="15" name="username" id="username" value="" class="text1" /></li>
   <li><span>密&nbsp;&nbsp;码：</span><input type="password"  maxlength="13" name="password" id="password"  value="" class="text1" /></li>
   <li><span>验证码：</span><input name="vcode" type="text" maxlength="4" id="vcode" class="text2" /><img width="89" height="32" border="0" style="cursor:pointer;" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></li>
  </ul>
  <br>
 
  <br>
  <b><a href="#" onclick="$(this).closest('form').submit()">登 陆</a></b>
  </form>
<div class="service-tel"  style="margin-top:150px; margin-left:-120px;">温馨提醒：本站最佳显示分辨率为(1440×900)请使用IE8.0浏览器或360浏览器切换成IE兼容模式<br>Copyright 2012-2014 <a href="#">帝豪娱乐</a> All Rights Reserved<br />
</div>
 </div>
</div>
<script type="text/javascript" src="/cl/jquery-1.7.2.min.js?v=4.3"></script>
<script type="text/javascript" src="/cl/slide-1.0.1.js"></script>
<script>
$(function(){

    $('.hover_fade > a, .hover_fade > span').hover(
        function(){
            $(this).stop().animate({'opacity': 0}, 350);
        }, function(){
            $(this).stop().animate({'opacity': 1}, 350);
        }
    );
})

function userBeforeLogin(){
	var u=this.username.value;
	var p=this.password.value;
	var v=this.vcode.value;
	if(!u){alert("请输入用户名");}
	else if(!p){alert("请输入密码");}
	else if(!v){alert("请输入验证码");}
	else{return true;}
	return false;
}

function userLogin(err, data){
	if(err){
		alert(err);
		$('input[name=vcode]')
		.val('')
		.closest('div')
		.find('.yzmNum img')
		.click();
		
	}else{
		location='/';
	}
}

$(function(){
	$(".wjalert").live("click",function(){
		alert("对不起，请先登录");
		return false;
	})
})

</script>
    <script type="text/javascript">
        function onSilverlightError(sender, args) {
            var appSource = "";
            if (sender != null && sender != 0) {
              appSource = sender.getHost().Source;
            }
            
            var errorType = args.ErrorType;
            var iErrorCode = args.ErrorCode;

            if (errorType == "ImageError" || errorType == "MediaError") {
              return;
            }

            var errMsg = "Silverlight 应用程序中未处理的错误 " +  appSource + "\n" ;

            errMsg += "代码: "+ iErrorCode + "    \n";
            errMsg += "类别: " + errorType + "       \n";
            errMsg += "消息: " + args.ErrorMessage + "     \n";

            if (errorType == "ParserError") {
                errMsg += "文件: " + args.xamlFile + "     \n";
                errMsg += "行: " + args.lineNumber + "     \n";
                errMsg += "位置: " + args.charPosition + "     \n";
            }
            else if (errorType == "RuntimeError") {           
                if (args.lineNumber != 0) {
                    errMsg += "行: " + args.lineNumber + "     \n";
                    errMsg += "位置: " +  args.charPosition + "     \n";
                }
                errMsg += "方法名称: " + args.methodName + "     \n";
            }
            ShowDownLoadZiTi();
            throw new Error(errMsg);
        }

        function ShowDownLoadZiTi() {
            document.getElementById('ShowDownLoadZitiDiv').style.display = "";
        }

        function HideDownLoadZiTi() {
            document.getElementById('ShowDownLoadZitiDiv').style.display = "none";
        }

    </script>
</body>
</html>