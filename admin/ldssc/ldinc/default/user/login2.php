<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$this->iff($args[0], $args[0] . '－'). $this->settings['webName']?></title>
<link rel="stylesheet" href="/cl/standard.css?v=wj4.3">
<link rel="stylesheet" href="/cl/wj43.css?v=wj4.3">
</head>
<body>
     <div class="clear" id="body-placeholder">
          <div id="mainBody">
<div id="page-header">
  <div id="header">
	   <div class="header-logo">
	   <!--div class="service-tel">在线电话客服：<span class="flag-img-se"></span>0063-90957 88888</div-->
		<div class="flashlogo" style="margin-top:38px;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="280" height="68">
  <param name="movie" value="/logo.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  <embed src="/logo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="270" height="68" wmode="transparent"></embed>
</object></div>
	   </div>
       <div class="png_fix" id="top-wrap">
             <div class="kehud"><a href="/help/down.html" target="_blank">客户端下载</a></div>
              <div class="navbg">
	<div class="inav">
		<ul id="nav" class="nav">
			<li class="nLi nlibg1 on"><a href="/">平台首页</a></li>
			<li class="nLi nlibg2"><a href="#" class="wjalert">时时彩</a>
					
            </li>
            <li class="nLi nlibg3"><a href="#" class="wjalert">乐透型</a>
					
			</li>
            <li class="nLi nlibg4"><a href="#" class="wjalert">数字型</a>
					
		  	</li>
			<li class="nLi nlibg5"><a href="#" class="wjalert">会员中心</a>
					
            </li>
			<li class="nLi nlibg6"><a href="#" class="wjalert">代理中心</a>
					
            </li>
			<li class="nLi nlibg7"><a href="/index.php/user/huodong">优惠活动</a></li>
		</ul>
    </div>
</div>
       </div>
  </div>
  </div>               <div id="page-container">
     <div id="middle-wrap">
          <div id="middle-left">
               <div class="png_fix" id="login-wrap-first">
	                <form action="/index.php/user/logined" method="post" onajax="userBeforeLogin" enter="true" call="userLogin" target="ajax">
		             <div class="clearfix png_fix" id="login-area">
		                  <div id="login_input">
				               <p class="login-unit-user"><label style="opacity: 1;*margin-left:5px;">帐号</label><input type="text" tabindex="1" value="" maxlength="15" id="username" class="za_text" name="username"></p>
				                <p style="margin-top:5px;"><label style="opacity: 1;">密码</label><input type="password" tabindex="2" maxlength="13" id="password" class="za_text" name="password"></p>
				               <p style="*margin-top:5px;">
				                  <label style="opacity: 1;*margin-left:-10px;" >验证码</label><img width="50" height="22" border="0" style="cursor:pointer; float:right;" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onClick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/><input type="text" tabindex="2" maxlength="4" id="vcode" class="za_text" name="vcode" style="width:60px; float:right;">
				                  
				               </p>
				          </div>
				          <div id="login_btn">
				               <input type="submit" onMouseOut="mout(this)" onMouseOver="mover(this)" tabindex="4" value="" class="png_fix" id="login-submit" name="Submit" style="background-position: 0px top;">
		                       <div id="login-txt">
				                   <!--<a title="忘记密码" id="login-pwd" target="_self" href="###">忘记密码</a>
				                   <a title="免费加入" class="login-Join" href="###">免费加入</a>-->
			                   </div>
			              </div>
		             </div> 
				     </form>
				     	            </div>  
	            <div class="png_fix" id="news-bg">
		            <div id="news-marquee">
					     <marquee style="cursor: pointer;" onClick="HotNewsHistory();" onMouseOut="this.start();" onMouseOver="this.stop();" direction="up" scrolldelay="5" scrollamount="2" id="msgNews">［丽都娱乐］是最早开发时时彩、11选5、福彩3D、排列三、时时乐、快乐十分、PK10、快8、快3、快乐扑克3、系统五分彩等高中低频游戏的团队之一。拥有强大的技术开发团队，精心研发本娱乐平台，各种新的好玩的玩法，将有不断惊喜等着您！</marquee>
				    </div>
				</div>
          </div>
          	      		  <div style="width:740px; height:448px;" id="ad-flash">
                          <div class="slidercontainer" id="idTransformView">
                    <ul class="slider" id="idSlider">
                    <li><a href="#" title=""><img width="740" src="/cl/ads/01.png" alt="" height="448"  /></a></li>
                    <li><a href="#" title=""><img width="740" src="/cl/ads/02.png" alt="" height="448"  /></a></li>
                    <li><a href="#" title=""><img width="740" src="/cl/ads/03.png" alt="" height="448"  /></a></li>
                    <li><a href="#" title=""><img width="740" src="/cl/ads/04.png" alt="" height="448"  /></a></li>
                    </ul>
                    <ul class="num" id="idNum"><li class="on">1</li><li>2</li><li>3</li><li>4</li></ul>
                </div>

		  </div>
     </div>
     <div id="middle-game-wrap">
     	  <div class="clearfix" id="middle-game">
		       <div id="firstGame-wrap">
               		<ul>
                    	<li class="odd"><a href="#"><img src="/cl/images/cqssc.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/jxssc.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/xjssc.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/cqkl10.jpg"></a></li>
                        <li class="odd"><a href="#"><img src="/cl/images/gd11x5.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/cq11x5.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/jx11x5.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/sd11x5.jpg"></a></li>
                        <li class="odd"><a href="#"><img src="/cl/images/jsk3.jpg"></a></li>
                        <li><a href="#"><img src="/cl/images/jlk3.jpg"></a></li>
                        
                    </ul>
                    <div class="clear"></div>
               </div>
		       		       
	           	<div class="png_fix" id="firstBTN-wrap">
	                <div class="hover_fade firstBTN-div" id="firstBTN-download"><a href="/down/down.html" target="_blank"></a></div>
	                <div class="hover_fade firstBTN-div" id="firstBTN-new"><a target="_blank" href="http://www.lidu178.com/"></a></div>
	                <div class="hover_fade firstBTN-div" id="firstBTN-service" onclick="wjkf168();"><a href="#"></a></div>
	           </div>
	      </div>
     </div>
</div>          </div>
	 </div>
     <div class="png_fix" id="bg-foot">
          <div class="png_fix" id="page-footer">
	
	<div id="footer">
			  <div id="copy_info">
			       Copyright &copy; 丽都娱乐 Reserved<br>
			  </div>
			  <div id="web_info">
			       （浏览本网主页，建议将电脑显示屏的分辨率调为1440*900 
			  </div>
		 </div>
	</div>
     </div>
<script type="text/javascript" src="/cl/jquery-1.7.2.min.js?v=4.3"></script>
<script type="text/javascript" src="/cl/slide-1.0.1.js"></script>
<script type="text/javascript" src="/skin/js/onload.js?v=wj5.0"></script>
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
		.closest('p')
		.find('img')
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

//在线客服
function wjkf168(){
		var newWin=window.open("#","","height=600, width=800, top=0, left=0,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
	if(!newWin||!newWin.open||newWin.closed){newWin=window.open('about:blank');}else{return false;}
		return false;
}

window.onerror=function(){return true;}
</script>
<script language="javascript" src="<?=$this->settings['kefuGG']?>"></script>
</body>
</html>

