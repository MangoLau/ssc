define(function(require,exports,module){
	var global = require("global");
	require("resPath/scroll/perfect-scrollbar/js/perfect-scrollbar");
	require("resPath/scroll/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min");
	require("resPath/highchart/highcharts");
	require("resPath/bigDecimal/BigDecimal");
	require("resPath/jquery.cookie/jquery.cookie.js");
	require("funPath/account/login");
	exports.hour=$.trim($("#hour").val());
	exports.minute=$.trim($("#minute").val());
	exports.second=$.trim($("#second").val());
	exports.domainUrl = $("#domainUrl").val();
	exports.jhfaTitleBar = ["jhfaDingWei","jhfaBuDingWei","jhfaZuXuan","jhfaZhiXuan","jhfaSiXing","jhfaWuXing"];
	exports.jhfaSearchBar = ["jhfaDingWei_Condition","jhfaBuDingWei_Condition","jhfaZuXuan_Condition","jhfaZhiXuan_Condition","jhfaSiXing_Condition","jhfaWuXing_Condition"];
	exports.searchCondition = "dw";
	exports.jhfaCaiPiaoType = null;
	exports.doubleRegex = /^[-\+]?\d+(\.\d+)?$/;
	exports.doubleRegExp = /^\d{1,6}(\.\d{1,3})?$/;
	exports.doubleYieldRegExp = /^\d{1,3}(\.\d{1,3})?$/;
	exports.jhfaSelect = function(){
		$("#jhfaSelect").click(function(){
			var xuanze=$(this);
			if(xuanze.is('.down')){
				$("#jhfaSelect").removeClass("down");
				$(this).parent().next().css("display","none");
			}else{
				$("#jhfaSelect").addClass("down");
				$(this).parent().next().css("display","block");
			}
		});
		var jhfaBtn=$(".jhfa1b .shengcheng");
		jhfaBtn.mouseover(function(){
			$(this).css("opacity",".8");
		});
		jhfaBtn.mouseout(function(){
			$(this).css("opacity","1");
		});
	};
	exports.validateSalary = function(pricipal){
		 if(!exports.doubleRegExp.test(pricipal)){
			 alert("濂栭噾鐢辨暟瀛楃粍鎴愶紝鏁存暟鏈€闀夸负6浣嶆暟瀛楋紝灏忔暟鐐瑰悗鏈€澶�3浣嶆暟瀛�");
			 return false;
		 }
		return true; 
	};
	exports.validateYieldRate = function(yeildRate){
		if(!exports.doubleYieldRegExp.test(yeildRate)){
			alert("鏀剁泭鐜囩敱鏁板瓧缁勬垚锛屾暣鏁版渶闀夸负3浣嶆暟瀛楋紝灏忔暟鐐瑰悗鏈€澶氭湁3浣嶆暟瀛�");
			return false;
		}
		return true;
	};
	exports.validateBeginTimes = function(beginTimes){
		var numRegExp = /^\d+$/;
		if(parseInt(beginTimes) <= 0){
			alert("璧峰鍊嶆暟瑕佸ぇ浜�0");
			return false;
		}
		if(!numRegExp.test(beginTimes)){
			alert("璧峰鍊嶆暟涓烘暣鏁�");
			return false;
		}
		if(beginTimes.length > 4){
			alert("璧峰鍊嶆暟鏈€闀夸负4浣�");
			return false;
		}
		return true;
	};
	exports.jhfaTitelSwitch = function(){
		$("#jhfaType > li").on("click",function(){
			var obj = $(this);
			exports.searchCondition = obj.attr("condition");
			var titleId = obj.attr("id");
			var searchId = titleId+"_Condition";
			global.toggleClass("active",exports.jhfaTitleBar,titleId);
			$.each(exports.jhfaSearchBar,function(index,item){
				if(searchId == item){
					$("#"+item).show();
				}else{
					$("#"+item).hide();
				}
			});
			exports.loadJhfaDetail();
			exports.loadJhfaOmission();
		});
	};
	exports.jumpLocation = function(){
		var loc = $.trim($("#location").val());
		var wei = $.trim($("#wei").val());
		if(loc || wei){
			if(loc){
				var lis = $("#jhfaType > li");
				loc = loc+"璁″垝";
				$.each(lis,function(index,obj){
					var li  = $(obj);
					if(li.text() == loc){
						exports.searchCondition = li.attr("condition");
						var titleId = li.attr("id");
						var searchId = titleId+"_Condition";
						global.toggleClass("active",exports.jhfaTitleBar,titleId);
						$.each(exports.jhfaSearchBar,function(index,item){
							if(searchId == item){
								$("#"+item).show();
							}else{
								$("#"+item).hide();
							}
						});
						if(wei){
							$("#" + exports.searchCondition + "jhfawei").val(wei).trigger("change");
						}
						return false;
					}
				});
				exports.loadJhfaDetail();
			}else{
				exports.loadJhfaDetail();
			}
		}else{
			exports.loadJhfaDetail();
		}
		exports.loadJhfaOmission();
	};
	exports.loadJhfaOmission=function(){
		var searchCondition = $.trim(exports.searchCondition);
		$.ajax({
			url:'/jhfa/omission',
			async:true,
			cache:false,
			data:{
				"condition":searchCondition,
				"jhfawei":$.trim($("#" + searchCondition + "jhfawei").val())
			},
			dataType:'JSON',
			type:'GET',
			success:function(r){
				 if(r.success){
					 var currentOmissionList = r.currentOmissionList,
					  historyOmissionList = r.historyOmissionList,
					  maxCurrentOmission = r.maxCurrentOmission,
					  maxHistoryOmission = r.maxHistoryOmission,
					  buffer = new StringBuilder(),
					  coldNum = null;
					 $.each(currentOmissionList,function(index,item){
						 if(item == maxCurrentOmission){
							 buffer.append("<li class='active'>"+item+"</li>");
							 if(r.coldNumber){
								 coldNum=r.coldNumber;
							 }else{
								 coldNum=index;
							 }
						 }else{
							 buffer.append("<li>"+item+"</li>");
						 }
					 });
					 $("#curOmission").html(buffer.toString());
					 
					 buffer = new StringBuilder();
					 $.each(historyOmissionList,function(index,item){
						 if(item == maxHistoryOmission){
							 buffer.append("<li class='active'>"+item+"</li>");
						 }else{
							 buffer.append("<li>"+item+"</li>");
						 }
					 });
					 $("#histroyOmission").html(buffer.toString());
					 $("#jhfaColdNum").html(coldNum);
					 $("#curColdNum").html(coldNum);
					 var jhfaWeiName = $.trim($("#" + exports.searchCondition + "jhfawei").children("option:checked").text());
					 if(jhfaWeiName.length==4){
						 jhfaWeiName = jhfaWeiName.substring(0,2);
					 }
					 $("#omissionType").html(jhfaWeiName);
				 }else{
					 $("#singleButtonDiaText").html("鏈嶅姟鍣ㄥ繖锛岃绋嶅悗閲嶈瘯");
					 $("#singleButtonDia").modal("show");
				 }
			},
			error:function(xhr){
				 $("#singleButtonDiaText").html("鏈嶅姟鍣ㄥ繖锛岃绋嶅悗閲嶈瘯");
				 $("#singleButtonDia").modal("show");
			}
		});
	};
	exports.loadFavorite=function(){
		
	};
	exports.clickScanHistory=function(){
		var jhfaName=null,jhfaCode=null;
		$(".jhfaScanHistory").click(function(index,item){
			jhfaName=$.trim($(this).text());
			jhfaCode=$.trim($(this).attr("jhfacode"));
			if(jhfaCode != ""){
				exports.loadJhfaDetail(jhfaCode);
			}else{
				exports.loadJhfaDetail(jhfaName);
			}
		});
	};
	exports.loadScanHistroy=function(){
		var jhfawei = null, jhfadanmaCount = null, jhfazhuiqiCount = null, salary = null,
		yeildRate = null,  salaryBool = null,   searchCondition = exports.searchCondition,
		times = null;
		times = $.trim($("#"+searchCondition+"StartTimes").val());
		var timesBool = exports.validateBeginTimes(times);
		if(!timesBool){
			return false;
		}
		salary = $.trim($("#" + searchCondition + "Salary").val());
		yeildRate = $.trim($("#" + searchCondition + "Yield").val());
		jhfawei = $.trim($("#" + searchCondition + "jhfawei").val());
		jhfadanmaCount = $.trim($("#" + searchCondition + "jhfadanmaCount").val());
		jhfazhuiqiCount = $.trim($("#" + searchCondition + "jhfazhuiqiCount").val());
		salaryBool = exports.validateSalary(salary);
		yieldRateBool = exports.validateYieldRate(yeildRate);
		pattern = $.trim($("#" + searchCondition + "Pattern").val());
		if(!salaryBool){
			return false;
		}
		if(!yieldRateBool){
			return false;
		}
		$.ajax({
			url:'/jhfaScanHistory/loadScanHistory',
			async:true,
			cache:false,
			data:{
				"searchCondition":searchCondition,
				"jhfawei":jhfawei,
				"jhfadanmaCount":jhfadanmaCount,
				"jhfazhuiqiCount":jhfazhuiqiCount,
				"salary":salary,
				"yeildRate":yeildRate,
				"category":"jingPin",
				"times":times
			},
			dataType:'JSON',
			type:'GET',
			success:function(r){
				if(r.success){
					var jhfaNameList = r.jhfaNameList,
					buffer = new StringBuilder();
					$.each(jhfaNameList,function(index,item){
						buffer.append('<li class="clearfix jhfaScanHistory" jhfacode='+$.trim(item.value)+'>'+item.key+'</li>');
					});
					$("#myJhfaScanHistory").html(buffer.toString());
					exports.clickScanHistory();
				} 
			},
			error:function(xhr){
				var status = xhr.status;
				if(status=="403"){
					global.loginDialog();
				}else{
					 $("#singleButtonDiaText").html("鏈嶅姟鍣ㄥ繖锛岃绋嶅悗閲嶈瘯");
					 $("#singleButtonDia").modal("show");
				 }
			}
		});
	};
	exports.jhfaNumberHover=function(){
		$(".jhfaNumberHover").hover(function(){
			$("#jhfaNumberHoverDiv").html($(this).html());
			$("#jhfaNumberHoverDiv").show();
		},function(){
			$("#jhfaNumberHoverDiv").html("");
			$("#jhfaNumberHoverDiv").hide();
		});
	};
	exports.loadJhfaPlanLayer = null;
	exports.goToTouZhu=function(){
		$("#goToTouZhu").click(function(){
			var searchCondition = exports.searchCondition,
			number = $.trim($(this).attr("number")),
			salary = $.trim($("#" + searchCondition + "Salary").val()),
			yeildRate = $.trim($("#" + searchCondition + "Yield").val()),
			wei = $.trim($("#" + searchCondition + "jhfawei").val()),
			jhfazhuiqiCount = $.trim($("#" + searchCondition + "jhfazhuiqiCount").val()),
			times = $.trim($("#"+searchCondition+"StartTimes").val());
			$("#touZhuWei").val(wei);
			$("#condition").val(searchCondition);
			$("#tzNumber").val(number);
			$("#salary").val(salary);
			$("#yeildRate").val(yeildRate);
			$("#qiShu").val(jhfazhuiqiCount);
			$("#times").val(times);
			$("#goToTouZhuForm").submit();
		});
	};
	
	exports.loadJhfaDetail = function(jhfaName){
		var jhfawei = null, jhfadanmaCount = null, jhfazhuiqiCount = null, salary = null,
		yeildRate = null,  salaryBool = null, jhfaPlanType = null, searchCondition = exports.searchCondition,
		times = null, activity = null,pattern = null,sort=null,timesBool=null;
		times = $.trim($("#"+searchCondition+"StartTimes").val());
		timesBool = exports.validateBeginTimes(times);
		if(!timesBool){
			return false;
		}
		salary = $.trim($("#" + searchCondition + "Salary").val());
		yeildRate = $.trim($("#" + searchCondition + "Yield").val());
		jhfawei = $.trim($("#" + searchCondition + "jhfawei").val());
		jhfadanmaCount = $.trim($("#" + searchCondition + "jhfadanmaCount").val());
		jhfazhuiqiCount = $.trim($("#" + searchCondition + "jhfazhuiqiCount").val());
		salaryBool = exports.validateSalary(salary);
		yieldRateBool = exports.validateYieldRate(yeildRate);
		activity = $.trim($("#activity").val());
		jhfaPlanType = $.trim($("#jhfaPlanType").val());
		pattern = $.trim($("#" + searchCondition + "Pattern").val());
		if(!salaryBool){
			return false;
		}
		if(!yieldRateBool){
			return false;
		}
		if(!jhfaPlanType){
			jhfaPlanType = "0";
		}
		jhfaName = $.trim(jhfaName);
		if(jhfaName == ""){
			jhfaName = $.cookie(exports.searchCondition+"JhfaPlanName");
		}
		sort=$.trim($.cookie("sort"));
		$.ajax({
			url:'/jhfa/jhfaPlan',
			async:true,
			cache:false,
			data:{
				"condition":searchCondition,
				"jhfaPlanType":jhfaPlanType,
				"type":exports.jhfaCaiPiaoType,
				"jhfawei":jhfawei,
				"jhfadanmaCount":jhfadanmaCount,
				"jhfazhuiqiCount":jhfazhuiqiCount,
				"times":times,
				"bonus":salary,
				"yeildRate":yeildRate,
				"activity":activity,
				"pattern":pattern,
				"jhfaName":jhfaName,
				"sort":sort
			},
			dataType:'JSON',
			type:'GET',
			beforeSend:function(){
    			exports.loadJhfaPlanLayer = layer.load(0, {shade : false}); 
			},
			success:function(d){
				if(d.success){
					$("#jhfaPlanType").val("0");
					var nameList = d.expressionName,
					 fvList = d.fvList,
					 btjsCanntReach = d.btjsCanntReach,
					 btjsResultList = d.btjsResultList,
					 resultList = d.resultList,
					 buffer = new StringBuilder();
					buffer.append("<tr>");
					buffer.append("<th class='th01'>鏈熸暟</th>");
					buffer.append("<th class='th01'>涓鍙风爜</th>");
					buffer.append("<th class='th02'>鍊嶆暟/鏈湡鎶曞叆</th>");
					buffer.append("<th>璁″垝鍙风爜</th>");
					buffer.append("<th class='th01'>鐘舵€�</th>");
					buffer.append("</tr>");
					buffer.append("<tr>");
						buffer.append("<td colspan='5' class='padding-no'>");
							buffer.append("<div class='newest clearfix'>");
								buffer.append("<div class='div-one'>");
									buffer.append("<ul>");
									$.each(fvList,function(index,obj){
										buffer.append("<li>"+obj.item+"</li>");
									});
									buffer.append("</ul>");
								buffer.append("</div>");
							buffer.append("<div class='div-one'>");
								buffer.append("<ul>");
									$.each(fvList,function(index,obj){
										if($.trim(obj.result) == ""){
											buffer.append("<li>绛夊緟寮€濂�</li>");
										}else{
											buffer.append("<li>"+obj.result+"</li>");
										}
									});
								buffer.append("</ul>");
							buffer.append("</div>");
							buffer.append("<div class='div-two'>");
								buffer.append("<ul>");
								if(!btjsCanntReach){
									$.each(btjsResultList,function(index,obj){
										buffer.append("<li>"+obj.times+"鍊�/"+new BigDecimal(obj.currentAmount).setScale(3, BigDecimal.ROUND_HALF_UP).toString()+"鍏�</li>");
									});
								}else{
									for(var i = 0 ; i < jhfazhuiqiCount;i++){
										buffer.append("<li>鏀剁泭鐜囨棤娉曡揪鍒�</li>");
									}
								}
								buffer.append("</ul>");
						    buffer.append("</div>");
						    buffer.append("<div class='div-three' style='line-height:"+((jhfazhuiqiCount*40)+10)+"px'>");
						    var firstNumber=null;
						    	if(d.notloginBool){
						    		var url = "http://"+exports.domainUrl+"/jhfa/excellentPlan?loc="+$.trim($("#location").val())+"&wei="+jhfawei+"&id="+jhfaPlanType;
									url = encodeURIComponent(url);
									var passportUrl = exports.domainUrl.substring(exports.domainUrl.indexOf("."));
									buffer.append("<span><a href = 'http://passport"+passportUrl+"/login?returnUrl="+url+"' target='_blank'>鐧诲綍</a>鍚庢墠鍙互鐪嬪埌鍙风爜</span>");
						    	}else if(d.inactiveBool){
						    		buffer.append("<span><a href='http://"+exports.domainUrl+"/order'>寮€閫氫粯璐逛細鍛�</a>鍚庢墠鍙互鐪嬪埌鍙风爜</span>");
							    	}else{
						    		if(searchCondition == "zhx" || searchCondition == "wux" || searchCondition == "sis"){
						    			firstNumber = d.firstPlanResult;
						    			buffer.append("<span class='arge-margin perfectScoll jhfaNumberHover'>"+firstNumber+"</span>");
						    		}else{
						    			firstNumber=d.firstPlanResult.split("").sort().join("");
						    			buffer.append("<span class='arge-margin jhfaNumberHover'>"+firstNumber+"</span>");
						    		}
						    	}
							buffer.append("</div>");
							firstNumber=$.trim(firstNumber);
							if(firstNumber!=""){
							//	buffer.append("<div class='div-four' style='line-height:"+((jhfazhuiqiCount*40)+10)+"px'><span class='smoking'><a href='javascript:void(0);' class='goTouzhu' number='"+firstNumber+"' id='goToTouZhu'><strong>鍘绘姇娉�</strong></a><a href='javascript:void(0);' class='goTouzhu qutZ' id='goToGame'><strong>鍘绘寫鎴�</strong></a></span></div>");
								buffer.append("<div class='div-four' style='line-height:"+((jhfazhuiqiCount*40)+10)+"px'><span class='smoking'><a href='javascript:void(0);' class='goTouzhu' number='"+firstNumber+"' id='goToTouZhu'><strong>鍘绘姇娉�</strong></a></span></div>");
							}else{
								buffer.append("<div class='div-four' style='line-height:"+((jhfazhuiqiCount*40)+10)+"px'>姝ｅ湪鎶曟敞</div>");
							}
					    buffer.append("</div>");
					buffer.append("</td>");
				buffer.append("</tr>");
				
				var activeStatus = null,planNumber = null;
				if(resultList){
					$.each(resultList,function(index,obj){
						if(searchCondition == "zhx" || searchCondition == "wux" || searchCondition == "sis"){
							planNumber = obj.planNum;
						}else{
							planNumber = obj.planNum.split("").sort().join("");
						}
						activeStatus = obj.itemIndex;
						buffer.append("<tr>");
						buffer.append("<td colspan='5' class='padding-no'>");
							buffer.append("<div class='panel panel-default'>");
							   buffer.append("<div class='panel-heading' id='clickObjId"+index+"'  value='"+activeStatus+"' wei='"+obj.wei+"' planNubmer='"+planNumber+"'>");
								 buffer.append("<h4 class='panel-title'>");
									buffer.append("<a data-toggle='collapse' data-parent='#accordion' href='#selet"+index+"' aria-expanded='true' class='clearfix collapsed'>");
												buffer.append("<span class='span-one span-bg-select'>"+obj.item+"</span>");
												buffer.append("<span class='span-one'>"+obj.resultNumber+"</span>");
											if(d.btjsCanntReach){
												buffer.append("<span class='span-two'>鏀剁泭鐜囨棤娉曡揪鍒�</span>");
											}else{
												if(exports.doubleRegex.test(obj.amount)){
													buffer.append("<span class='span-two text-left'>鐩堝埄锛�"+obj.amount.toFixed(3)+"鍏�</span>");
												}else{
													buffer.append("<span class='span-two text-left'>鐩堝埄锛�"+obj.amount+"鍏�</span>");
												}
											}
												buffer.append("<span class='span-three arge-margin perfectScoll jhfaNumberHover'>"+planNumber+"</span>");
											if(obj.status){
												buffer.append("<span class='span-four'><em class='zhongjiang'>涓</em></span>");
											}else{
												buffer.append("<span class='span-four'><em class='wzj'>鏈腑濂�</em></span>");
											}
									buffer.append("</a>");
								 buffer.append("</h4>");
							   buffer.append("</div>");
							buffer.append("<div id='selet"+index+"' class='panel-collapse collapse' aria-expanded='true'>");
								buffer.append("<div class='panel-body'>");
									buffer.append("<div class='select-body'>");
									$.each(obj.caipiaoList,function(index,result){
										item = result.period;
										item = JSON.stringify(item).substring(8);
										number = result.result;
										buffer.append("<ul class='list-inline clearfix'>");
										buffer.append("<li class='li-one'>"+item+"</li>");
										buffer.append("<li class='li-one'>"+number+"</li>");
										buffer.append("<li class='li-two'></li>");
										buffer.append("<li class='li-three arge-margin perfectScoll'></li>");
										if(obj.status){
											if(index != 0){
												buffer.append("<li class='li-four color_main'>鏈腑濂�</li>");
											}else{
												buffer.append("<li class='li-four color_main'>涓</li>");
											}
										}else{
											buffer.append("<li class='li-four wzj'>鏈腑濂�</li>");
										}
									buffer.append("</ul>");
									});
									buffer.append("</div>");
								buffer.append("</div>");
							buffer.append("</div>");
						buffer.append("</div>");
					buffer.append("</td>");
				 buffer.append("</tr>");
					});
				}
			$("#jhfaContent").html(buffer.toString());
			$(".arge-margin").perfectScrollbar();	
			var expressionNotLookBool = d.expressionNotLookBool;
			if(nameList){
//				clearInterval(exports.toggleTipInterval);
				buffer = new StringBuilder();
				$.each(nameList,function(index,obj){ 
					if(!expressionNotLookBool){
						if(obj.curBool){
							buffer.append('<li class="active" jhfaname="'+obj.jhfaName+'" jhfacode="'+obj.jhfaCode+'">');
							$.cookie(exports.searchCondition+"JhfaPlanName",obj.jhfaCode,{expires:30});
							$("#curPlanName").html("褰撳墠璁″垝锛�"+obj.jhfaName);
							$("#planMsgError").html("閿欒鏁帮細"+obj.errorCount);
							$("#planMsgPercent").html("鍑嗙‘鐜囷細"+obj.winRate+"%");
							$("#planMsgProfit").html("鍏变负浣犵泩鍒╋細"+$.trim(obj.profit)+"鍏�");
						}else{
							buffer.append('<li class="clearfix" jhfaname="'+obj.jhfaName+'" jhfacode="'+obj.jhfaCode+'">');
						}
					}else{
						if(index == 0){
							buffer.append('<li class="active clearfix" jhfaname="'+obj.jhfaName+'"  jhfacode="'+obj.jhfaCode+'">');
							$.cookie(exports.searchCondition+"JhfaPlanName",obj.jhfaCode,{expires:30});
							$("#curPlanName").html("褰撳墠璁″垝锛�"+obj.jhfaName);
							$("#planMsgError").html("閿欒鏁帮細"+obj.errorCount);
							$("#planMsgPercent").html("鍑嗙‘鐜囷細"+obj.winRate+"%");
							$("#planMsgProfit").html("鍏变负浣犵泩鍒╋細"+$.trim(obj.profit)+"鍏�");
						}else{
							buffer.append('<li class="clearfix" jhfaname="'+obj.jhfaName+'"  jhfacode="'+obj.jhfaCode+'">');
						}
					}
					buffer.append('<span class="first" >'+$.trim(obj.jhfaName)+'</span>');
					buffer.append('<span class="last">'+$.trim(obj.winRate)+'%</span>');
					/*buffer.append('<span class="soucang" title="鐐瑰嚮鏀惰棌"></span>');*/
					buffer.append('</li>');
				}); 
				$("#jhfaPlanList").html(buffer.toString());
				$("#jhfaPlanList").find("li").each(function(index,item){
					 $(this).click(function(){
						 if(!$(this).hasClass("active")){
							 var jhfaName = $.trim($(this).attr("jhfacode"));
							 $.cookie(exports.searchCondition+"JhfaPlanName",jhfaName,{expires:30});
							 $("#jhfaPlanListScrollBar").scrollTop(0); 
							 $("#jhfaPlanListScrollBar").perfectScrollbar("update");
							 exports.loadJhfaDetail(jhfaName);
						 } 
					 });
				});
//				exports.toggleTipInterval = setInterval(exports.toggleTip, 5000);
			}
			exports.goToTouZhu();
			 
			if(d.loginStatus){
				$("#myJhfaScanHistory").show();
				$("#myJhfaScanHistoryNoLogin").hide();
				exports.loadScanHistroy();
//				exports.loadFavorite();
			}else{
				$("#myJhfaScanHistory").hide();
				$("#myJhfaScanHistoryNoLogin").show();
				exports.popLogin();
			}
			$.cookie("sort",sort,{expires:30,domain:$.trim($("#rootDomain").val())});
			exports.jhfaNumberHover();
			
		}else{
			 $("#singleButtonDiaText").html("鏈嶅姟鍣ㄥ繖锛岃绋嶅悗閲嶈瘯");
			 $("#singleButtonDia").modal("show");
		}
	 },
	error:function(xhr){
		var status = xhr.status;
		if(status == "403"){
			global.loginDialog();
		}else{
			alert("鏈嶅姟鍣ㄥ繖锛岃绋嶅悗閲嶈瘯锛�");
		}
	},
	complete: function () {
		layer.close(exports.loadJhfaPlanLayer);
	}
	});
 };
 	exports.toggleTipInterval=null;
	exports.toggleTip=function(){
		$("#tip1").toggle();
		$("#tip2").toggle();
	};	
	exports.popLogin=function(){
		$(".jhfaPopLogin").unbind();
		$(".jhfaPopLogin").click(function(){
			global.loginDialog();
		});
	};
	exports.sortChange=function(){
		$("input[name='optionsRadios'").change(function(){
			$.cookie("sort",$.trim($(this).val()),{expires:30,domain:$.trim($("#rootDomain").val())});
			exports.loadJhfaDetail();
		});
	};
	$(function(){
		global.hour = exports.hour;
		global.minute = exports.minute;
		global.second = exports.second;
		global.countDown();
		global.wsCaipiaoNumber(false,true,false);
		global.loadNubmerPattern();
		global.loadPatternStatistic();
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
		$("#jhfaPageRefresh").click(function(){
			global.loadTodayNumber();
			global.loadNubmerPattern();
			global.loadPatternStatistic();
			exports.loadJhfaDetail();
			exports.loadJhfaOmission();
		});
		$(".containnerr").perfectScrollbar();
		$(".selecter_2").select2({
			minimumResultsForSearch: -1,
			theme:"classic",
			width:"65px",
		});
		$("#zuxjhfawei").select2({
			minimumResultsForSearch: -1,
			theme:"classic",
			width:"90px",
		});
		$("#bdwPattern").select2({
			minimumResultsForSearch: -1,
			theme:"classic",
			width:"60px",
		});
		$("#zhxjhfawei").change(function(){
			if(this.value == "3" || this.value == "4" || this.value == "5" ){
				$("#zhxSalary").val("1950");
			}else{
				$("#zhxSalary").val("195");
			}
		});
		$("#dwjhfaSearch,#bdwjhfaSearch,#zuxjhfaSearch,#zhxjhfaSearch,#sisjhfaSearch,#wuxjhfaSearch").click(function(){
//			$.removeCookie(exports.searchCondition+"JhfaPlanName");
			exports.loadJhfaDetail();
			exports.loadJhfaOmission();
		});
		$("#bdwjhfawei").change(function(){
			if($.trim($(this).val()) == "1" || $.trim($(this).val()) == "3"){
				$("#bdwSalary").val("195");
				$("#bdwJhfaPattern").hide();
				$("#bdwPattern").val(3).trigger("change");
			} else if($.trim($(this).val()) == "2" || $.trim($(this).val()) == "4"||$.trim($(this).val()) == "6"){
				$("#bdwSalary").val("1950");
				$("#bdwJhfaPattern").hide();
				$("#bdwPattern").val(3).trigger("change");
			} else if($.trim($(this).val()) == "7" || $.trim($(this).val()) == "8"){
				$("#bdwPattern").val(0).trigger("change");
				$("#bdwJhfaPattern").show();
				$("#bdwSalary").val("19.5");
			}  else if($.trim($(this).val()) == "5"){
				$("#bdwPattern").val(0).trigger("change");
				$("#bdwJhfaPattern").show();
				$("#bdwSalary").val("195");
			} 
		});
		$("#bdwPattern").change(function(){
			var wei =$.trim($("#bdwjhfawei").val());
			var pattern = $.trim($(this).val());
			if(wei == "7" || wei == "8"){
				if(pattern == "0"){
					$("#bdwSalary").val("19.5");
				}
				if(pattern == "1"){
					$("#bdwSalary").val("195");
				}
				if(pattern == "2"){
					$("#bdwSalary").val("1950");
				}
				if(pattern == "3"){
					$("#bdwSalary").val("19500");
				}
			}
			if(wei == "5"){
				if(pattern == "0"){
					$("#bdwSalary").val("19.5");
				}
				if(pattern == "1"){
					$("#bdwSalary").val("1950");
				}
				if(pattern == "2"){
					$("#bdwSalary").val("19500");
				}
				if(pattern == "3"){
					$("#bdwSalary").val("195000");
				}
			}
		});
		$("#zuxjhfawei").change(function(){
			if($.trim($(this).val()) == "1" || $.trim($(this).val()) == "2"){
				$("#zuxSalary").val("97.5");
			}else{
				$("#zuxSalary").val("325");
			}
		});
		exports.jhfaSelect();
		exports.jhfaTitelSwitch();
		exports.jumpLocation();
		global.toggleClass("active",global.naviBar,"naviExcellentPlan");
		var moseNowAll=$(".jhfa1dbrother .list-inline li");
		var mouseNow=$(".jhfa1d .list-inline li");
		mouseNow.mouseover(function(){
			$(this).css("text-decoration","underline");
		});
		moseNowAll.mouseover(function(){
			$(this).css("text-decoration","underline");
		});
		mouseNow.mouseout(function(){
			$(this).css("text-decoration","none");
		});
		moseNowAll.mouseout(function(){
			$(this).css("text-decoration","none");
		});
		$("#jhfaExpressionButton").hover(function(){
			$("#jhfaExpression").show();
		},function(){
			$("#jhfaExpression").hide();
		});
		$(document).keydown(function(event){
			if(event.keyCode == 116  || event.which == 116 ){
				event.preventDefault();
				window.location.href="/jhfa/excellentPlan";
			}
		});
		//榧犳爣绉讳笂鍘昏鍒掍晶杈规爮鐨勭壒鏁�
		var liTexiao=$(".boutiquePlan1b2 ul li");
		liTexiao.mouseover(function(){
			$(this).addClass("hoverStyle");
		});
		liTexiao.mouseout(function(){
			$(this).removeClass("hoverStyle");
		});
		var myShoucang=$(".mySoucang .mySoucang1");
		myShoucang.click(function(){
			var nowActive=$(this);
			if(nowActive.is('.active')){
				$(this).removeClass("active");
				$(this).next().hide();
			}else{
				$(this).addClass("active");
				$(this).next().show();
			}
		});
		myShoucang.mouseover(function(){
			$(this).addClass("hoverStyle");
		});
		myShoucang.mouseout(function(){
			$(this).removeClass("hoverStyle");
		});
		exports.sortChange();
		var sort=$.trim($.cookie("sort"));
		if(sort=="0"){
			$("#noSeq").attr("checked",true);
		}else{
			$("#seq").attr("checked",true);
		}
		
		
		//閬楁紡鐐瑰嚮娣诲姞active鏁堟灉
		var muchLi=$(".specialNewNow1 .ulOne li");
		muchLi.click(function(){
			var nowClick=$(this);
			if(!nowClick.is('.active')){
				$(this).addClass("active");
			}else{
				$(this).removeClass("active");
			}
		});
	});
});