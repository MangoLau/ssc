/**
 * 遗漏缩水
 */
define(function(require,exports,module){
	var global = require("globalPath/global");
	require("funPath/account/login");
	require("resPath/highchart/highcharts");
	global.toggleClass("active",global.naviBar,"naviYiLouSuoShui");
	global.hour = $.trim($("#hour").val());
	global.minute=$.trim($("#minute").val());
	global.second=$.trim($("#second").val());
	global.countDown();
	global.wsCaipiaoNumber(false,false);
	global.loadNubmerPattern();
	global.loadPatternStatistic();
	//记录做好工具做好号码
	exports.turnZuXuans = null;
	//反选
	exports.reverse = null;
	exports.layerIndex = null;
	exports.zuXuanType = "zuXuan120";
	//根据ID获取选中的li 作为数组返回
	exports.queryChoosedLiText = function(selector){
		var resultArr=[];
		$("#"+selector).find("li[class='active']").each(function(){
			resultArr.push($.trim($(this).text()));
		});
		return resultArr;
	};
	//定位杀
	exports.queryChoosedLiText2 = function(selector){
		var resultArr=[];
		$("#"+selector).find("li[class !='active']").each(function(){
			resultArr.push($.trim($(this).text()));
		});
		return resultArr;
	};
	
	//判断选中的元素是否包含指定的class="active"
	exports.queryChoosedText = function(selector){
		var result = $("#"+selector).hasClass("active");
		return result;
	};
	
	exports.getDanZuData=function(flag){
		var result = {};
		var resultArr=[];
		var resultCountArr=[];
		var danNumOne=$("#danNumOne").find("li[class='active']");
		var danNumTwo=$("#danNumTwo").find("li[class='active']");
		var danNumThree=$("#danNumThree").find("li[class='active']");
		var danNumFour=$("#danNumFour").find("li[class='active']");
		var danNumOneCount=$("#danNumOneCount").find("li[class='active']");
		var danNumTwoCount=$("#danNumTwoCount").find("li[class='active']");
		var danNumThreeCount=$("#danNumThreeCount").find("li[class='active']");
		var danNumFourCount=$("#danNumFourCount").find("li[class='active']");
		var danNumFive=null;
		var danNumSix=null;
		var danNumFiveCount=null;
		var danNumSixCount=null;
		var index=0;
		
		if(danNumOne.length!=0){
			danNumOne.each(function(){
				resultArr.push($.trim($(this).text()));
			});
		}else{
			resultArr.push("blank");
			index++;
		}
		resultArr.push(";");
		if(danNumTwo.length!=0){
			danNumTwo.each(function(){
				resultArr.push($.trim($(this).text()));
			});
		}else{
			resultArr.push("blank");
			index++;
		}
		resultArr.push(";");
		if(danNumThree.length!=0){
			danNumThree.each(function(){
				resultArr.push($.trim($(this).text()));
			});
		}else{
			resultArr.push("blank");
			index++;
		}
		resultArr.push(";");
		if(danNumFour.length!=0){
			danNumFour.each(function(){
				resultArr.push($.trim($(this).text()));
			});
		}else{
			resultArr.push("blank");
			index++;
		}
		resultArr.push(";");
		
		
		if(danNumOneCount.length!=0){
			danNumOneCount.each(function(){
				resultCountArr.push($.trim($(this).text()));
			});
		}else{
			resultCountArr.push("blank");
			index++;
		}
		resultCountArr.push(";");
		if(danNumTwoCount.length!=0){
			danNumTwoCount.each(function(){
				resultCountArr.push($.trim($(this).text()));
			});
		}else{
			resultCountArr.push("blank");
			index++;
		}
		resultCountArr.push(";");
		if(danNumThreeCount.length!=0){
			danNumThreeCount.each(function(){
				resultCountArr.push($.trim($(this).text()));
			});
		}else{
			resultCountArr.push("blank");
			index++;
		}
		resultCountArr.push(";");
		if(danNumFourCount.length!=0){
			danNumFourCount.each(function(){
				resultCountArr.push($.trim($(this).text()));
			});
		}else{
			resultCountArr.push("blank");
			index++;
		}
		resultCountArr.push(";");
		
		if(flag){
			danNumFive=$("#danNumFive").find("li[class='active']");
			danNumSix=$("#danNumSix").find("li[class='active']");
			danNumFiveCount=$("#danNumFiveCount").find("li[class='active']");
			danNumSixCount=$("#danNumSixCount").find("li[class='active']");
			if(danNumFive.length!=0){
				danNumFive.each(function(){
					resultArr.push($.trim($(this).text()));
				});
			}else{
				resultArr.push("blank");
				index++;
			}
			resultArr.push(";");
			if(danNumSix.length!=0){
				danNumSix.each(function(){
					resultArr.push($.trim($(this).text()));
				});
			}else{
				resultArr.push("blank");
				index++;
			}
			resultArr.push(";");
			
			
			if(danNumFiveCount.length!=0){
				danNumFiveCount.each(function(){
					resultCountArr.push($.trim($(this).text()));
				});
			}else{
				resultCountArr.push("blank");
				index++;
			}
			resultCountArr.push(";");
			if(danNumSixCount.length!=0){
				danNumSixCount.each(function(){
					resultCountArr.push($.trim($(this).text()));
				});
			}else{
				resultCountArr.push("blank");
				index++;
			}
			resultCountArr.push(";");
		}
		if(flag&&index==12||!flag&&index==8){
			result.resultArr=[];
			result.resultCountArr=[];
		}else{
			result.resultArr=resultArr;
			result.resultCountArr=resultCountArr;	
		}
		return result;
	};
	
	//验证生成的号码
	exports.validateYlText = function(number,count){
		var result = {};
		if(number == ""){
			result.flag = false;
			result.msg = "数字内容为空";
			return result;
		}
		var numberRegExp = /^$/;
		if (count == 2) {
			numberRegExp = /^\d{2}$/;
		}else if (count==3) {
			numberRegExp = /^\d{3}$/;
		}else if (count==4) {
			numberRegExp = /^\d{4}$/;
		}else if (count==5||count==6) {
			count==5;
			numberRegExp = /^\d{5}$/;
		}
		var numArr = number.split(" ");
		var numReArr = [];
		var flag = true;
		$.each(numArr,function(index,item){
			item = $.trim(item);
			if(item==""){
				return true;
			}else {
				if (!numberRegExp.test(item)) {
					result.msg="数字内容为以英文状态下的逗号分割的"+count+"位数字";
					flag=false;
					return false;
				}
			}
			numReArr.push(item);
		});
		if (!flag || ($.trim(numReArr) =="")) {
			result.msg="数字内容为以英文状态下的逗号分割的"+count+"位数字";
		}
		result.flag = flag;
		result.numberArr=numReArr;
		return result;
	};
	
	
	$(function(){
		
		if($("#specialStarZhgj").hasClass("active")){
			$("#firstHead").click();
		}
		
		//二星做号
		$("#twoStarZuoHao").click(function() {
	   		var d = $.trim($("#bannerCylHtmlBufferiPiaoType").val());
	   		$("#bannerCaiPiaoType").val(d);
	   		$("#dispatcherForm").attr("action", "/zhgj/2");
	   		$("#dispatcherForm").submit();
	   	});
		
		//三星做号
		$("#threeStarZuoHao").click(function() {
	   		var d = $.trim($("#bannerCaiPiaoType").val());
	   		$("#bannerCaiPiaoType").val(d);
	   		$("#dispatcherForm").attr("action", "/zhgj/3");
	   		$("#dispatcherForm").submit();
	   	});
		
		//四星做号
		$("#fourStarZuoHao").click(function() {
	   		var d = $.trim($("#bannerCaiPiaoType").val());
	   		$("#bannerCaiPiaoType").val(d);
	   		$("#dispatcherForm").attr("action", "/zhgj/4");
	   		$("#dispatcherForm").submit();
	   	});
		
		//五星做号
		$("#fiveStarZuoHao").click(function() {
	   		var d = $.trim($("#bannerCaiPiaoType").val());
	   		$("#bannerCaiPiaoType").val(d);
	   		$("#dispatcherForm").attr("action", "/zhgj/5");
	   		$("#dispatcherForm").submit();
	   	});
		
		//特殊组合转单式
		$("#specialStarZhgj").click(function() {
	   		var d = $.trim($("#bannerCaiPiaoType").val());
	   		$("#bannerCaiPiaoType").val(d);
	   		$("#dispatcherForm").attr("action", "/zhgj/6");
	   		$("#dispatcherForm").submit();
	   	});
		
		//切换+,-号样式
		$(".collapsedClick").on("click",function(){
			var bool = $.trim($(this).attr("aria-expanded"));
			if(bool == "false"){
				//$(".panel-heading").removeClass("sq");
				$(this).parent().parent(".panel-heading").addClass("sq");
			}else{
				$(this).parent().parent(".panel-heading").removeClass("sq");
			}
		});
		
		//号码的选中事件
		$(".listsLi").find("li").click(function(){
			$(this).toggleClass("active");
		});
		
		//全选
		$(".selectAll").click(function(){
			$(this).parent().find("ul li").addClass("active");
		});
		
		//全选
		$(".selectAll2").click(function(){
			$(this).parent().prev().find("ul li").addClass("active");
		});
		//全选
		$(".selectAll3").click(function(){
			$(this).parent().parent().find("ul li").addClass("active");
		});
		
		//清除
		$(".clearAll").click(function(){
			$(this).parent().find("ul li").removeClass("active");
		});
		//清除
		$(".clearAll2").click(function(){
			$(this).parent().prev().find("ul li").removeClass("active");
		});
		//清除
		$(".clearAll3").click(function(){
			$(this).parent().parent().find("ul li").removeClass("active");
		});
		//全选  胆组
		
		$(".selectAll-dan").click(function(){
			var $div=$(this).parent();
			$div.find("li").addClass("active");
			$div.next("div").find("li").addClass("active");
		});
        //清除  胆组
		
		$(".clearAll-dan").click(function(){
			var $div=$(this).parent();
			$div.find("li").removeClass("active");
			$div.next("div").find("li").removeClass("active");
		});
		
		 var zhgjTypeNum = $.trim($("#zhgjType").val());
		 
		//生成号码
		$("#zhgjGen").click(function() {
			var au = "keep";
	    	var E = "keep";
	    	var k = $.trim($("#minNum").val());
	    	var aw = $.trim($("#maxNum").val());
	    	if (k > aw) {
	    		$("#singleButtonDiaText").html("最大号码不能小于最小号码");
				$("#singleButtonDia").modal("show");
	    		return false;
	    	}
	    	var p = "";
	    	var q = "keep";
	    	var at = exports.queryChoosedLiText("danMaNum");
	    	var ad = "keep";
	    	var g = exports.queryChoosedLiText2("firstNum");//定位杀个位
	    	var l = "keep";
	    	var m = exports.queryChoosedLiText2("secondNum");//定位杀十位
	    	var aa = "keep";
	    	var aq = exports.queryChoosedLiText("spanNum");
	    	var j = "keep";
	    	var ar = exports.queryChoosedLiText("endValueNum");
	    	var v = "keep";
	    	var I = exports.queryChoosedLiText2("sumValueNum");
	    	var aA = "remove";
	    	var S = exports.queryChoosedLiText("bigSmallNum");
	    	var f = "remove";
	    	var ao = exports.queryChoosedLiText("oddEvenNum");
	    	var ab = "remove";
	    	var aG = exports.queryChoosedLiText("primeCompositeNum");
	    	var r = "remove";
	    	var ac = exports.queryChoosedLiText("approachNum");
	    	var W = "remove";
	    	var ay = "remove";
	    	var Y = "keep";
	    	var ai = "keep";
	    	var O = "remove";
	    	var ag = "remove";
	    	var ax = "remove";
	    	var Z = "remove";
	    	var U = "remove";
	    	var G = "keep";
	    	var R = "keep";
	    	var x = "keep";
	    	var V = "keep";
	    	var ak = "remove";
	    	var J = null ;
	    	var t = null ;
	    	var H = null ;
	    	var K = null ;
	    	var ae = null ;
	    	var w = null ;
	    	var h = null ;
	    	var aE = null ;
	    	var aH = null ;
	    	var ap = null ;
	    	var ah = null ;
	    	var L = null ;
	    	var o = null ;
	    	var al = null ;
	    	var D = null ;
	    	var av = null ;
	    	var af = null ;
	    	var an = null ;
	    	var i = null ;
	    	var e = null ;
	    	var s = null ;
	    	var aB = null ;
	    	var y = null ;
	    	var P = null ;
	    	var n = null ;
	    	var z = null ;
	    	var C = null ;
	    	var B = null ;
	    	var N = null ;
	    	var aF = null ;
	    	var aD = [];
	    	var u = null ;
	    	var M = [];
	    	var T = null ;
	    	var A = null ;
	    	var d = null ;
	    	var aC = null ;
	    	var Q = null ;
	    	var aj = "keep";
	    	var F = "keep";
	    	var az = "keep";
	    	var X = "keep";
	    	var am = at.length;
	    	var danZuArr=null;
	    	var danZuCountArr=null;
	    	var groupNumType=null;
	    	var groupBasicNum=null;
	    	var specilFirstNum=null;
	    	var specilSecondNum=null;
	    	if (zhgjTypeNum == 2) {
	    		p = "twoStar";
	    		u = $.trim($("input[name='chuDanNum']:checked").val());
	    		if (u != "") {
	    			u = parseInt(u);
	    			if (am != 0) {
	    				if (u > am) {
	    					$("#resultSize").html("0");
	    					$("#reply_content").html("选择的胆码数不能小于于出胆个数");
	    					return false;
	    				}
	    			}
	    		}
	    		H = exports.queryChoosedLiText("bigNum");
	    		ae = exports.queryChoosedLiText("oddNum");
	    		K = exports.queryChoosedLiText("primeNum");
	    		T = exports.queryChoosedText("nonContinuity");
	    		if (T) {
	    			M.push("1");
	    		}
	    		A = exports.queryChoosedText("twoContinuity");
	    		if (A) {
	    			M.push("2");
	    		}
	    	}
	    	if (zhgjTypeNum == 3) {
	    		p = "threeStar";
	    		w = exports.queryChoosedLiText2("thirdNum");//定位杀百位
	    		h = exports.queryChoosedText("removeGroupThree");
	    		aE = exports.queryChoosedText("removeGroupSix");
	    		D = exports.queryChoosedText("removeBaozi");
	    		ah = exports.queryChoosedText("convex");
	    		L = exports.queryChoosedText("sunken");
	    		groupNumType=exports.queryChoosedLiText("groupNumType");
	    		groupBasicNum=exports.queryChoosedLiText("groupBasicNum");
	    		u = $.trim($("input[name='chuDanNum']:checked").val());
	    		if (u != "") {
	    			u = parseInt(u);
	    			if (am != 0) {
	    				if (u > am) {
	    					$("#resultSize").html("0");
	    					$("#reply_content").html("选择的胆码数不能小于于出胆个数");
	    					return false;
	    				}
	    			}
	    		}
	    		J = exports.queryChoosedText("shangShan");
	    		t = exports.queryChoosedText("xiaShan");
	    		H = exports.queryChoosedLiText("bigNum");
	    		ae = exports.queryChoosedLiText("oddNum");
	    		K = exports.queryChoosedLiText("primeNum");
	    		T = exports.queryChoosedText("nonContinuity");
	    		if (T) {
	    			M.push("1");
	    		}
	    		A = exports.queryChoosedText("twoContinuity");
	    		if (A) {
	    			M.push("2");
	    		}
	    		d = exports.queryChoosedText("threeContinuity");
	    		if (d) {
	    			M.push("3");
	    		}
	    	}
	    	if (zhgjTypeNum == 4) {
	    		p = "fourStar";
	    		w = exports.queryChoosedLiText2("thirdNum");//定位杀百位
	    		aH = exports.queryChoosedLiText2("fourthNum");//定位杀千位
	    		ap = exports.queryChoosedLiText("acNum");
	    		ah = exports.queryChoosedText("convex");
	    		L = exports.queryChoosedText("sunken");
	    		o = exports.queryChoosedText("nPattern");
	    		al = exports.queryChoosedText("notNPattern");
	    		D = exports.queryChoosedText("removeBaozi");
	    		av = exports.queryChoosedText("removeSanHao");
	    		an = exports.queryChoosedText("removeSanTongHao");
	    		i = exports.queryChoosedText("removeTwoDuizi");
	    		af = exports.queryChoosedText("removeDuizi");
	    		J = exports.queryChoosedText("shangShan");
	    		t = exports.queryChoosedText("xiaShan");
	    		T = exports.queryChoosedText("nonContinuity");
	    		var danZu=exports.getDanZuData(false);
	    		danZuArr=danZu.resultArr;
	    		danZuCountArr=danZu.resultCountArr;
	    		if (T) {
	    			M.push("1");
	    		}
	    		A = exports.queryChoosedText("twoContinuity");
	    		if (A) {
	    			M.push("2");
	    		}
	    		d = exports.queryChoosedText("threeContinuity");
	    		if (d) {
	    			M.push("3");
	    		}
	    		aC = exports.queryChoosedText("fourContinuity");
	    		if (aC) {
	    			M.push("4");
	    		}
	    	}
	    	if (zhgjTypeNum == 5) {
	    		J = exports.queryChoosedText("shangShan");
	    		t = exports.queryChoosedText("xiaShan");
	    		p = "fiveStar";
	    		w = exports.queryChoosedLiText2("thirdNum");//定位杀百位
	    		aH = exports.queryChoosedLiText2("fourthNum");//定位杀千位
	    		e = exports.queryChoosedLiText2("fifthNum");//定位杀万位
	    		s = exports.queryChoosedLiText("bigSmallPercent");
	    		aB = exports.queryChoosedLiText("oddEvenPercent");
	    		y = exports.queryChoosedLiText("primeCompositePercent");
	    		P = exports.queryChoosedText("aaaaa");
	    		var danZu=exports.getDanZuData(true);
	    		danZuArr=danZu.resultArr;
	    		danZuCountArr=danZu.resultCountArr;
	    		if (P) {
	    			aD.push("aaaaa");
	    		}
	    		n = exports.queryChoosedText("aabcd");
	    		if (n) {
	    			aD.push("aabcd");
	    		}
	    		z = exports.queryChoosedText("aabbc");
	    		if (z) {
	    			aD.push("aabbc");
	    		}
	    		C = exports.queryChoosedText("aaabb");
	    		if (C) {
	    			aD.push("aaabb");
	    		}
	    		B = exports.queryChoosedText("aaabc");
	    		if (B) {
	    			aD.push("aaabc");
	    		}
	    		N = exports.queryChoosedText("aaaab");
	    		if (N) {
	    			aD.push("aaaab");
	    		}
	    		aF = exports.queryChoosedText("abcde");
	    		if (aF) {
	    			aD.push("abcde");
	    		}
	    		T = exports.queryChoosedText("nonContinuity");
	    		if (T) {
	    			M.push("1");
	    		}
	    		A = exports.queryChoosedText("twoContinuity");
	    		if (A) {
	    			M.push("2");
	    		}
	    		d = exports.queryChoosedText("threeContinuity");
	    		if (d) {
	    			M.push("3");
	    		}
	    		aC = exports.queryChoosedText("fourContinuity");
	    		if (aC) {
	    			M.push("4");
	    		}
	    		Q = exports.queryChoosedText("fiveContinuity");
	    		if (Q) {
	    			M.push("5");
	    		}
	    	}
	    	
	    	if(zhgjTypeNum == 6){
	    		if($("#firstHead").hasClass("active")){
	    			exports.zuXuanType="zuXuan120";
	    		}else if($("#secondHead").hasClass("active")){
	    			exports.zuXuanType="zuXuan60";
	    		}else if($("#thirdHead").hasClass("active")){
	    			exports.zuXuanType="zuXuan30";
	    		}else if($("#fourHead").hasClass("active")){
	    			exports.zuXuanType="zuXuan20";
	    		}else if($("#fiveHead").hasClass("active")){
	    			exports.zuXuanType="zuXuan10";
	    		}else if($("#sixHead").hasClass("active")){
	    			exports.zuXuanType="zuXuan5";
	    		}
	    		p = "zuXuan";
	    		specilFirstNum= exports.queryChoosedLiText("specialFirst");
	    		if(!$("#firstHead").hasClass("active")){
	    			specilSecondNum= exports.queryChoosedLiText("specialSecond");
	    		}
	    	}
	    	
	    	$.ajax({
	    		type: "POST",
	    		//async: false,
	    		url: "/index.php/zhgj/zhgjGenerateNum",
	    		data: {
	    			zhgjType: $.trim(p),
	    			danMaNum: $.trim(at),
	    			danMaKeepOrDel: q,
	    			firstNum: $.trim(g),
	    			firstNumKeepOrDel: ad,
	    			secondNum: $.trim(m),
	    			secondNumKeepOrDel: l,
	    			thirdNum: $.trim(w),
	    			thirdNumKeepOrDel: Y,
	    			fourthNum: $.trim(aH),
	    			fourthNumKeepOrDel: ai,
	    			fifthNum: $.trim(e),
	    			fifthNumKeepOrDel: G,
	    			spanNum: $.trim(aq),
	    			spanKeepOrDel: aa,
	    			endValueNum: $.trim(ar),
	    			endValueKeepOrDel: j,
	    			sumValueNum: $.trim(I),
	    			sumValueKeepOrDel: v,
	    			bigSmallNum: $.trim(S),
	    			bigSmallKeepOrDel: aA,
	    			evenOddNum: $.trim(ao),
	    			evenOddKeepOrDel: f,
	    			primeCompositeNum: $.trim(aG),
	    			primeCompositeKeepOrDel: ab,
	    			approachNum: $.trim(ac),
	    			approachKeepOrDel: r,
	    			bigSmallPercent: $.trim(s),
	    			bigSmallPercentKeepOrDel: R,
	    			oddEvenPercent: $.trim(aB),
	    			oddEvenPercentKeepOrDel: x,
	    			primeCompositePercent: $.trim(y),
	    			primeCompositePercentKeepOrDel: V,
	    			shangShan: J,
	    			shangShanKeepOrDel: W,
	    			xiaShan: t,
	    			xiaShanKeepOrDel: ay,
	    			consecutive: $.trim(M),
	    			abcde: $.trim(aD),
	    			abcdeKeepOrDel: ak,
	    			minNum: $.trim(k),
	    			minNumKeepOrDel: au,
	    			maxNum: $.trim(aw),
	    			maxNumKeepOrDel: E,
	    			acValue: $.trim(ap),
	    			acValueKeepOrDel: O,
	    			convex: ah,
	    			convexKeepOrDel: ag,
	    			sunken: L,
	    			sunkenKeepOrDel: ax,
	    			nPattern: o,
	    			nPatternKeepOrDel: Z,
	    			notNPattern: al,
	    			notNPatternKeepOrDel: U,
	    			removeBaozi: D,
	    			removeSanHao: av,
	    			removeDuizi: af,
	    			removeSanTonghao: an,
	    			removeTwoDuizi: i,
	    			removeGroupThree: h,
	    			removeGroupSix: aE,
	    			bigNum: $.trim(H),
	    			bigNumKeepOrDel: $.trim(F),
	    			primeNum: $.trim(K),
	    			primeNumKeepOrDel: $.trim(az),
	    			oddNum: $.trim(ae),
	    			oddNumKeepOrDel: $.trim(X),
	    			chuDanNumKeepOrDel: $.trim(aj),
	    			chuDanNum: u,
	    			danZuNum : $.trim(danZuArr),
	    			danZuNumCount : $.trim(danZuCountArr),
	    			groupBasicNum :$.trim(groupBasicNum),
	    			groupNumType :$.trim(groupNumType),
	    			zuXuanType:$.trim(exports.zuXuanType),
	    			specilFirstNum:$.trim(specilFirstNum),
	    			specilSecondNum:$.trim(specilSecondNum)
	    			
	    		},
	    		dataType: "JSON",
	    		beforeSend:function(){
	    			//exports.layerIndex = layer.load(0, {shade : false}); //0代表加载的风格，支持0-2
				},
	    		success: function(aK) {
	    			if (aK.success) {
	    				$("#resultSize").html(aK.resultSet.length);
	    				var aJ = new StringBuilder();
	    				$.each(aK.resultSet, function(aL, aM) {
	    					aJ.append(aM);
	    					aJ.append(" ");
	    				});
	    				var aI = aJ.toString();
	    				exports.turnZuXuans = aI;//转为组选
	    				exports.reverse = aI;//反选
	    				$("#reply_content").val(aI.substring(0, aI.length - 1));
	    				$("#reply_content").text(aI.substring(0, aI.length - 1));
	    				$("#reply_content").html(aI.substring(0, aI.length - 1));
	    			} else {
	    				$("#singleButtonDiaText").html("做号生成失败，请重试");
	    				$("#singleButtonDia").modal("show");
	    			}
	    		},
	    		complete: function () {
	    			//layer.close(exports.layerIndex);
	    		},
	    		error: function(xhr) {
	    			var status = xhr.status;
	    			if(status=='200'){

                    }else if(status=="403"){
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
		});
		
		exports.contains = function(arr,item){
			var index = arr.length;
			while (index--) {
				if (arr[index] == item) {
					return true;
				}
			}
			return false;
		};
		
		//转为组选
		$("#turnZuXuan").click(function(){
			if(exports.turnZuXuans == null || exports.turnZuXuans == ""){
				alert("未生成号码");
				return false;
			}
			$.ajax({
				url:"/index.php/zhgj/turnZuXuan",
				type: "POST",
				dataType: "JSON",
				data: {"numbers":exports.turnZuXuans},
				beforeSend:function(){
					//exports.layerIndex = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
				},
				success:function(r){
					if(r.success){
						var data = r.data;
						var builder = new StringBuilder();
						$.each(data,function(i,d){
							builder.append(d);
							builder.append(" ");
						});
						var aI = builder.toString();
						exports.reverse = aI;
						$("#resultSize").html(data.length);
						$("#reply_content").val(aI.substring(0, aI.length - 1));
	    				$("#reply_content").text(aI.substring(0, aI.length - 1));
	    				$("#reply_content").html(aI.substring(0, aI.length - 1));
					}else{
						alert(r.msg);
					}
				},
				complete: function () {
	    			//layer.close(exports.layerIndex);
	    		},
				error:function(xhr){
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
		});
		
		//清除生成的号码
		$("#zhgjClear").click(function() {
			exports.turnZuXuans = null;
			$("#resultSize").html("0");
			$("#reply_content").val("");
			$("#reply_content").text("");
			$("#reply_content").html("");
		});
		
		var touZhuNumber = null;
		$("#reply_content").bind("input propertychange",function(){
			var txVal =   $(this).val().replace(/[\r\n]/g," "),
			txValArr = txVal.split(" "),
			numRegExp = null,
			numArr = [],
			length = null;
			
			txVal = txVal.replaceAll(";"," ");
			txVal = txVal.replaceAll(","," ");
			txVal = txVal.replaceAll("  "," ");
			$(this).val(txVal);
			txVal = $.trim(txVal);
			if (zhgjTypeNum == "2") {
				numRegExp = /^\d{2}$/;
			}else if(zhgjTypeNum == "3"){
				numRegExp = /^\d{3}$/;
			}else if (zhgjTypeNum == "4") {
				numRegExp = /^\d{4}$/;
			}else if (zhgjTypeNum == "5"||zhgjTypeNum == "6") {
				numRegExp = /^\d{5}$/;
			}
			if($.trim(numRegExp) != ''){
				$.each(txValArr,function(index,item){
					if(numRegExp.test(item)){
						numArr.push(item);
					}
				});
				length = numArr.length;
				$("#resultSize").html(length);
				touZhuNumber = numArr.join(" ");
			}
			
		});

		$("#goToTouZhu").click(function(){
			$("#reply_content").trigger("input");
			touZhuNumber = $.trim(touZhuNumber);
			if(touZhuNumber == ''){
				$("#singleButtonDiaText").html("有效投注号码不能为空");
				$("#singleButtonDia").modal("show");
				return false;
			}
			var type = $.trim($(".touZhu").find("input[type='radio']:checked").val());
			if(type == ''){
				$("#singleButtonDiaText").html("投注类型为空，请刷新页面重试");
				$("#singleButtonDia").modal("show");
				return false;
			}
			$("#ft").val(type);
			$("#tzNumber").val(touZhuNumber);
			$("#touZhuForm").submit();
			
		});
		
		$("#goDaDiYZ").click(function(){
			$("#reply_content").trigger("input");
			touZhuNumber = $.trim(touZhuNumber);
			if(touZhuNumber == ''){
				$("#singleButtonDiaText").html("有效大底验证号码不能为空");
				$("#singleButtonDia").modal("show");
				return false;
			}
			var type = $.trim($(".touZhu").find("input[type='radio']:checked").val());
			if(type == ''){
				$("#singleButtonDiaText").html("大底验证类型为空，请刷新页面重试");
				$("#singleButtonDia").modal("show");
				return false;
			}
			$("#pt").val(type);
			$("#yzNumber").val(touZhuNumber);
			$("#checkForm").submit();
			
		});
		
		$("#ecgl").click(function(){
			$("#reply_content").trigger("input");
			touZhuNumber = $.trim(touZhuNumber);
			if(touZhuNumber == ''){
				$("#singleButtonDiaText").html("有效二次验证号码不能为空");
				$("#singleButtonDia").modal("show");
				return false;
			}
			var type = $.trim($(".touZhu").find("input[type='radio']:checked").val());
			if(type == ''){
				$("#singleButtonDiaText").html("二次验证类型为空，请刷新页面重试");
				$("#singleButtonDia").modal("show");
				return false;
			}
			$("#sc").val(type);
			$("#scNumber").val(touZhuNumber);
			$("#secondCheck").submit();
		});
		
		//立即反选
		$("#reverseSelect").click(function(){
			var reply_content=$("#reply_content").val();
			if($.trim(reply_content)==""){
			$("#singleButtonDiaText").html("未生成号码");
			$("#singleButtonDia").modal("show");
			return false;
		}
			var valArr=reply_content.split(" ");
			var numRegExp = null;
			var numArr=[];
			if (zhgjTypeNum == "2") {
				numRegExp = /^\d{2}$/;
			}else if(zhgjTypeNum == "3"){
				numRegExp = /^\d{3}$/;
			}else if (zhgjTypeNum == "4") {
				numRegExp = /^\d{4}$/;
			}else if (zhgjTypeNum == "5"||zhgjTypeNum == "6") {
				numRegExp = /^\d{5}$/;
			}
			if($.trim(numRegExp) != ''){
				var flag=false;
				$.each(valArr,function(index,item){
						if(numRegExp.test(item)){
							numArr.push(item);
						}else{
							$("#singleButtonDiaText").html("号码"+item+"格式不正确，请重新确认需要反转的号码");
		    				$("#singleButtonDia").modal("show");
		    				flag=true;
						}
				});
				if(flag){
					return false;
				}
				var reverse = $(this).attr("index");
				if(reverse == "twoStar"){
					if(numArr.length == 100){
						$("#singleButtonDiaText").html("生成的号码都存在,不能进行反选");
	    				$("#singleButtonDia").modal("show");
						return false;
					}
				}else if(reverse == "threeStar"){
					if(numArr.length == 1000){
						$("#singleButtonDiaText").html("生成的号码都存在,不能进行反选");
	    				$("#singleButtonDia").modal("show");
						return false;
					}
				}else if(reverse == "fourStar"){
					if(numArr.length == 10000){
						alert("生成的号码都存在,不能进行反选");
						return false;
					}
				}else if(reverse == "fiveStar"){
					if(numArr.length == 100000){
						$("#singleButtonDiaText").html("生成的号码都存在,不能进行反选");
	    				$("#singleButtonDia").modal("show");
						return false;
					}
				}
					$.ajax({
						url:"/index.php/zhgj/reverse",
						type: "POST",
						dataType: "JSON",
						data: {"numbers":$.trim(numArr),"reverseType":$.trim(reverse)},
						beforeSend:function(){
							//exports.layerIndex = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
						},
						success:function(r){
							if(r.success){
								var data = r.data;
								var builder = new StringBuilder();
								$.each(data,function(i,d){
									builder.append(d);
									builder.append(" ");
								});
								var aI = builder.toString();
								$("#resultSize").html(data.length);
								$("#reply_content").val(aI.substring(0, aI.length - 1));
			    				$("#reply_content").text(aI.substring(0, aI.length - 1));
			    				$("#reply_content").html(aI.substring(0, aI.length - 1));
							}else{
								$("#singleButtonDiaText").html(r.msg);
			    				$("#singleButtonDia").modal("show");
							}
						},
						complete: function () {
			    			//layer.close(exports.layerIndex);
			    		},
						error:function(xhr){
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
				
			}
		});
		
		
		var ylzsTitle = "";
		var wei = "";
		if (zhgjTypeNum == "2") {
            //ylzsTitle = "后二遗漏统计";
            ylzsTitle = "";
            wei = "shiGe";
		}else if(zhgjTypeNum == "3"){
			ylzsTitle = "后三遗漏统计";
			wei = "baiShiGe";
		}else if (zhgjTypeNum == "4") {
			ylzsTitle = "后四遗漏统计";
			wei = "lastFour";
		}else if (zhgjTypeNum == "5"||zhgjTypeNum == "6") {
			ylzsTitle = "五星遗漏统计";
			wei = "number";
		}
		$("#ylQuery").html(ylzsTitle);
		//遗漏统计
		$("#ylQuery").on("click", function() {
			var content = $.trim($("#reply_content").val());
			if (content == "") {
	    		$("#singleButtonDiaText").html("未生成号码");
				$("#singleButtonDia").modal("show");
	    		return false;
	    	}
			if (ylzsTitle == "" || wei == "") {
				$("#singleButtonDiaText").html("服务器忙，请稍后重试");
				$("#singleButtonDia").modal("show");
	    		return false;
	    	}
			var numResult = exports.validateYlText(content,zhgjTypeNum);
	    	if (!numResult.flag) {
	    		$("#singleButtonDiaText").html(numResult.msg);
				$("#singleButtonDia").modal("show");
	    		return false;
	    	}
	    	var ylHtmlBuffer = new StringBuilder();
	    	ylHtmlBuffer.append("<br />");
	    	var f = layer.load(2,{
	    		offset: ['525px', '732px']
	    	});
	    	$.ajax({
	    		url: "/index.php/omission/omissionQuery",
	    		cache: true,
	    		async: true,
	    		data: {
	    			"type":zhgjTypeNum,
					"number":$.trim(numResult.numberArr),
					"wei":$.trim(wei)
	    		},
	    		type: "POST",
	    		dataType: "JSON",
	    		success: function(r) {
	    			layer.close(f);
	    			if (r.success) {
	    				ylHtmlBuffer.append("用户统计数据注数：<span>"+numResult.numberArr.length+"注</span><br />");
						ylHtmlBuffer.append("当前遗漏期数：<span>"+r.currentOmissionCount+"期</span><br />");
						ylHtmlBuffer.append("今天出现次数：<span>"+r.todayAppearCount+"次</span><br />");
						ylHtmlBuffer.append("三个月内最大遗漏期数：<span>"+r.historyOmissionCount+"期</span><br />");
						ylHtmlBuffer.append("三个月内最大遗漏天数：<span>"+r.omissionDayCount+"天</span><br />");
						ylHtmlBuffer.append("三个月内出现次数：<span>"+r.threeMonthAppearCount+"次</span><br />");
						ylHtmlBuffer.append("平均每天出现次数：<span>"+r.averangeAppearPercent+"次</span><br />");
	    			} else {
	    				ylHtmlBuffer.append("服务器忙，请稍后重试");
	    			}
	    			layer.msg(ylHtmlBuffer.toString(), {
	    				tipsMore: true,
	    				time: 0,
	    				offset: ['320px', '650px'],
	    				tips: [2, "#424a54"],
	    				closeBtn: [0, true],
	    				shadeClose: true
	    			});
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
	    			layer.close(f);
	    		}
	    	});
		});
		
		$(".specialNew button").click(function(){
			var currentBtn=$(this);
			var clickBtn=currentBtn.html();
			var lis=currentBtn.parent().prev().find("li");
			if(lis.length<2){
				lis=currentBtn.parent().parent().parent().find("li");
			}
			var level=lis.length/2;
			if(clickBtn=="全"){
				$.each(lis,function(index,obj){
					if(!$(obj).hasClass("active")){
						$(obj).addClass("active");
					}
				});
			}else if(clickBtn=="大"){
				$.each(lis,function(index,obj){
					$(obj).removeClass("active");
					if(index>=level){
						$(obj).addClass("active");  
					  }
					});
			}else if(clickBtn=="小"){
				$.each(lis,function(index,obj){
					$(obj).removeClass("active");
					   if(index<level){
						   $(obj).addClass("active");  
					   }
					});
			}else if(clickBtn=="单"){
				$.each(lis,function(index,obj){
					$(obj).removeClass("active");
					   if(index%2!=0){
						   $(obj).addClass("active");
					   }
					   
					});
			}else if(clickBtn=="双"){
				$.each(lis,function(index,obj){
					$(obj).removeClass("active");
					   if(index%2==0){
						   $(obj).addClass("active");  
					   }
					  
					});
			}else if(clickBtn=="清"){
				$.each(lis,function(index,obj){
					   $(obj).removeClass("active");
					});
			}
		});
		
		$("#zhgjKeyCopy").zclip({
	        path: "/static/js/resource/clipBoard/ZeroClipboard.swf",
	        copy: function() {
	            return $("#reply_content").val();
	        },
	        afterCopy: function() {
	        	var value = $("#reply_content").val();
	        	if($.trim(value) != ""){
	        		var d = $("<div class='copy-tips'><div class='copy-tips-wrap'>做号结果已经复制到剪贴板上</div></div>");
	        		$("body").find(".copy-tips").remove().end().append(d);
	        		$(".copy-tips").fadeOut(3000);
	        	}
	        }
	    });
		/*做号工具里面btn鼠标移上去变半透明效果*/
		var mouseNow=$(".two-star-zhgj4a a");
		mouseNow.mouseover(function(){
			$(this).css("opacity",".8");
		});
		mouseNow.mouseout(function(){
			$(this).css("opacity","1");
		});
		
		
		$("#firstHead,#secondHead,#thirdHead,#fourHead,#fiveHead,#sixHead").click(function(){
			$(".specialZhgjNow li").removeClass("active");
			$(this).addClass("active");
			var id=$(this).attr("id");
			$("#secondNumList").show();
			$("#secondNumList li").removeClass("active");
			$("#firstNumList li").removeClass("active");
            $("#zhgjClear").trigger("click");
			if(id=="firstHead"){
				$("#tip").html("定位选(从0-9中选择5个号码)");
				$("#secondNumList").hide();
				$("#firstNumList span").html("选号");
			}else if(id=="secondHead"){
				$("#tip").html("定位选(从“二重号”选择一个号码，“单号”中选择三个号码)");
				$("#firstNumList span").html("二重号");
				$("#secondNumList span").html("单号");
			}else if(id=="thirdHead"){
				$("#tip").html("定位选(从“二重号”选择两个号码，“单号”中选择一个号码)");
				$("#firstNumList span").html("二重号");
				$("#secondNumList span").html("单号");
			}else if(id=="fourHead"){
				$("#tip").html("定位选(从“三重号”选择一个号码，“单号”中选择两个号码)");
				$("#firstNumList span").html("三重号");
				$("#secondNumList span").html("单号");
			}else if(id=="fiveHead"){
				$("#tip").html("定位选(从“三重号”选择一个号码，“二重号”中选择一个号码)");
				$("#firstNumList span").html("三重号");
				$("#secondNumList span").html("二重号");
			}else if(id=="sixHead"){
				$("#tip").html("定位选(从“四重号”选择一个号码，“单号”中选择一个号码)");
				$("#firstNumList span").html("四重号");
				$("#secondNumList span").html("单号");
			}
		});
		
		
		/*全大小单双鼠标移上去变颜色*/
		var hoverNow=$(".specialNew button");
		hoverNow.hover(function(){
			$(this).siblings().removeClass("hoverStyle");
			$(this).addClass("hoverStyle");
		},function(){
			$(this).removeClass("hoverStyle");
		});
	});
});