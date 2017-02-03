define(function(require,exports,module){
	require("globalPath/globalUtils");
	require("resPath/socket.io/socket.io");
	require("resPath/initGeetest/gt");
	
	exports.naviBar = ["naviIndex","hotColdJhfaNavi","tuiBoJhfaNavi","naviHistoryNumber","naviTrend","naviExcellentPlan","naviExpert","omitCount","naviMasterRoad","masterRanking","zuSanZuLiu","naviYiLouSuoShui","wellKnownPlan"];
	exports.patternStatisticsDateStr="today";
	exports.patternStatisticsDateArr=["today","yesterday","dayBeforeYesterday"];
	
	exports.toggleClass=function(className,idArr,activeId){
		$.each(idArr,function(index,item){
			if(activeId == item){
				$("#"+item).addClass(className);
			}else{
				$("#"+item).removeClass(className);
			}
		});
	};
	exports.toggleHide=function(divIdArr,buttonIdArr,showDivId,activeId,className){
		 $.each(divIdArr,function(index,item){
			if(item == showDivId){
				$("#"+item).show();
			} else{
				$("#"+item).hide();
			}
		 });
		 $.each(buttonIdArr,function(index,item){
			 if(item == activeId){
				 $("#"+item).addClass(className);
			 } else{
				 $("#"+item).removeClass(className);
			 }
		 });
		 
	};
	
	exports.hour = null;
	exports.minute = null;
	exports.second = null;
	exports.timer = null;
	
	exports.countDownTimer=function(){
		hour = parseInt(exports.hour);
		minute = parseInt(exports.minute);
		second = parseInt(exports.second);
		if(second > 0){
			second --;
		}else if(second == 0){
			second = 59;
			if(minute > 0){
				minute --;
			}else{
				minute = 59;
				if(hour > 0){
					hour --;
				}else{ 
					second = 0;
					minute = 10;
					hour = 0;
					exports.queryNextPeriod();
					exports.timerEndTipDia();
				}
			}
		}else{
			console.info("----second count down too much");
			hour = 0;
			minute = 10;
			second = 0;
		}
		exports.hour = hour;
		exports.minute = minute;
		exports.second = second;
		exports.touZhuViewTimer(hour,minute,second);
	
	};
	
	exports.countDown=function(){
		exports.timer = setInterval(exports.countDownTimer, 1000);
	};
	exports.diaId = null;
	exports.timerEndTipDia = function(){
		var timeEndTip = $.trim($("#timeEndTip").val());
		if(timeEndTip=="1"){
			var nextPeriodStr = $.trim($("#nextPeriodStr").html());
			$("#singleButtonDiaText").html(nextPeriodStr+"期已经截止投注");
			$("#singleButtonDia").modal("show");
			exports.diaId = "singleButtonDia";
			setTimeout(exports.closeDia,3000);
		}
    	$("#pageRefresh").trigger("click");
	};
	exports.closeDia = function(){
		$("#"+exports.diaId).modal("hide");
	};
	exports.queryNextPeriod=function(){
		$.ajax({
			type:"GET",
			url:"/index.php/caipiaoNumber/queryNextPeriod",
			dataType:"JSON",
			cache:false,
			success:function(r){
				var nextPeriodStr = r.nextPeriodStr,
		    	 hour = r.hour, minute = r.minute, second = r.second;
		    	$("#nextPeriodStr").html(nextPeriodStr);
		    	$("#zhuiHaoTitleNextPeriod").html(nextPeriodStr);
		    	if($.trim(r.periodTimeList) != ""){
		    		$("#periodTimeList").val(r.periodTimeList);
		    		$("#periodTimeListRefresh").trigger("click");
		    	} 
		    	exports.hour = hour;
		    	exports.minute = minute;
		    	exports.second = second;
		    	clearInterval(exports.timer);
		    	exports.countDown();
			},
			error:function(xhr){
				$("#singleButtonDiaText").html("网络发生错误，请稍后重试");
				$("#singleButtonDia").modal("show");
			}
		});
	};
	exports.touZhuViewTimer=function(hour,minute,second){
		var  hourArr=[],minArr=[], secArr=[],timerStr;
		if(hour <= 9){
			hourArr[0] = 0;
			hourArr[1] = hour;
		}else{
			hour += "";
			hourArr=hour.split("");
		}
		if(minute <= 9){
			minArr[0] = 0;
			minArr[1] = minute;
		}else{
			minute += "";
			minArr=minute.split("");
		}
		if(second <= 9){
			secArr[0] = 0;
			secArr[1] = second;
		}else{
			second += "";
			secArr=second.split("");
		}
		$(".firHour").html(hourArr[0]);
		$(".secHour").html(hourArr[1]);
		$(".firMin").html(minArr[0]);
		$(".secMin").html(minArr[1]);
		$(".firSec").html(secArr[0]);
		$(".secSec").html(secArr[1]);
		timerStr = hourArr[0]+hourArr[1]+":"+minArr[0]+minArr[1]+":"+secArr[0]+secArr[1];
		$("#buttonTimer").html(timerStr);
		$("#zhuiHaoTitleTimer").html(timerStr);
	};
	exports.domainUrl = $.trim($("#domainUrl").val());
	exports.webSocketUrl = $.trim($("#webSocketUrl").val());
	 
	
	exports.wsCaipiaoNumber=function(userInfoFlag,todayNumberFlag,notViewNumberPattern){
		 var  esitmateWs = io.connect(exports.webSocketUrl+'/estimate');
		 esitmateWs.on('connect', function () {
		 });

		 esitmateWs.on('connect_error', function () {
			 console.info("ws连接失败，请稍后重试");
		 });
		 esitmateWs.on('disconnect', function () {
			 console.info("ws断开连接，请稍后重试");
		 });

		 esitmateWs.on('estimate', function (data) {
//			$("#singleButtonDiaText").html(data.msg);
//			$("#singleButtonDia").modal("show");
//			exports.diaId = "singleButtonDia";
//			setTimeout(exports.closeDia,3000);
			 $('#chatAudio')[0].play();
			if(userInfoFlag){
	    		exports.buildUserAccountInfo();
	    	}
			if(todayNumberFlag){
	    		exports.loadTodayNumber();
	    	}
	    	if(!notViewNumberPattern){
	    		exports.loadNubmerPattern();
	    		exports.toggleClass("active",exports.patternStatisticsDateArr,"today");
	    		exports.loadPatternStatistic();
	    	}
	    	$("#pageRefresh").trigger("click");
	    	$("#jhfaPageRefresh").trigger("click");
		  });

	};
	
	exports.buildUserAccountInfo=function(){
		$.ajax({
			url:"/userAccount/userInfo",
			async:false,
			dataType:"JSON",
			type:"GET",
			cache:false,
			success:function(r){
				if(r.success){
					var userAccount = r.userAccount;
					$("#userAccountContentUserName").html(userAccount.nickName);
					$("#userAccountContentDuanWei").html(userAccount.duanWei);
					$("#userAccountContentPoints").html(userAccount.pointsStr);
					$("#userAccountContentFreezePoints").html(userAccount.freezePointStr);
					$("#userAccountContentProfit").html(userAccount.profitStr);
					$("#userAccountContentWinRate").html(userAccount.winRateStr);
					$("#userAccountDuanWeiImg").attr("src",userAccount.duanWeiImgUrl);
					$("#leftPoints").val(userAccount.points);
					$("#refreshUserInfo").trigger("click");
				}
			},
			error:function(xhr){
				var status = xhr.status;
				if(status=="403"){
					$("#checkCodeImg").trigger("click");
					$("#loginContentDiv").show();
					$("#userAccountContentDiv").hide();
				}
			}
		});
	};
	
	exports.buildNumberPattern = function(data){
		$("#numberPatternPeriod").html(data.currentPeriod);
		var numberBuilder = new StringBuilder();
		if($.trim(data.currentNumberArr) != ""){
			$.each(data.currentNumberArr,function(index,item){
				numberBuilder.append("<li>");
				numberBuilder.append(item);
				numberBuilder.append("</li>");
			});
		}
		$("#numberPatternNumber").html(numberBuilder.toString());
		$("#numberPatternKaiCount").html(data.kaiCount);
		$("#numberPatternWeiKaiCount").html(data.weiKaiCount);
		
		var patternBuilder = new StringBuilder();
		
		if($.trim(data.numberPatternList) != ""){
			$.each(data.numberPatternList,function(index,item){
				patternBuilder.append('<tr>');
				patternBuilder.append('<td>'+item.period+'</td>');
				patternBuilder.append('<td class="numberPatternHouSanDiv contentClass space">'+item.houSanNumberPrev+'<span class="color_Main space">'+item.houSanNumberNext+'</span></td>');
				patternBuilder.append('<td class="numberPatternHouErDiv contentClass" style="display:none;">'+item.houErNumberPrev+'<span class="color_Main">'+item.houErNumberNext+'</span></td>');
				patternBuilder.append('<td colspan="3" class="table_span contentClass numberPatternHouSanDiv">');
				if(item.qianSanPattern == "组三"){
					patternBuilder.append('<span class="color_Main">'+item.qianSanPattern+'</span>');
				}else if(item.qianSanPattern == "豹子"){
					patternBuilder.append('<span class="baozi">'+item.qianSanPattern+'</span>');
				}else{
					patternBuilder.append('<span class="zuliu">'+item.qianSanPattern+'</span>');
				}
				if(item.zhongSanPattern == "组三"){
					patternBuilder.append('<span class="color_Main">'+item.zhongSanPattern+'</span>');
				}else if(item.zhongSanPattern == "豹子"){
					patternBuilder.append('<span class="baozi">'+item.zhongSanPattern+'</span>');
				}else{
					patternBuilder.append('<span class="zuliu">'+item.zhongSanPattern+'</span>');
				}
				if(item.houSanPattern == "组三"){
					patternBuilder.append('<span class="color_Main">'+item.houSanPattern+'</span>');
				}else if(item.houSanPattern == "豹子"){
					patternBuilder.append('<span class="baozi">'+item.houSanPattern+'</span>');
				}else{
					patternBuilder.append('<span class="zuliu">'+item.houSanPattern+'</span>');
				}

				patternBuilder.append('</td>');
				patternBuilder.append('<td colspan="3" class="table_span contentClass  numberPatternHouErDiv" style="display:none;">');
				
				if(item.houErPattern=="连号"){
					patternBuilder.append('<span class="lianhao">'+item.houErPattern+'</span>');
				}else if(item.houErPattern=="对子"){
					patternBuilder.append('<span class="duizi">'+item.houErPattern+'</span>');
				}else{
					patternBuilder.append('<span></span>');
				}
				patternBuilder.append('<span>'+item.houErShi+'</span>');
				patternBuilder.append('<span>'+item.houErGe+'</span>');
				patternBuilder.append('</td>');
				patternBuilder.append('</tr>');
			});
			$("#numberPatternBody").html(patternBuilder.toString());
			exports.initialNumberPatternToggle();
		}
		
		
	};
	exports.initialNumberPatternToggle=function(){
		$("#numberPatternHouSan,#numberPatternHouEr").click(function(){
			$("#numberPatternHouSan").removeClass("active");
			$("#numberPatternHouEr").removeClass("active");
			$(this).toggleClass("active");
			var contentClass = $(this).attr("contentClass");
			$("#numberPatternHouSanTitle").hide();
			$("#numberPatternHouErTitle").hide();
			$("#"+$(this).attr("title")).show();
			
			$("#numberPatternBody").find("td").each(function(index,item){
				if($(this).hasClass("contentClass")){
					$(this).hide();
				}
				if($(this).hasClass(contentClass)){
					$(this).show();
				}
			});
		});
		
	};
	exports.buildPatternStatistics=function(r){
		 var obj = r.resultMap;
		 var firstThreePattern = obj.firstThreePattern;
		 var firstSixPattern = obj.firstSixPattern;
		 var firstSamePattern = obj.firstSamePattern;
		 var midThreePattern = obj.midThreePattern;
		 var midSixPattern = obj.midSixPattern;
		 var midSamePattern = obj.midSamePattern;
		 var lastThreePattern = obj.lastThreePattern;
		 var lastSixPattern = obj.lastSixPattern;
		 var lastSamePattern = obj.lastSamePattern;
	    $('#numberPatternStatistics').highcharts({                                           
	        chart: {   type: 'bar'  },                                                                 
	        title: {   text: '统计以下几种形态出现多少次' },                                                                 
	        xAxis: {    categories: ['前三组三', '前三组六 ', '前三豹子', '中三组三', '中三组六','中三豹子','后三组三','后三组六','后三豹子'], title: {   text: null  }   },                                                                 
	        yAxis: {    min: 0,  title: {   text: '',   align: 'high'  }, labels: { overflow: 'justify' }  },                                                                 
	        tooltip: {  valueSuffix: ' 次' },                                                                 
	        plotOptions: {   bar: { dataLabels: {   enabled: true   }  }, series: { colorByPoint: true, color:"#ef0404" } },                                                                 
	        credits: {   enabled: false },                                                                 
	        series: [{   name:"出现次数", data: [firstThreePattern,firstSixPattern,firstSamePattern,midThreePattern,midSixPattern,midSamePattern,lastThreePattern,lastSixPattern,lastSamePattern]  } ]                                                                 
	    });   
	};
	exports.loadNubmerPattern=function(){
		$.ajax({
			url:"/index.php/caipiaoNumber/numberPattern",
			async:true,
			dataType:"JSON",
			type:"GET",
			cache:false,
			success:function(r){
				if(r.success){
					exports.buildNumberPattern(r);
				} 
			} ,
			error:function(){
				console.info("----loadNubmerPattern-----");
			}
		});
	};
	
	exports.loadPatternStatistic=function(){
		$.ajax({
			url:"/index.php/caipiaoNumber/patternStatistics",
			async:true,
			dataType:"JSON",
			type:"GET",
			data:{
				dateStr:exports.patternStatisticsDateStr
			},
			success:function(r){
				if(r.success){
					exports.buildPatternStatistics(r);
				}else{
					$("#numberPatternStatistics").html("");
				}
			},
			error:function(){
				console.info("----loadPatternStatistic-----");
			}
		});
	};
	
	exports.loadTodayNumber=function(){
		$.ajax({
			url : "/index.php/historyNumber/loadTodayNumber",
			dataType : "JSON",
			async : true,
			success : function(r) {
				if (r.success) {
					var itemLast = null;
					var lastThreePattern = null;
					$.each(r.historyNumberList, function(index, item) {
						$("#todayNumber" + item.item).html(item.number);//号码
						lastThreePattern = item.lastThreePattern;//形态:组三、组六、豹子
						if(lastThreePattern == "组三"){
							$("#todayPattern" + item.item).html("<lable style='color: #f35e1b;'>"+lastThreePattern+"</label>");
 						}else if(lastThreePattern == "组六"){
							$("#todayPattern" + item.item).html(lastThreePattern);
						}else{//豹子
							$("#todayPattern" + item.item).html("<lable style='color: #63a72a;'>"+lastThreePattern+"</label>");
						}
						itemLast = item.item;
					});
					 
					itemLast = parseInt(itemLast) + 1;
					var item = null;
					for(var i = 0; i < itemLast; i++){
						var result = parseInt(i);
						if (result < 10) {
							item = "00" + result;
						} else if (result < 100) {
							item = "0" + result;
						} else {
							item = result + "";
						}
						if($.trim($("#todayNumber" + item).html())==""){
							$("#todayNumber" + item).html("等待开奖");
							$("#todayPattern" + item.item).html("");
						}
					}
					
					for(var i = itemLast; i <= 120; i++){
						var result = parseInt(i);
						if (result < 10) {
							item = "00" + result;
						} else if (result < 100) {
							item = "0" + result;
						} else {
							item = result + "";
						}
						$("#todayNumber" + item).html("");
					}
					 
				} else {
					alert("服务器忙，请稍后重试");
				}
			},
			error : function(xhr) {
				console.info("服务器忙，请稍后重试");
			}
		});
	};
	
	exports.formatItem = function(num){
		num = parseInt(num);
		if(num <= 9){
			num = "00"+num;
		}
		if(num >9 && num < 100){
			num = "0"+num;
		}
		return num;
	};
	
	$(function(){
		if($.trim($("#nextPeriodStr").html())!=""){
			window.addEventListener('focus', function() {
				exports.queryNextPeriod();
			},false);
		}
		
		if($.trim($("#uniqueLogin").val())=="true"){
			var ws = new WebSocket("ws://"+$.trim($("#globalDomainUrl").val())+"/loginStatus");
			ws.onopen = function () {
			};
			ws.onmessage = function (event) {
				$("#singleButtonDiaText").html(event.data);
				$("#singleButtonDia").modal("show");
				$("#singleDiaButton,#singleButtonDiaClose").click(function(){
					window.location.reload();
				});
			};
			ws.onclose = function (event) {
			};
		}
		
		$('#singleButtonDia').modal({
			show: false,
			backdrop: 'static'
		});
		$('#doubleButtonDia').modal({
			show: false,
			backdrop: 'static'
		});
		
		//导航栏鼠标移上去的效果
		var dhlChild=$(".nav-parents li a");
		dhlChild.mouseover(function(){
			var nowChild=$(this);
			if(!nowChild.is('.active')){
				$(this).addClass("hoverStyle");
			}
		});
		dhlChild.mouseout(function(){
			$(this).removeClass("hoverStyle");
		});
		
		//出错页面按钮鼠标移上去的特效
		var errorBtn=$(".error5 button");
		errorBtn.mouseover(function(){
			$(this).css("opacity",".8");
		});
		errorBtn.mouseout(function(){
			$(this).css("opacity","1");
		});
		
		$.each(exports.patternStatisticsDateArr,function(index,item){
			$("#"+item).click(function(){
				var dateStr = $(this).attr("attr");
				exports.patternStatisticsDateStr = dateStr;
				exports.toggleClass("active",exports.patternStatisticsDateArr,dateStr);
				exports.loadPatternStatistic();
			});
		});
		
		//弹出框弹出关闭之后body出现padding-right的解决方式
		$('.modal').on('hidden.bs.modal', function () {
			$("body").css("padding","0px");
		});
		 $('<audio id="chatAudio"><source src="/static/audio/kai-jiang.wav" type="audio/wav"> </audio>').appendTo('body');
		
		 $("#shoucang").click(function(){
			 $("#singleButtonDiaText").html("请使用Ctrl+D把彩票小助手加入收藏夹");
			 $("#singleButtonDia").modal("show");
		});
	});
	//弹出登录框
	exports.loginDialog = function(options){
		exports.initGeetest(true);
		var loginModal = $("#myModal_login");
		loginModal.find("#login-form img").trigger("click");
		loginModal.modal(options);
	};
	//获取邮箱地址
	exports.emailUrl = function(){
		var emailUrl = {};
		emailUrl["@qq.com"] = "http://mail.qq.com";
		emailUrl["@163.com"] = "http://mail.163.com";
		emailUrl["@139.com"] = "http://mail.10086.cn";
		emailUrl["@sohu.com"] = "http://mail.sohu.com";
		emailUrl["@126.com"] = "http://www.126.com";
		emailUrl["@yeah.net"] = "http://www.yeah.net";
		emailUrl["@gmail.com"] = "http://mail.google.com";
		emailUrl["@outlook.com"] = "http://www.outlook.com";
		emailUrl["@yahoo.com"] = "https://login.yahoo.com";
		emailUrl["@sina.com"] = "https://mail.sina.com.cn";
		return emailUrl;
	};
	
	exports.captchaObj = null;
	exports.handlerEmbed = function(captchaObj){
		exports.captchaObj = captchaObj;
		$("#embed-captcha").empty();
		captchaObj.appendTo("#embed-captcha");
		
        captchaObj.onReady(function () {
           $("#wait")[0].className = "hide";
           $(".gt_help_button").remove();
           $(".gt_logo_button").remove();
        });
	};
	
	exports.handlerEmbedDialog = function(captchaObj){
		exports.captchaObj = captchaObj;
		$("#embed-captchaDialog").empty();
		captchaObj.appendTo("#embed-captchaDialog");
		
		captchaObj.onReady(function () {
			$("#waitDialog")[0].className = "hide";
			$(".gt_help_button").remove();
			$(".gt_logo_button").remove();
		});
	};
	
	exports.initGeetest = function(loginDialog){
		$.ajax({
			url: "/index.php/verify/loginGeetest?t=" + (new Date()).getTime(),
			type: "post",
	        dataType: "json",
	        success: function (data) {
	        	if(loginDialog){
	        		if(!data.success){
	        			$("#checkCodeDialogDIV").show();
	        			$("#jiyanDialogDIV").hide();
	        			return false;
	        		}
	        		data = data.result;
	        		initGeetest({
	        			gt: data.gt,
	        			challenge: data.challenge,
	        			product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
	        			offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
	        		}, exports.handlerEmbedDialog);
	        		
	        		
	        	}else{
	        		if(!data.success){
	        			$("#checkCodeDIV").show();
	        			$("#jiyanDIV").hide();
	        			return false;
	        		}
	        		data = data.result;
	        		initGeetest({
	        			gt: data.gt,
	        			challenge: data.challenge,
	        			product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
	        			offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
	        		}, exports.handlerEmbed);
	        	}
	        	
	        }
		});
	};
	
});


window.confirm=function showConfirm(text, callback) {
	$("#doubleButtonDiaText").html("").html(text);
	$('#doubleButtonDia').modal('show');
	$("#doubleDiaSecondButton").unbind();
	if(callback != null){
		$("#doubleDiaFirstButton").unbind();
		$("#doubleDiaFirstButton").bind("click",callback);
	}
};
window.alert=function showConfirm(text,callBack) {	
	$("#singleButtonDiaText").html("").html(text);
	$('#singleButtonDia').modal('show');
	if(callBack!=null){
		$("#singleDiaButton").unbind();
		$("#singleDiaButton").bind("click",callBack);
	}
};