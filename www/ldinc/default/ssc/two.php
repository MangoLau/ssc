<html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="baidu-site-verification" content="VFE7S2OmeO" />
	<meta name="keywords" content="彩票小助手、免费在线做号工具、在线做号软件、"/>
	<meta name="description" content="目前最好的做号工具包括二星做号 三星做号 四星做号 五星做号 号码在线生成还可以进行遗漏统计 二次过滤的独家超级功能"/>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" /> 	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>做号工具-时时彩做号工具 缩水工具 大底验证</title> 
	
	<link rel="stylesheet" href="/static/css/reset.css"/>
	<link rel="stylesheet" href="/static/css/bootstrap.css"/>
	<link rel="stylesheet" href="/static/css/common.css"/>
	<link rel="stylesheet" href="/static/css/fiveStarDouble.css"/>
	<link rel="stylesheet" href="/static/css/dialog.css"/>
	<link rel="stylesheet" href="/static/css/validation.css"/>
	<link rel="stylesheet" href="/static/css/select2.min.css"/>
	<link rel="stylesheet" href="/static/css/gonggao.css"/>
	<link rel="stylesheet" href="/static/css/lyjy.css"/>
	<link rel="stylesheet" type="text/css" href="/static/css/twoStarZhgj.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/lanren.css"/>
	
	
	<script type="text/javascript" src="/static/js/resource/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/static/js/resource/select2/select2.min.js"></script>
	<script type="text/javascript" src="/static/js/resource/bootstrap/bootstrap.js"></script>
	<script type="text/javascript" src="/static/js/resource/seajs/sea.js"</script>
	
	
	<script type="text/javascript" src="/static/js/resource/layer/layer.js"></script>
	<script type="text/javascript" src="/static/js/resource/clipBoard/jquery.zclip.min.js"></script>
	<script type="text/javascript" src="/static/js/global/seaConfig.js"></script>
	<script >
		seajs.use("/static/js/function/zhgj/zhgj")
	</script>

</head>

<body>
<div class="homePage caipiao">
	<!-- 顶部彩色边static begin -->
	<div class="topline"></div>
	<!-- 顶部彩色边static end -->
	<!-- 顶部栏static begin -->
	<div class="homePageTop2">
		<div class="container clearfix">
			<div class="pull-left">
				<a href="index.htm" tppabs="http://www.cpxzs.com/"></a>
			</div>
			<div class="headDeatail clearfix">
				<form action="">
					<input type="text" class="searchbar" placeholder="请输入搜索内容" />
					<input type="submit" class="searchbtn" value="搜索" />
				</form>
			</div>
			<ul class="list-inline pull-right">
				<li class="xiangduiPosition"><span></span></li>
				<li class="phoneNumber"><a href="news/study.htm" tppabs="http://www.cpxzs.com/news/study">新手课堂</a><em></em></li>
				<li class="phoneNumber"><a href="topic.htm" tppabs="http://www.cpxzs.com/topic" class="clearfix"><span class="jcbbg"></span>精彩吧</a></li>
			</ul>
		</div>
	</div> 
	<!-- 顶部栏static end -->
	<input type="hidden" value="http://nodejs.ssc.com" id="webSocketUrl"/>
	<input type="hidden" value="false" id="uniqueLogin"/>
	<!-- 登录弹出框 begin -->
	<div class="modal fade" tabindex="-1" role="dialog" id="myModal_login" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel">登录彩票小助手</h4>
					</div>
					<div class="modal-body" id="login-body">
						<form id="login-form" method="post" autocomplete="off">
	        				<div class="modal-body1 login-chage">
	        					<ul class="specialDialogNow">
	        						<li class="clearfix parentCls">
	        							<span class="spspnow">用户名：</span>
	        							<input type="text" class="inputElem" name="loginName"  id="loginName" placeholder="请输入昵称/注册邮箱"/>
	        						</li>
	        						<li class="clearfix">
	        							<span class="spspnow">密码：</span>
	        							<input type="password" name="password" id="password" maxlength="12" placeholder="请输入密码"/>
	        						</li>
	        						<li class="clearfix"  id="checkCodeDialogDIV" style="display:none;">
	        							<span class="spspnow">验证码：</span>
	        							<input type="text" style="width:130px" name="checkCode" placeholder="验证码" id = "checkCode" maxlength="4"/>
										<span class="span-three span-yzm"><img src="../checkCodeImg" tppabs="http://www.cpxzs.com/checkCodeImg" onclick="this.src='/checkCodeImg?'+Math.random();" style="padding-left: 10px;"/></span>
	        						</li>
	        						<li class="clearfix" id="jiyanDialogDIV">
										<div class="jiyanDialogDIV" id="embed-captchaDialog"></div>
	                                    <span id="waitDialog" class="show">正在加载验证码......</span>
	        						</li>
	        						<li class="clearfix modal-body1a margin-small">
	        							<a class="btn btn-default loginNowow" id="loginNow">登录</a>
	        						</li>
									<li class="inline-li pull-left"><span class="no-content"></span></li>
	        						<li class="clearfix text-right inline-li pull-right line-small">
	        							</span>没账号？去 <a href="../register.htm" tppabs="http://www.cpxzs.com/register" data-toggle="modal" id="register-dialog">注册</a>
	        						</li>
									<input type="hidden" value="true" name="check"/>
	        					</ul>
	        				</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 登录弹出框 end -->
	<!-- 导航条static begin -->
	<div class="homePageTop3">
		<div class="container">
			<ul class="list-inline nav-parents clearfix">
				<li class="nav-parents-childOne"><a href="index.htm" id="naviIndex">小概率</a><span>1</span></li>
				<li><a href="jhfa/hotCold.htm" target="_blank" id="hotColdJhfaNavi">人工验证区</a><span>2</span></li>
				<li><a href="jhfa/tuiBo.htm" target="_blank"  id="tuiBoJhfaNavi">遗漏助手</a><span>3</span></li>
				<li><a href="jhfa/excellentPlan.htm" target="_blank" id="naviExcellentPlan">人工计划</a><span>4</span></li>
				<li><a href="jhfa/expert.htm" id="wellKnownPlan">精品计划</a><span>5</span></li>
				<li><a href="#" target="_blank"  id="naviMasterRoad">推波计划</a><span>6</span></li>
				<li><a href="masterPlan.htm" id="naviExpert">遗漏预警</a><span>7</span></li>
				<li><a href="zhgj/2.htm" id="naviYiLouSuoShui" class="active">做号工具</a></li>
			</ul>
		</div>
	</div>	
	<!-- 导航条static end -->
	<!-- banner static begin -->
	<div class="banner">
		<a href="#"><img src="/static/img/banner.jpg" alt="" /></a>
	</div>
	<!-- banner static end -->
	<input type="hidden" id="domainUrl" value="www.cpxzs.com" />
	<input type="hidden" id="hour" value="0" />
	<input type="hidden" id="minute" value="29" />
	<input type="hidden" id="second" value="22" />
				
	<div class="homePageMiddle">
		<div class="container clearfix"> 
		<div class="oneStarPlan-left pull-left">
			<!--内容左半部分 begin  -->
			<div class="two-star-zhgj">
				<!-- 星级做号导航tab begin -->
				<div class="two-star-zhgj1">
					<ul class="list-inline clearfix">
						<li><a href="javascript:void(0)" class="active" id="twoStarZuoHao">二星做号</a></li>
						<li><a href="javascript:void(0)" id="threeStarZuoHao">三星做号</a></li>
						<li><a href="javascript:void(0)" id="fourStarZuoHao">四星做号</a></li>
						<li><a href="javascript:void(0)" id="fiveStarZuoHao">五星做号</a></li>
						<li><a href="javascript:void(0)" id="specialStarZhgj">特殊组合转单式</a></li>
					</ul>
				</div>
				<!-- 星级做号导航tab end -->
				<div class="padding-small">
					<div class="two-star-zhgj2">使用说明：只有从共享平台过来的用户或小助手付费会员才可以查看遗漏和使用做号功能</div>
					<div class="two-star-zhgj3">
						<div class="panel-group" id="accordion">
							<!-- 定位杀 begin -->
							<div class="panel panel-default">
								<div class="panel-heading sq">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" aria-expanded="true" class="collapsedClick">
											<span class="main2bParentBrotherLeft1a1">定位杀</span> 
											<span class="iconfont icon-xiala main2bParentBrotherLeft1a2"></span>
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="false" style="height: auto;">
									<div class="panel-body">
										<div class="two-star-zhgj3a clearfix">
											<span class="span-block">十位</span>
											<ul class="listsLi list-inline clearfix" id="secondNum">
												<li>0</li>
												<li>1</li>
												<li>2</li>
												<li>3</li>
												<li>4</li>
												<li>5</li>
												<li>6</li>
												<li>7</li>
												<li>8</li>
												<li>9</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button>大</button>
												<button>小</button>
												<button>单</button>
												<button>双</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="newStarNow clearfix">
											<span class="spanOne">当前遗漏</span>
											<ul class="list-inline xing">
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>											
											</ul>
										</div>
										<div class="newStarNow clearfix">
											<span class="spanOne">历史最大</span>
											<ul class="list-inline xing">
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
											</ul>
										</div>
										<div class="two-star-zhgj3a clearfix">
											<span class="span-block">个位</span>
											<ul class="listsLi list-inline clearfix" id="firstNum">
												<li>0</li>
												<li>1</li>
												<li>2</li>
												<li>3</li>
												<li>4</li>
												<li>5</li>
												<li>6</li>
												<li>7</li>
												<li>8</li>
												<li>9</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button>大</button>
												<button>小</button>
												<button>单</button>
												<button>双</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="newStarNow clearfix">
											<span class="spanOne">当前遗漏</span>
											<ul class="list-inline xing">
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
											</ul>
										</div>
										<div class="newStarNow clearfix">
											<span class="spanOne">历史最大</span>
											<ul class="list-inline xing">
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
												<li>*</li>
				    						</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- 定位杀 end -->
							<!-- 和、跨、胆 begin -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" class="collapsed collapsedClick" aria-expanded="false">
											<span class="main2bParentBrotherLeft1a1">和、跨、胆:（选中即为选中）</span> <span class="iconfont icon-xiala main2bParentBrotherLeft1a2"></span>
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<div class="two-star-zhgj3a clearfix">
											<span class="span-block">和尾选</span>
											<ul class="listsLi list-inline clearfix" id="endValueNum">
												<li>0</li>
												<li>1</li>
												<li>2</li>
												<li>3</li>
												<li>4</li>
												<li>5</li>
												<li>6</li>
												<li>7</li>
												<li>8</li>
												<li>9</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button>大</button>
												<button>小</button>
												<button>单</button>
												<button>双</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="two-star-zhgj3a clearfix">
											<span class="span-block">跨度选</span>
											<ul class="listsLi list-inline clearfix" id="spanNum">
												<li>0</li>
												<li class="">1</li>
												<li>2</li>
												<li>3</li>
												<li>4</li>
												<li>5</li>
												<li>6</li>
												<li>7</li>
												<li>8</li>
												<li>9</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button>大</button>
												<button>小</button>
												<button>单</button>
												<button>双</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="two-star-zhgj3a clearfix">
											<span class="span-block">胆码选</span>
											<ul class="listsLi list-inline clearfix" id="danMaNum">
												<li>0</li>
												<li class="">1</li>
												<li>2</li>
												<li>3</li>
												<li>4</li>
												<li>5</li>
												<li>6</li>
												<li>7</li>
												<li>8</li>
												<li>9</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button>大</button>
												<button>小</button>
												<button>单</button>
												<button>双</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="two-star-zhgj3b">至少出胆个数 （重复号算一胆）<label class="checkbox-inline">
												<input type="radio" name="chuDanNum" id="" value="1" checked>1个
											</label> 
											<label class="checkbox-inline"> 
												<input type="radio" name="chuDanNum" id="" value="2"  >2个
											</label>
										</div>
									</div>
								</div>
							</div>
							<!-- 和、跨、胆 end -->
							<!-- 特别排除 begin -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" class="collapsed collapsedClick" aria-expanded="true">
											<span class="main2bParentBrotherLeft1a1">特别排除</span> <span class="iconfont icon-xiala main2bParentBrotherLeft1a2"></span>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<div class="two-star-zhgj3a bgSpeical1 clearfix">
											<ul class="listsLi list-inline clearfix">
											<li class="btn btn-default float-left" id="nonContinuity">不连</li>
											<li class="btn btn-default float-left" id="twoContinuity">2连</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button class="last">清</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- 特别排除 end -->
							<!-- 和值杀 begin -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion4" href="#collapseFour" class="collapsed collapsedClick" aria-expanded="false">
											<span class="main2bParentBrotherLeft1a1">和值杀</span> <span class="iconfont icon-xiala main2bParentBrotherLeft1a2"></span>
										</a>
									</h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<div class="two-star-zhgj3a clearfix">
											<div class="two-star-zhgj3a1" id="sumValueNum">
												<ul class="listsLi list-inline clearfix">
													<li>0</li>
													<li>1</li>
													<li>2</li>
													<li>3</li>
													<li>4</li>
													<li>5</li>
													<li>6</li>
													<li>7</li>
													<li>8</li>
													<li>9</li>
												</ul>
												<ul class="listsLi list-inline clearfix">
													<li>10</li>
													<li>11</li>
													<li>12</li>
													<li>13</li>
													<li>14</li>
													<li>15</li>
													<li>16</li>
													<li>17</li>
													<li>18</li>
												</ul>
											</div>
											<div class="specialNew">
												<button class="">全</button>
												<button class="last">清</button>
											</div>
											<div class="two-star-zhgj3a2">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- 和值杀 end -->
							<!-- 杀排列 begin -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion5" href="#collapseFive" class="collapsed collapsedClick" aria-expanded="false">
											<span class="main2bParentBrotherLeft1a1">杀排列</span> <span class="iconfont icon-xiala main2bParentBrotherLeft1a2"></span>
										</a>
									</h4>
								</div>
								<div id="collapseFive" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<div class="two-star-zhgj3c clearfix">
											<span class="span-block">杀大小</span>
											<ul class="listsLi list-inline clearfix" id="bigSmallNum">
												<li>大大</li>
												<li>大小</li>
												<li>小小</li>
												<li>小大</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="two-star-zhgj3c clearfix">
											<span class="span-block">杀奇偶</span>
											<ul class="listsLi list-inline clearfix" id="oddEvenNum">
												<li>奇奇</li>
												<li>奇偶</li>
												<li>偶偶</li>
												<li>偶奇</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="two-star-zhgj3c border-btm clearfix">
											<span class="span-block">杀质合</span>
											<ul class="listsLi list-inline clearfix" id="primeCompositeNum">
												<li>质质</li>
												<li>质合</li>
												<li>合合</li>
												<li>合质</li>
											</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button class="last">清</button>
											</div>
										</div>
										<div class="two-star-zhgj3d clearfix" id="bigOddPrimeNum">
											<div class="two-star-zhgj3d1">
												<h5>大号个数</h5>
												<ul class="listsLi list-inline" id="bigNum">
													<li>0</li>
													<li>1</li>
													<li>2</li>
												</ul>
											</div>
											<div class="two-star-zhgj3d1">
												<h5>奇数个数</h5>
												<ul class="listsLi list-inline" id="oddNum">
													<li>0</li>
													<li>1</li>
													<li>2</li>
												</ul>
											</div>
											<div class="two-star-zhgj3d1">
												<h5>质数个数</h5>
												<ul class="listsLi list-inline" id="primeNum">
													<li>0</li>
													<li>1</li>
													<li>2</li>
												</ul>
											</div>
											<div class="two-star-zhgj3a2">
				    							<div class="specialNew">
				    								<button class="">全</button>
				    								<button class="last">清</button>
											    </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- 杀排列 end -->
							<!-- 杀012路形态 begin -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion6" href="#collapseSix" class="collapsed collapsedClick" aria-expanded="false">
											<span class="main2bParentBrotherLeft1a1">杀012路形态</span> <span class="iconfont icon-xiala main2bParentBrotherLeft1a2"></span>
										</a>
									</h4>
								</div>
								<div id="collapseSix" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<div class="two-star-zhgj3a clearfix"  id="approachNum">
											 <ul class="listsLi list-inline clearfix" >
				                    			<li>00</li>
				                    			<li>01</li>
				                    			<li>02</li>
				                    			<li>10</li>
				                    			<li>11</li>
				                    			<li>12</li>
				                    			<li>20</li>
				                    			<li>21</li>
				                    			<li>22</li>
				                    		</ul>
											<div class="specialNew">
												<button class="">全</button>
												<button class="last">清</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- 杀012路形态 end -->
						</div>
					</div>
				</div>
				<input type="hidden" id="zhgjType" value="2">
				<form id="dispatcherForm" method="POST" action="2-type=cqssc.htm" tppabs="http://www.ssc.com/zhgj/2?type=cqssc">
					<input type="hidden" id="bannerCaiPiaoType" value="cqssc" name="type">
				</form>
				<div class="two-star-zhgj4">
					<div class="two-star-zhgj4a clearfix">
						<a href="javascript:void(0)" class="shengcheng" id="zhgjGen"></a> 
						<a href="javascript:void(0)" class="turnZuXuan" id="turnZuXuan"></a> 
						<a href="javascript:void(0)" class="fanxuan" id="reverseSelect" index="twoStar"></a> 
						<a href="javascript:void(0)" id="zhgjClear" class="clearOne"></a> 
						<a href="javascript:void(0)" class="tj" id="ylQuery"></a> 
					    <a href="javascript:void(0)" id="zhgjKeyCopy" class="copy1"></a>
								</div>
					<div class="two-star-zhgj4b">
						<textarea id="reply_content" ></textarea>
					</div>
					 
					<div class="zhgjNewDiv clearfix touZhu">
						<span class="spanOne">方案注数&nbsp;&nbsp;&nbsp;共<strong  class="color_main"><font color='#e9608c' id="resultSize">0</font></strong>注</span>
					    <div class="checkbox">
			               <label>
			            	<input type="radio" value="7" name="type" checked  >前二
							</label>
			            </div>
						<div class="checkbox">
			               <label>
			            	<input type="radio" name="type"  value="12">后二
							</label>
			            </div>
					</div>
					<div class="zhgjNewDiv1 text-center">
						<div class="zhgjNewDiv1sp">
							<a href="javascript:void(0);" id="goToTouZhu" class="pramairy"></a>
							<a href="javascript:;" class="ddyz" id="goDaDiYZ"></a>
							<a href="javascript:;" class="ecgl" id="ecgl"></a>
						</div>
					</div>
				</div>
			</div>
			<!--内容左半部分 end  -->
		</div>
		<form id="touZhuForm" method="POST" action="../masterRoad/index-ft=&tzNumber=.htm" tppabs="http://www.cpxzs.com/masterRoad/index?ft=&tzNumber=">
			<input type="hidden" id="ft" name="ft" />
			<input type="hidden" id="tzNumber" name="tzNumber" />
		</form>
		<form id="checkForm" method="POST" action="../ddyz/index-pt=&yzNumber=.htm" tppabs="http://www.cpxzs.com/ddyz/index?pt=&yzNumber=">
			<input type="hidden" id="pt" name="pt" />
			<input type="hidden" id="yzNumber" name="yzNumber" />
		</form>	
		<form id="secondCheck" method="POST" action="../danShiGL-sc=&scNumber=.htm" tppabs="http://www.cpxzs.com/danShiGL?sc=&scNumber=">
			<input type="hidden" id="sc" name="sc" />
			<input type="hidden" id="scNumber" name="scNumber" />
		</form>	
		<div class="oneStarPlan-right pull-right">
			<!-- 开奖统计与倒计时 begin -->
			<div class="homePasgeMiddle2c">
				<!-- 投注时间倒计时 begin -->
				<div class="timeFor-count">
			    	<div class="timeFor-count3 clearfix">
			          <span id="nextPeriodStr">20170104-024期</span>
			          <span>剩余投注时间</span>
			          <!-- 剩余投注时间交互未确定先隐藏 begin -->
			          <span class="timmer1 firHour">0</span>
			          <span class="timmer1 secHour">1</span>
			          <span class="hide">时</span>
			          <span class="timmer1 firMin">2</span>
			          <span class="timmer1 secMin">0</span>
			          <span class="hide">分</span>
			          <span class="timmer1 firSec">3</span>
			          <span class="timmer1 secSec">2</span>
			           <span class="hide">秒</span>
			          <!-- 剩余投注时间交互未确定先隐藏 end -->
				    </div>
				</div>
				<!-- 投注时间倒计时 end -->
				<div class="fr">
					<div class="homePasgeMiddle2c1">
						时时彩&nbsp;第<span id="numberPatternPeriod">20170110-076</span>期&nbsp;开奖
					</div>
					<div class="homePasgeMiddle2c2">
						<ul class="list-inline clearfix" id="numberPatternNumber"><li>1</li><li>2</li><li>9</li><li>7</li><li>7</li></ul>
					</div>
					<div class="text-center red">
						今天已开<span id="numberPatternKaiCount">77</span>期&nbsp;还剩<span id="numberPatternWeiKaiCount">44</span>期
					</div>
				</div>
			</div>
			<!-- 开奖统计与倒计时 end -->
			<div class="homePasgeMiddle2d">
				<table class="table1 table-striped">
					<thead>
						<tr>
							<th class="xiangduiPosition border-right th01">
								<span>期号</span>
							</th>
							<th class="xiangduiPosition border-right">
								<span>开奖号</span>
							</th>
							<th colspan="3" class="width-td">
								<p><em class="tabtit active" id="numberPatternHouSan" title="numberPatternHouSanTitle" contentClass="numberPatternHouSanDiv">三星</em><em class="tabtit last" id="numberPatternHouEr" title="numberPatternHouErTitle"  contentClass="numberPatternHouErDiv">后二</em></p>
								<p class="bgColor" id="numberPatternHouSanTitle" >
									<span>前三形态</span>
									<span>中三形态</span>
									<span>后三形态</span>
								</p>
								<p class="bgColor" id="numberPatternHouErTitle"  style="display:none;">
									<span>形态</span>
									<span>十位</span>
									<span>个位</span>
								</p>
							</th>
						</tr>
					</thead>
					<tbody id="numberPatternBody">
				     <tr>
				      <td>075</td>
				      <td class="numberPatternHouSanDiv contentClass space">74<span class="color_Main space">559</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">745<span class="color_Main">59</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="color_Main">组三</span><span class="color_Main">组三</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>大单</span><span>大单</span></td>
				     </tr>
				     <tr>
				      <td>074</td>
				      <td class="numberPatternHouSanDiv contentClass space">27<span class="color_Main space">129</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">271<span class="color_Main">29</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>小双</span><span>大单</span></td>
				     </tr>
				     <tr>
				      <td>073</td>
				      <td class="numberPatternHouSanDiv contentClass space">19<span class="color_Main space">587</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">195<span class="color_Main">87</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span class="lianhao">连号</span><span>大双</span><span>大单</span></td>
				     </tr>
				     <tr>
				      <td>072</td>
				      <td class="numberPatternHouSanDiv contentClass space">58<span class="color_Main space">319</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">583<span class="color_Main">19</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>小单</span><span>大单</span></td>
				     </tr>
				     <tr>
				      <td>071</td>
				      <td class="numberPatternHouSanDiv contentClass space">55<span class="color_Main space">836</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">558<span class="color_Main">36</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="color_Main">组三</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>小单</span><span>大双</span></td>
				     </tr>
				     <tr>
				      <td>070</td>
				      <td class="numberPatternHouSanDiv contentClass space">40<span class="color_Main space">958</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">409<span class="color_Main">58</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>大单</span><span>大双</span></td>
				     </tr>
				     <tr>
				      <td>069</td>
				      <td class="numberPatternHouSanDiv contentClass space">34<span class="color_Main space">063</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">340<span class="color_Main">63</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>大双</span><span>小单</span></td>
				     </tr>
				     <tr>
				      <td>068</td>
				      <td class="numberPatternHouSanDiv contentClass space">49<span class="color_Main space">741</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">497<span class="color_Main">41</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="zuliu">组六</span><span class="zuliu">组六</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>小双</span><span>小单</span></td>
				     </tr>
				     <tr>
				      <td>067</td>
				      <td class="numberPatternHouSanDiv contentClass space">22<span class="color_Main space">321</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">223<span class="color_Main">21</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="color_Main">组三</span><span class="color_Main">组三</span><span class="zuliu">组六</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span class="lianhao">连号</span><span>小双</span><span>小单</span></td>
				     </tr>
				     <tr>
				      <td>066</td>
				      <td class="numberPatternHouSanDiv contentClass space">52<span class="color_Main space">224</span></td>
				      <td class="numberPatternHouErDiv contentClass" style="display:none;">522<span class="color_Main">24</span></td>
				      <td colspan="3" class="table_span contentClass numberPatternHouSanDiv"><span class="color_Main">组三</span><span class="baozi">豹子</span><span class="color_Main">组三</span></td>
				      <td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;"><span></span><span>小双</span><span>小双</span></td>
				     </tr>
				    </tbody> 
				</table>
			</div>
			
			<div class="homePasgeMiddle2e text-right">
				<a href="javascript:if(confirm('http://www.cpxzs.com/historyNumber  \n\n?????δ? Teleport Pro ȡ?أ??Ϊ ????ȡ?ã?????ȡ?غ?????????ֹͣ????졣  \n\n?Ҫ?ӷ??????????'))window.location='http://www.cpxzs.com/historyNumber'"class="red">查看历史开奖</a> |
				<a href="../trend.htm" tppabs="http://www.cpxzs.com/trend">查看走势图</a>
			</div>

			<div class="homePasgeMiddle2f">
				<div class="homePasgeMiddle2f-div"><span>形态统计</span></div>
				<div class="omg">
				<div class="homePasgeMiddle2f1">
					<ul class="clearfix" >
						<li class="active" id="today" attr="today">今天</li>
						<li id="yesterday" attr="yesterday">昨天</li>
						<li id="dayBeforeYesterday" attr="dayBeforeYesterday">前天</li>
					</ul>
				</div>
				<div class="homePasgeMiddle2f2"> 
				   <div id="numberPatternStatistics" class="homePasgeMiddle2f2a" data-highcharts-chart="42">
				    <div class="highcharts-container" id="highcharts-126" style="position: relative; overflow: hidden; width: 296px; height: 400px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
				     <svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="296" height="400">
				      <desc>
				       Created with Highcharts 4.1.9
				      </desc>
				      <defs>
				       <clippath id="highcharts-127">
				        <rect x="0" y="0" width="265" height="213"></rect>
				       </clippath>
				      </defs>
				      <rect x="0" y="0" width="296" height="400" strokewidth="0" fill="#FFFFFF" class=" highcharts-background"></rect>
				      <g class="highcharts-grid" zindex="1"></g>
				      <g class="highcharts-grid" zindex="1">
				       <path fill="none" d="M 72.5 53 L 72.5 318" stroke="#D8D8D8" stroke-width="1" zindex="1" opacity="1"></path>
				       <path fill="none" d="M 125.5 53 L 125.5 318" stroke="#D8D8D8" stroke-width="1" zindex="1" opacity="1"></path>
				       <path fill="none" d="M 179.5 53 L 179.5 318" stroke="#D8D8D8" stroke-width="1" zindex="1" opacity="1"></path>
				       <path fill="none" d="M 232.5 53 L 232.5 318" stroke="#D8D8D8" stroke-width="1" zindex="1" opacity="1"></path>
				       <path fill="none" d="M 286.5 53 L 286.5 318" stroke="#D8D8D8" stroke-width="1" zindex="1" opacity="1"></path>
				      </g>
				      <g class="highcharts-axis" zindex="2"></g>
				      <g class="highcharts-series-group" zindex="3">
				       <g class="highcharts-series highcharts-series-0 highcharts-tracker" visibility="visible" zindex="0.1" transform="translate(286,318) rotate(90) scale(-1,1) scale(1 1)" style="" width="213" height="265" clip-path="url(#highcharts-127)">
				        <rect x="242.5" y="152.5" width="15" height="61" stroke="#FFFFFF" stroke-width="1" fill="#00b7eb" rx="0" ry="0"></rect>
				        <rect x="213.5" y="72.5" width="15" height="141" stroke="#FFFFFF" stroke-width="1" fill="#f5604c" rx="0" ry="0"></rect>
				        <rect x="183.5" y="213.5" width="15" height="0" stroke="#FFFFFF" stroke-width="1" fill="#90ed7d" rx="0" ry="0"></rect>
				        <rect x="154.5" y="149.5" width="15" height="64" stroke="#FFFFFF" stroke-width="1" fill="#009a44" rx="0" ry="0"></rect>
				        <rect x="124.5" y="80.5" width="15" height="133" stroke="#FFFFFF" stroke-width="1" fill="#df9301" rx="0" ry="0"></rect>
				        <rect x="95.5" y="208.5" width="15" height="5" stroke="#FFFFFF" stroke-width="1" fill="#f15c80" rx="0" ry="0"></rect>
				        <rect x="66.5" y="170.5" width="15" height="43" stroke="#FFFFFF" stroke-width="1" fill="#e9608c" rx="0" ry="0"></rect>
				        <rect x="36.5" y="53.5" width="15" height="160" stroke="#FFFFFF" stroke-width="1" fill="#00a59e" rx="0" ry="0"></rect>
				        <rect x="7.5" y="213.5" width="15" height="0" stroke="#FFFFFF" stroke-width="1" fill="#f45b5b" rx="0" ry="0"></rect>
				       </g>
				       <g class="highcharts-markers highcharts-series-0" visibility="visible" zindex="0.1" transform="translate(286,318) rotate(90) scale(-1,1) scale(1 1)" width="213" height="265" clip-path="none"></g>
				      </g>
				      <text x="125" text-anchor="middle" class="highcharts-title" zindex="4" style="color:#333333;font-size:18px;fill:#333333;width:232px;" y="24">
				       统计以下几种形态出现多少次
				      </text>
				      <g class="highcharts-data-labels highcharts-series-0 highcharts-tracker" visibility="visible" zindex="6" transform="translate(73,53) scale(1 1)" opacity="1" style="">
				       <g zindex="1" style="" transform="translate(61,1)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          23
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(141,30)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          53
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(0,60)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          0
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(64,89)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          24
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(133,119)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          50
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(5,148)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          2
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(43,177)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          16
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(160,207)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          60
				         </tspan>
				        </text>
				       </g>
				       <g zindex="1" style="" transform="translate(0,236)">
				        <text x="5" zindex="1" style="font-size:11px;font-weight:bold;color:#000000;text-shadow:0 0 6px #FFFFFF, 0 0 3px #FFFFFF;fill:#000000;text-rendering:geometricPrecision;" y="16">
				         <tspan>
				          0
				         </tspan>
				        </text>
				       </g>
				      </g>
				      <g class="highcharts-legend" zindex="7" transform="translate(106,356)">
				       <g zindex="1">
				        <g>
				         <g class="highcharts-legend-item" zindex="1" transform="translate(8,3)">
				          <text x="21" style="color:#000;font-size:12px;cursor:pointer;fill:#000;" text-anchor="start" zindex="2" y="15">
				           出现次数
				          </text>
				          <rect x="0" y="4" width="16" height="12" zindex="3" fill="#CCC"></rect>
				         </g>
				        </g>
				       </g>
				      </g>
				      <g class="highcharts-axis-labels highcharts-xaxis-labels" zindex="7">
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="70" opacity="1">
				        前三组三
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="99" opacity="1">
				        <tspan>
				         前三组六 
				        </tspan>
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="129" opacity="1">
				        前三豹子
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="158" opacity="1">
				        中三组三
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="188" opacity="1">
				        中三组六
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="217" opacity="1">
				        中三豹子
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="246" opacity="1">
				        后三组三
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="276" opacity="1">
				        后三组六
				       </text>
				       <text x="58" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:88px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="305" opacity="1">
				        后三豹子
				       </text>
				      </g>
				      <g class="highcharts-axis-labels highcharts-yaxis-labels" zindex="7">
				       <text x="73" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:53px;text-overflow:ellipsis;" text-anchor="middle" transform="translate(0,0)" y="337" opacity="1">
				        <tspan>
				         0
				        </tspan>
				       </text>
				       <text x="126.25" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:53px;text-overflow:ellipsis;" text-anchor="middle" transform="translate(0,0)" y="337" opacity="1">
				        <tspan>
				         20
				        </tspan>
				       </text>
				       <text x="179.5" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:53px;text-overflow:ellipsis;" text-anchor="middle" transform="translate(0,0)" y="337" opacity="1">
				        <tspan>
				         40
				        </tspan>
				       </text>
				       <text x="232.75" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:53px;text-overflow:ellipsis;" text-anchor="middle" transform="translate(0,0)" y="337" opacity="1">
				        <tspan>
				         60
				        </tspan>
				       </text>
				       <text x="278.4140625" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:26px;text-overflow:ellipsis;" text-anchor="middle" transform="translate(0,0)" y="337" opacity="1">
				        <tspan>
				         80
				        </tspan>
				       </text>
				      </g>
				      <g class="highcharts-tooltip" zindex="8" style="cursor:default;padding:0;pointer-events:none;white-space:nowrap;" transform="translate(140,-9999)" opacity="0" visibility="visible">
				       <path fill="none" d="M 3.5 0.5 L 113.5 0.5 C 116.5 0.5 116.5 0.5 116.5 3.5 L 116.5 46.5 C 116.5 49.5 116.5 49.5 113.5 49.5 L 3.5 49.5 C 0.5 49.5 0.5 49.5 0.5 46.5 L 0.5 30 -5.5 24 0.5 18 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isshadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)" width="116" height="49"></path>
				       <path fill="none" d="M 3.5 0.5 L 113.5 0.5 C 116.5 0.5 116.5 0.5 116.5 3.5 L 116.5 46.5 C 116.5 49.5 116.5 49.5 113.5 49.5 L 3.5 49.5 C 0.5 49.5 0.5 49.5 0.5 46.5 L 0.5 30 -5.5 24 0.5 18 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isshadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)" width="116" height="49"></path>
				       <path fill="none" d="M 3.5 0.5 L 113.5 0.5 C 116.5 0.5 116.5 0.5 116.5 3.5 L 116.5 46.5 C 116.5 49.5 116.5 49.5 113.5 49.5 L 3.5 49.5 C 0.5 49.5 0.5 49.5 0.5 46.5 L 0.5 30 -5.5 24 0.5 18 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isshadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)" width="116" height="49"></path>
				       <path fill="rgba(249, 249, 249, .85)" d="M 3.5 0.5 L 113.5 0.5 C 116.5 0.5 116.5 0.5 116.5 3.5 L 116.5 46.5 C 116.5 49.5 116.5 49.5 113.5 49.5 L 3.5 49.5 C 0.5 49.5 0.5 49.5 0.5 46.5 L 0.5 30 -5.5 24 0.5 18 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke="#7cb5ec" stroke-width="1"></path>
				       <text x="8" zindex="1" style="font-size:12px;color:#333333;fill:#333333;" y="20">
				        <tspan style="font-size: 10px">
				         前三组三
				        </tspan>
				        <tspan style="fill:#7cb5ec" x="8" dy="15">
				         ●
				        </tspan>
				        <tspan dx="0">
				          出现次数: 
				        </tspan>
				        <tspan style="font-weight:bold" dx="0">
				         23 次
				        </tspan>
				       </text>
				      </g>
				     </svg>
				    </div>
				   </div> 
				  </div>
				 </div>
			</div>
		</div>	
	 </div>
	</div>

	<!-- 弹出框 begin -->
	<div class="alert-dialog">
		<div class="modal fade" id="singleButtonDia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						来自彩票小助手的提示：
						<button type="button" class="close" data-dismiss="modal" id="singleButtonDiaClose" aria-hidden="true">
	            		  &times;
	        		</button>
					</div>
					<div class="modal-body" id="singleButtonDiaText">
						
					</div>
					<div class="modal-footer">
						<button type="button" id="singleDiaButton" class="btn btn-default" data-dismiss="modal">关闭
	       			    </button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade confirmOne" id="doubleButtonDia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						来自彩票小助手的提示：
						<button type="button" class="close" data-dismiss="modal" id="doubleDiaRedClose" aria-hidden="true">
	            		  &times;
	        		</button>
					</div>
					<div class="modal-body"  id="doubleButtonDiaText">
					</div>
					<div class="modal-footer">
						<button type="button" id="doubleDiaFirstButton" class="btn btn-primary">
			         	      确定
			            </button>
			            <button type="button"  id="doubleDiaSecondButton" class="btn btn-default" data-dismiss="modal">关闭
	       			    </button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 弹出框 end -->
    <div class="slide_min"></div>
    <!-- 页脚 begin -->
	<div class="homePageFoot">
		<div class="container">
			<p>Copyright &copy 2015 www.caipiaow.com All Rights Reserved. 北京亿鸣中天科技发展有限公司</p>
			<p>北京朝阳区安立路56号九台2000家园1号楼1101 电话010-64910751</p>
			<p>《中华人民共和国电信与信息服务业务经营许可证》编号：京ICP备11036906号-21</p>
		</div>
	</div>
	<!-- 页脚 end -->
	<input type="hidden" id="globalDomainUrl" value="www.cpxzs.com" />
	<!-- 顶部彩色边static begin -->
	<div class="topline"></div>
	<!-- 顶部彩色边static end -->
</div>
<script>
</script>
</body>
</html>