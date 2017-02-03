define(function(require,exports,module){
	require("resPath/highchart/highcharts");
	require("resPath/scroll/perfect-scrollbar/js/min/perfect-scrollbar.min");
	var global = require("global");
	exports.type="1";
	exports.omissionWarn=function(){
		$.ajax({
			type:"GET",
			url:"/omissionWarn/omissionWarn",	
			dataType:"JSON",
			data:{
				"type" : exports.type
			},
			success:function(r){
				if(r.success){
					var firstVOList = r.firstVOList;
					var weiType = null,omissionType =null,secondVOList=null,kvList=null,
					buffer = new StringBuilder(),length=null,kvLength=null,className=null,ot=null;
					$.each(firstVOList,function(index,item){
						weiType = item.type;
						secondVOList = item.secondVOList;
						length = secondVOList.length;
						 
						buffer.append('<div class="ylyjNew2a clearfix" style="height:'+length*70+'px;">');
						buffer.append('<div class="ylyjNew2a1" style="height:'+length*70+'px;">');
						buffer.append('<span style="margin-top:'+15*length+'px;">'+weiType+'</span>');
						buffer.append('</div>');
						buffer.append('<div class="ylyjNew2a2" style="height:'+length*70+'px;">');
						$.each(secondVOList,function(index,item){
							var numberBuffer=new StringBuilder(),countBuffer=new StringBuilder();
							omissionType = item.omissionType;
							kvList = item.numberVOList;
							
							buffer.append('<div class="border-btm clearfix">');
							if(omissionType=="热号"){
								buffer.append('<div class="ylyjNew2a2a"><span>'+item.period+'期最少出现'+item.count+'次</span></div>');
							}else{
								buffer.append('<div class="ylyjNew2a2aaa"><span>'+item.period+'期最少遗漏'+item.count+'次</span></div>');
							}
							buffer.append('<div class="ylyjNew2a2b">');
							
							$.each(kvList,function(index,item){
								if(exports.type==1){
									if(index > 15){
										return false;
									}
									className = "yixing";
								}else if(exports.type==2){
									if(index > 9){
										return false;
									}
									className = "erxing";
								}else if(exports.type==3){
									if(index > 7){
										return false;
									}
									className = "sanxing";
								}else if(exports.type==4){
									if(index > 6){
										return false;
									}
									className = "sixing";
								}else if(exports.type==5){
									if(index > 5){
										return false;
									}
									className = "wuxing";
								}
								numberBuffer.append("<li>"+item.number+"</li>");
								countBuffer.append("<li>"+item.count+"</li>");
							});
							buffer.append('<div class="ylyjNew2a2b1 clearfix">');
							if(omissionType=="热号"){
								buffer.append('<span class="rehao">'+omissionType+'号码</span>');
							}else{
								buffer.append('<span class="lenghao">'+omissionType+'号码</span>');
							}
							buffer.append('<ul class="list-inline  clearfix '+className+'">');
							buffer.append(numberBuffer.toString());
							buffer.append('</ul>');
							if(omissionType=="热号"){
								ot = "出现";
							}else{
								ot = "遗漏";
							}
							
							kvLength= kvList.length;
							if(exports.type==1){
								if(kvLength > 15){
									buffer.append('<a href="javascript:void(0);" nt='+omissionType+' ot='+ot+' kvlist=\''+JSON.stringify(kvList)+'\' class="more">更多>></a>	');	
								}
							}else if(exports.type==2){
								if(kvLength > 9){
									buffer.append('<a href="javascript:void(0);"  nt='+omissionType+'  ot='+ot+'   kvlist=\''+JSON.stringify(kvList)+'\' class="more">更多>></a>	');	
								}
							}else if(exports.type==3){
								if(kvLength > 8){
									buffer.append('<a href="javascript:void(0);"  nt='+omissionType+'  ot='+ot+'   kvlist=\''+JSON.stringify(kvList)+'\'  class="more">更多>></a>	');	
								}
							}else if(exports.type==4){
								if(kvLength > 6){
									buffer.append('<a href="javascript:void(0);"  nt='+omissionType+'  ot='+ot+'  kvlist=\''+JSON.stringify(kvList)+'\'  class="more">更多>></a>	');	
								}
							}else if(exports.type==5){
								if(kvLength > 5){
									buffer.append('<a href="javascript:void(0);" nt='+omissionType+'  ot='+ot+'  kvlist=\''+JSON.stringify(kvList)+'\'  class="more">更多>></a>	');	
								}
							}
							buffer.append('</div>');
							buffer.append('<div class="ylyjNew2a2b1 clearfix">');
							buffer.append('<span>'+ot+'次数</span>');
							buffer.append('<ul class="list-inline  clearfix '+className+'">');
							buffer.append(countBuffer.toString());
							buffer.append('</ul>');
							buffer.append('</div>');
							buffer.append('</div>');
							buffer.append('</div>');
						});
						buffer.append('</div>');
						buffer.append('</div>');
					});
					$("#warnContent").html(buffer.toString());
					exports.moreNum();
				}else{
					$("#singleButtonDiaText").html(r.msg);
					$("#singleButtonDia").modal("show");
				}
			},
			error:function(xhr){
				console.info(xhr);
			}
		});
	};
	
	exports.moreNum=function(){
		$(".more").click(function(){
			var kvList=JSON.parse($(this).attr("kvList")),
			numBuffer = new StringBuilder(),countBuffer=new StringBuilder(),buffer=new StringBuilder(),
			mod=null,className=null,nt=null,ot=null;
			nt=$.trim($(this).attr("nt"));
			ot=$.trim($(this).attr("ot"));
			
			if(exports.type==1){
				mod=15;
				className = "yixing";
			}else if(exports.type==2){
				mod=13;
				className = "erxing";
			}else if(exports.type==3){
				mod=10;
				className = "sanxing";
			}else if(exports.type==4){
				mod=9;
				className = "sixing";
			}else if(exports.type==5){
				mod=8;
				className = "wuxing";
			}
			$.each(kvList,function(index,item){
				
				if(index % mod == 0){
					if(index != 0){
						numBuffer.append('</ul>');
						numBuffer.append('</div>');
						
						countBuffer.append('</ul>');
						countBuffer.append('</div>');
						
						buffer.append('<div class="margin-tp">');
						buffer.append(numBuffer.toString());
						buffer.append(countBuffer.toString());
						buffer.append('</div>');
					}
					numBuffer = new StringBuilder();
					countBuffer=new StringBuilder();
					
					numBuffer.append('<div class="ylyjNew2a2b1 clearfix">');
					numBuffer.append('<span>'+nt+'号码</span>');
					numBuffer.append('<ul class="list-inline '+className+' clearfix">');
					numBuffer.append('<li>'+item.number+'</li>');
					countBuffer.append('<div class="ylyjNew2a2b1 clearfix">');
					countBuffer.append('<span>'+ot+'次数</span>');
					countBuffer.append('<ul class="list-inline '+className+' clearfix">');
					countBuffer.append('<li>'+item.count+'</li>');
				}else{
					numBuffer.append('<li>'+item.number+'</li>');
					countBuffer.append('<li>'+item.count+'</li>');
				}
			});
			
			numBuffer.append('</ul>');
			numBuffer.append('</div>');
			countBuffer.append('</ul>');
			countBuffer.append('</div>');
			buffer.append('<div class="margin-tp">');
			buffer.append(numBuffer.toString());
			buffer.append(countBuffer.toString());
			buffer.append('</div>');
			
			$("#moreOmissionNumber").html(buffer.toString());
			$("#numberMoreDiv").modal({
				show: true,
				backdrop: 'static'
			});
			
		});
	};
	
	$(function(){
		
		global.hour = $.trim($("#hour").val());
		global.minute = $.trim($("#minute").val());
		global.second = $.trim($("#second").val());
		global.countDown();
		global.wsCaipiaoNumber(false,false);
		
		var firstTypeList= $.trim($("#firstTypeList").val());
		if(firstTypeList == ""){
			$("#singleButtonDiaText").html("数据加载错误，请稍后重试");
			$("#singleButtonDia").modal("show");
		}
		
		firstTypeList = JSON.parse(firstTypeList);
		var warnSelBuffer = new StringBuilder();
		$.each(firstTypeList,function(index,item){
			if(index==0){
				exports.type = item.value;
			}
			warnSelBuffer.append('<option value="'+item.value+'">'+item.key+'</option>');
		});
		
		$("#omissionWarnSelect").html(warnSelBuffer.toString());
		
		global.loadNubmerPattern();
		global.loadPatternStatistic();
		exports.omissionWarn();
		[].forEach.call(document.querySelectorAll('.containnerr'), function (el) {
			Ps.initialize(el);
		});
		$(".selecter_2").select2({
			minimumResultsForSearch: -1,
			width:"65px",
		});
		$(".selecter_2").select2({
			minimumResultsForSearch: -1,
			width:"65px",
		});
		$("#omissionWarnSelect").change(function(){
			exports.type = $.trim($("#omissionWarnSelect").val());
			exports.omissionWarn();
		});
		
	});
	
});