define(function(require,exports,module){
//	require("funPath/omitCount/highcharts/highcharts");
	require("funPath/omitCount/highcharts/broken-axis");
	require("funPath/omitCount/highcharts/no-data-to-display");
	var global = require("globalPath/global");
	require("funPath/account/login");
	global.toggleClass("active",global.naviBar,"omitCount");
	exports.layerIndex=null;
	exports.hour=$.trim($("#hour").val());
	exports.minute=$.trim($("#minute").val());
	exports.second=$.trim($("#second").val());
	exports.ajax=function(url,data,func){
		 $.ajax({
				url:url,
//				async:false,
				data:data,
				beforeSend:function(){
					exports.layerIndex = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
				},
				type:"POST",
				dataType:"JSON",
				success:func,
				complete: function () {
	    			layer.close(exports.layerIndex);
	    		},
	    		error: function(xhr) {
	    			var status = xhr.status;
	    			if(status=="403"){
	    				global.loginDialog();
	    			}else if(status == "402"){
	    				var buffer = new StringBuilder();
	    				buffer.append('<div>');
	    				buffer.append('<span>你不是VIP用户, 没有权限使用, 快去开通VIP会员吧！</span>');
	    				buffer.append('</div>');
	    				$("#doubleButtonDiaText").html(buffer.toString());
	    				$("#doubleDiaFirstButton").text("去开通会员");
	    				$("#doubleDiaSecondButton").text("取消");
	    				$("#doubleButtonDia").modal("show");
	    				
	    				$("#doubleDiaFirstButton").unbind("click");
	    				$("#doubleDiaSecondButton").unbind("click");
	    				$("#doubleDiaFirstButton").click(function(){
	    					$("#doubleDiaSecondButton").click();
	    					window.open("/order");
	    				});
	    			}else{
	    				$("#singleButtonDiaText").html("服务器忙，请稍后重试");
	    				$("#singleButtonDia").modal("show");
	    			}
	    		}
			 });
	};	
	exports.initSelect2=function(width,data){
		$("#danShiSelect").select2({
			minimumResultsForSearch: -1,
			theme:"classic",
			width:width,
			data:data
		});
	};
	exports.selectCount=null;
	
	exports.data={
			twoStarOmit:[{id: '1', text: '前二遗漏'},{id: '2', text: '后二遗漏'}],
			threeStarOmit:[{id: '3', text: '前三遗漏'},{id: '4', text: '后三遗漏'}],
			fourStarOmit:[{id: '5', text: '前四遗漏'},{id: '6', text: '后四遗漏'}]
	};
	
	exports.selectData=function(id){
		var a = new Array();
		if(id=="twoStarOmit"||id=="twofushi"){
			a=exports.data.twoStarOmit;
		}else if(id=="threeStarOmit"||id=="threefushi"){
			a=exports.data.threeStarOmit;
		}else if(id=="fourStarOmit"||id=="fourfushi"){
			a=exports.data.fourStarOmit;
		}
		return a;
	};
	
	exports.click=function(id){
		$(id).click(function(){
			$('#container').hide();
			$("#textarea").html("");
			$("#textarea").val("");
			$("#textarea").text("");
			$("#currentCount").html("");
			$("#historyCount").html("");
			$("#currentAppearCount").html("");
			$("#omissionDayCount").html("");
			$("#unitaryTodayOmissionCount").html("");
			$("#unitaryThreeMonthAppearCount").html("");
			$("#unitaryThreeMonthAppearPercent").html("");
			$("#todayAppear").html("");
			$("#lastTimeAppear").html("");
			var clickId=$(this).attr("id");
			var siblings=$(this).parent().siblings();
			$.each(siblings,function(index,obj){
			   $(obj).find("a").removeClass("active");
			});
			$("#wan,#qian,#bai,#shi,#ge").removeClass("active");
			$("#danShiSelect_span").hide();
			$(this).addClass("active");
			$("#starOmit_div,#oneStarOmit_div").hide();
			if(clickId=="oneStarOmit"){
				$("#countParent").hide();
				$("#oneStarOmit_div").show();
				exports.initOneStartOmission();
			}else{
				$("#countParent").show();
				$("#countValue").val("");
				exports.selectCount.val("0").trigger("change");
				$("#starOmit_div").show();
				if(clickId!="fiveStarOmit"){
					$("#danShiSelect_span").show();
					$("#danShiSelect").empty();
					exports.initSelect2("100px",exports.selectData(clickId));
					$("#currentCount").next().html("历史最大遗漏期数：");
					$("#currentAppearCount").next().html("历史最大遗漏天数：");
					$("#unitaryTodayOmissionCount").next().html("历史出现次数：");
					if(clickId=="twoStarOmit"){
						$("#wan,#qian").addClass("active");
						$("#wei").val("wanQian");
						$("#wei").attr("numLength",2);
					}else if(clickId=="threeStarOmit"){
						$("#wan,#bai,#qian").addClass("active");
						$("#wei").val("wanQianBai");
						$("#wei").attr("numLength",3);
					}else if(clickId=="fourStarOmit"){
						$("#wan,#qian,#bai,#shi").addClass("active");
						$("#wei").val("wanQianBaiShi");
						$("#wei").attr("numLength",4);
					}
				}else{
					$("#currentCount").next().html("三个月最大遗漏期数：");
					$("#currentAppearCount").next().html("三个月最大遗漏天数：");
					$("#unitaryTodayOmissionCount").next().html("三个月出现次数：");
					$("#wei").val("number");
					$("#wei").attr("numLength",5);
					$.each($("#starOmit_div li"),function(index,obj){
						   $(obj).addClass("active");
						});
				}
			}
		});
	};	
	
	exports.validateUnitaryTextInput=function(count){
		var result = {};
		var number = $.trim($("#textarea").val());
		if(number == ""){
			$("#singleButtonDiaText").html("输入内容为空");
			$("#singleButtonDia").modal("show");
			return false;
		}
		var numberRegExp =/^$/;
		if(count == 2){
			numberRegExp = /^\d{2}$/;
		}else if(count == 3){
			numberRegExp = /^\d{3}$/;
		}else if(count == 4){
			numberRegExp = /^\d{4}$/;
		}else if(count == 5){
			numberRegExp = /^\d{5}$/;
		}
		var numArr = number.split(" ");
		var numReArr = [];
		var flag = true;
		$.each(numArr,function(index,item){
			item = $.trim(item);
			if(item == ""){
				return true;
			}else if(!numberRegExp.test(item)){
				flag = false;
				return false;
			}
			numReArr.push(item);
		});
		if(!flag || ($.trim(numReArr) == "")){
			$("#singleButtonDiaText").html("内容为以英文状态下的空格分隔的"+count+"位数字");
			$("#singleButtonDia").modal("show");
			flag = false;
		}
		result.flag = flag;
		result.numberArr = numReArr;
		return result;
	};
	
	exports.oneOmissionLayer = null;
	exports.initOneStartOmission=function(){
		 $.ajax({
				url:"/omission/oneStartomissionQuery",
				type:"GET",
				dataType:"JSON",
				beforeSend:function(){
					exports.oneOmissionLayer = layer.load(0, {shade : false});  
				},
				success:function(r){
					if(r.success){
						var result=r.result,
						 a=r.a,  b=r.b, c=r.c,
						 d=r.d, e=r.e, zouShiList=r.zouShiList,
						 wanZouShiArr = zouShiList[0].split(" "),
						qianZouShiArr = zouShiList[1].split(" "),
						baiZouShiArr = zouShiList[2].split(" "),
						shiZouShiArr = zouShiList[3].split(" "),
						geZouShiArr = zouShiList[4].split(" ");
						$("#wanTrend").html("当前万位走势为：<span>"+wanZouShiArr[0]+"</span><span>"+wanZouShiArr[1]+"</span>");
						$("#qianTrend").html("当前千位走势为：<span>"+qianZouShiArr[0]+"</span><span>"+qianZouShiArr[1]+"</span>");
						$("#baiTrend").html("当前百位走势为：<span>"+baiZouShiArr[0]+"</span><span>"+baiZouShiArr[1]+"</span>");
						$("#shiTrend").html("当前十位走势为：<span>"+shiZouShiArr[0]+"</span><span>"+shiZouShiArr[1]+"</span>");
						$("#geTrend").html("当前个位走势为：<span>"+geZouShiArr[0]+"</span><span>"+geZouShiArr[1]+"</span>");
						
						$.each(result,function(index,obj){
						var $li=null;
						var $cold=null;
						if(obj.weiType == "0"){
							$li=$("#new_wanWei").find("li");
							$cold=$("#wanWeiCold");
						}else if(obj.weiType == "1"){
							$li=$("#new_qianWei").find("li");
							$cold=$("#qianWeiCold");
						}else if(obj.weiType == "2"){
							$li=$("#new_baiWei").find("li");
							$cold=$("#baiWeiCold");
						}else if(obj.weiType == "3"){
							$li=$("#new_shiWei").find("li");
							$cold=$("#shiWeiCold");
						}else{
							$li=$("#new_geWei").find("li");
							$cold=$("#geWeiCold");
						}
						$.each(obj.countList,function(index,item){
						if(obj.maxYLCount != item){
							$li.eq(index).html(item);
						}else{
							$li.eq(index).html(item).css("color","red");
							$cold.html(index);
						}
					});
						});
						$.each(a,function(index,item){
							$("#past_wanWei").find("li").eq(index).html(item.historyOmission);
						});
						$.each(b,function(index,item){
							$("#past_qianWei").find("li").eq(index).html(item.historyOmission);
						});
						$.each(c,function(index,item){
							$("#past_baiWei").find("li").eq(index).html(item.historyOmission);
						});
						$.each(d,function(index,item){
							$("#past_shiWei").find("li").eq(index).html(item.historyOmission);
						});
						$.each(e,function(index,item){
							$("#past_geWei").find("li").eq(index).html(item.historyOmission);
						});
					}else{
						$("#singleButtonDiaText").html("服务器忙，请稍后重试");
						$("#singleButtonDia").modal("show");
					}
				},
	    		error: function(xhr) {
	    			$("#singleButtonDiaText").html("服务器忙，请稍后重试");
    				$("#singleButtonDia").modal("show");
	    		},
	    		complete:function(){
	    			layer.close(exports.oneOmissionLayer);
	    		}
			 });
	};
	
	$(function(){
		global.hour = exports.hour;
		global.minute = exports.minute;
		global.second = exports.second;
		global.countDown();
		global.wsCaipiaoNumber(false,false);
		global.loadNubmerPattern();
		global.loadPatternStatistic();
		exports.initOneStartOmission();
		$("#danShiOmit").addClass("active");
		$("#oneStarOmit").addClass("active");
		exports.click("#oneStarOmit,#twoStarOmit,#threeStarOmit,#fourStarOmit,#fiveStarOmit");
		$("#danShiSelect").change(function(){
			$("#todayAppear").html("");
			$("#lastTimeAppear").html("");
			$("#currentCount").html("");
			$("#historyCount").html("");
			$("#currentAppearCount").html("");
			$("#omissionDayCount").html("");
			$("#unitaryTodayOmissionCount").html("");
			$("#unitaryThreeMonthAppearCount").html("");
			$("#unitaryThreeMonthAppearPercent").html("");
			$("#wan,#qian,#bai,#shi,#ge").removeClass("active");
			var selected=$("#danShiSelect option:selected").val();
			if(selected==1){
				$("#wan,#qian").addClass("active");
				$("#wei").val("wanQian");
			}else if(selected==2){
				$("#shi,#ge").addClass("active");
				$("#wei").val("shiGe");
			}else if(selected==3){
				$("#wan,#bai,#qian").addClass("active");
				$("#wei").val("wanQianBai");
			}else if(selected==4){
				$("#bai,#shi,#ge").addClass("active");
				$("#wei").val("baiShiGe");
			}else if(selected==5){
				$("#wan,#qian,#bai,#shi").addClass("active");
				$("#wei").val("wanQianBaiShi");
			}else if(selected==6){
				$("#qian,#bai,#shi,#ge").addClass("active");
				$("#wei").val("qianBaiShiGe");
			}
		});
	 $("#btn-count").click(function(){
		 var numResult = exports.validateUnitaryTextInput($("#wei").attr("numLength"));
		 if(!numResult.flag){
			 return false;
		 }
		 var numReArr = numResult.numberArr;
		 var wei = $("#wei").val();
		 if($.trim(wei) == ""){
	    	$("#singleButtonDiaText").html("请选择遗漏位");
    		$("#singleButtonDia").modal("show");
			 return false;
		 }
		 var count=null;
		 var danShiSelectCount=$("#danShiSelectCount option:selected").val();
		 if(danShiSelectCount=="1"){
			 count= $("#countValue").val();
		     var re = /^\d+$/;
		     if(!re.test(count)||count<0||count>10000){
	    		$("#singleButtonDiaText").html("查询期数为小于10000的正整数");
    			$("#singleButtonDia").modal("show");
	    		return false;
		     }
		 }

		 var data={"number":$.trim(numReArr.toString()),"wei":$.trim(wei),"count":count};
		 exports.ajax("/omission/omissionHistoryQuery",data,function(res){
				if(res.success){
					$("#currentCount").html(res.currentOmissionCount+"期");
					$("#historyCount").html(res.historyOmissionCount+"期");
					$("#currentAppearCount").html(res.todayAppearCount+"次");
					$("#omissionDayCount").html(res.omissionDayCount+"天");
					$("#unitaryTodayOmissionCount").html(res.todayOmissionMaxCount+"期");
					$("#unitaryThreeMonthAppearCount").html(res.threeMonthAppearCount+"次");
					$("#unitaryThreeMonthAppearPercent").html(res.averangeAppearPercent+"次");
					if(res.todayAppearPeriod){
						 $("#todayAppear").html(res.todayAppearPeriod+"期");
					}else{
						$("#todayAppear").html("");
					}
                    if(res.lastTimeAppearPeriod){
                    	$("#lastTimeAppear").html(res.lastTimeAppearPeriod+"期");
                    }else{
                		$("#lastTimeAppear").html("");
                    }
                    
				}else{
		    		$("#singleButtonDiaText").html("服务器忙，请稍后重试");
	    			$("#singleButtonDia").modal("show");
				}
		 });
	 });
	
	 exports.selectCount=$("#danShiSelectCount").select2({
			minimumResultsForSearch: -1,
			theme:"classic",
			width:"100px"
		});

	 $("#danShiSelectCount").change(function(){
		 $("#todayAppear").html("");
		 $("#lastTimeAppear").html("");
		 $("#currentCount").html("");
		 $("#historyCount").html("");
		 $("#currentAppearCount").html("");
		 $("#omissionDayCount").html("");
		 $("#unitaryTodayOmissionCount").html("");
		 $("#unitaryThreeMonthAppearCount").html("");
		 $("#unitaryThreeMonthAppearPercent").html("");
		 $("#countValue").val("");
		 var selectVal=$("#danShiSelectCount option:selected").val();
		 if(selectVal=="0"){
			 $("#countTip").show();
			 $("#custom").hide();
		   if($("#fiveStarOmit").hasClass("active")){
				$("#currentCount").next().html("三个月最大遗漏期数：");
				$("#currentAppearCount").next().html("三个月最大遗漏天数：");
				$("#unitaryTodayOmissionCount").next().html("三个月出现次数：");
				$("#countTip").html("（默认期数为三个月期数）");
		   }else{
				$("#currentCount").next().html("历史最大遗漏期数：");
				$("#currentAppearCount").next().html("历史最大遗漏天数：");
				$("#unitaryTodayOmissionCount").next().html("历史出现次数：");
				$("#countTip").html("（默认期数为历史最大期数）");
		   }
		 }else{
			    $("#custom").show();
			    $("#countTip").hide();
				$("#currentCount").next().html("自定义期数最大遗漏期数：");
				$("#currentAppearCount").next().html("自定义期数最大遗漏天数：");
				$("#unitaryTodayOmissionCount").next().html("自定义期数出现次数：");
		 }
	 });
	 
	    $("#btn-scatter").click(function(){
			 var numResult = exports.validateUnitaryTextInput($("#wei").attr("numLength"));
			 if(!numResult.flag){
				 return false;
			 }
			 var numReArr = numResult.numberArr;
			 var wei = $("#wei").val();
			 if($.trim(wei) == ""){
		    	$("#singleButtonDiaText").html("请选择遗漏位");
	    		$("#singleButtonDia").modal("show");
				 return false;
			 }
			 var data={"number":$.trim(numReArr.toString()),"wei":$.trim(wei)};
	    	exports.ajax("/omission/unitaryChartsQuery",data,function(res){
	    		if(res.success){
	    	    	$('#container').show();
	    	    	if(res.data.length==0){
	    	    		$('#container').highcharts({
	    	    	        title: {
	    	    	            text: '100期遗漏图表'
	    	    	        },
	    	    	        series: [{
	    	    	            type: 'scatter',
	    	    	            name: '彩票小助手',
	    	    	            data: []
	    	    	        }],
	    	    	        lang: {
	    	    	            noData: "该号码在近100期内未出现" //真正显示的文本
	    	    	        },
	    	    	        noData: {  
	    	    	            // Custom positioning/aligning options  
	    	    	            position: {    //相对于绘图区定位无数据标签的位置。 默认值：[object Object].
//	    	    	                align: 'right',  
//	    	    	                verticalAlign: 'bottom'  
	    	    	            },  
	    	    	            // Custom svg attributes  
	    	    	            attr: {     //无数据标签中额外的SVG属性
//	    	    	                'stroke-width': 1,  
//	    	    	                stroke: '#cccccc'  
	    	    	            },  
	    	    	            // Custom css  
	    	    	            style: {    //对无数据标签的CSS样式。 默认值：[object Object].                    
//	    	    	                fontWeight: 'bold',       
//	    	    	                fontSize: '15px',  
//	    	    	                color: '#202030'          
	    	    	            }  
	    	    	        },
	    	    	        credits:{ enabled: false }
	    	    	      
	    	    	    });
	    	    	}else{
		    	        $('#container').highcharts({
		    	            chart: {
		    	                type: 'scatter',
		    	                zoomType: 'xy'
		    	            },
		    	            title: {
		    	                text: '100期遗漏图表'
		    	            },
		    	            xAxis: {
		    	                tickPositions:(function () {
		    	                	var list = res.periodList;
		    	                	var data=[];
		    	                    for (var i = 0; i <list.length; i ++) {
		    	                    	data.push(list[i]);
		    	                    }
		    	                    return data;
		    	                 }()),
		    	                categories: res.periodList,
		    	                title: {
		    	                    enabled: true,
		    	                    text: '彩票期号'
		    	                },
		    	                startOnTick: true,
		    	                endOnTick: true,
		    	                showLastLabel: true,
		    	                breaks: [{from: res.breakPeriod.from,to: res.breakPeriod.to,breakSize: 0}],
		    	                tickInterval: 1
		    	            },
		    	            yAxis: {
		    	                labels:{
		    	                    enabled:false
		    	                },
		    	                title: {
		    	                    text: '彩票号码'
		    	                },
		    	                type: 'category'
		    	            },
		    	            plotOptions: {
		    	                scatter: {
		    	                    marker: {
		    	                        radius: 5,
		    	                        states: {
		    	                            hover: {
		    	                                enabled: true,
		    	                                lineColor: 'rgb(100,100,100)'
		    	                            }
		    	                        }
		    	                    },
		    	                    states: {
		    	                        hover: {
		    	                            marker: {
		    	                                enabled: false
		    	                            }
		    	                        }
		    	                    },
		    	                    tooltip: {
		    	                        headerFormat: '<b>重庆时时彩</b><br>',
		    	                        pointFormatter: function() {
		    	                            return '<span">期号：'+this.x+'</span><br/><span">号码：'+this.yValue+'</span><br/>';
		    	                        }
		    	                    }
		    	                }
		    	            },
		    	            series: [{
		    	                name: '彩票小助手',
		    	                color: 'rgba(223, 83, 83, .5)',
		    	                data:(function () {
		    	                	var list=res.data;
		    	                    var data = [];
		    	                    for (var i = 0; i <list.length; i ++) {
		    	                       data.push({
		    	                          x: list[i].period,
		    	                          y: list[i].result,
		    	                          yValue:list[i].yValue
		    	                       });
		    	                    }
		    	                    return data;
		    	                 }())
		    	            }],
		    	            credits:{ enabled: false }
		    	        });
	    	    	}
	    	    	
	    		}
	    	});

	    });
		
	 
	 
	var limouseNav=$(".twoStarOmit1f1a button");
	limouseNav.mouseover(function(){
		$(this).siblings().removeClass("hoverStyle");
		$(this).addClass("hoverStyle");
	});
	limouseNav.mouseout(function(){
		$(this).removeClass("hoverStyle");
	});
	
	//统计到表格 鼠标移上去实现半透明
	var btnCount=$(".twoStarOmit1c button");
	btnCount.mouseover(function(){
		$(this).css("opacity",".8");
	});
	btnCount.mouseout(function(){
		$(this).css("opacity","1");
	});
	
	
	
	//单式遗漏点击变背景图
	var saylLi=$(".oneStarOmit3a1 .ul-img li");
	saylLi.click(function(){
		var nowIndex=$(this);
		if(nowIndex.hasClass('active')){
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
		}
	});
	});
});