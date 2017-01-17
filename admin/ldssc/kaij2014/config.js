// 彩票开奖配置 http://www.500wan.com/static/public/ssc/xml/newlyopen.xml
exports.cp=[
	//{{{
		{
		title:'cqssc',
		source:'cailele',
		name:'cqssc',
		enable:true,
		timer:'cqssc',

		option:{
			host:"www.cailele.com",
			timeout:30000,
			path: '/static/ssc/newlyopenlist.xml',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				str=str.substr(0,300);
				var m;
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)" \/>/;              
				if(m=str.match(reg)){
					return {
						type:1,
						time:m[3],
						number:m[1].replace(/^(\d{8})(\d{3})$/, '$1-$2'),
						data:m[2]
					};
				}
			}catch(err){
				throw('重庆时时彩解析数据不正确');
			}
		}
	},
	//}}}
		
	//{{{
	{
		title:'五分彩',
		source:'xgssc',
		name:'xgssc',
		enable:true,
		timer:'xgssc',

		option:{
			host:"333.blssc.net",
			timeout:30000,
			path: '/index.php/blylss/xml',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "
			}
		},
		parse:function(str){
			try{
				str=str.substr(0,200);
				var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				//<row expect="20130720017" opencode="4,9,1,2,9" opentime="2013-07-20 01:25:30"/>
				var m;
				
				if(m=str.match(reg)){
					return {
						type:14,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}					
				
			}catch(err){
				throw('五分彩解析数据不正确');
			}
		}
	},
	//}}}

	//{{{
	{
		title:'两分彩',
		source:'xg2fc',
		name:'xg2fc',
		enable:true,
		timer:'xg2fc',

		option:{
			host:"333.blssc.net",
			timeout:30000,
			path: '/index.php/blylss/xml2',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "
			}
		},
		parse:function(str){
			try{
				str=str.substr(0,200);
				var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				//<row expect="20130720017" opencode="4,9,1,2,9" opentime="2013-07-20 01:25:30"/>
				var m;
				
				if(m=str.match(reg)){
					return {
						type:31,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}					
				
			}catch(err){
				throw('两分彩解析数据不正确');
			}
		}
	},
	//}}}
	
	//{{{
	{
		title:'SD115',
		source:'cailele',
		name:'sd11x5',
		enable:true,
		timer:'sd11x53',

		option:{
			host:"www.cailele.com",
			timeout:30000,
			path: '/lottery/11yun/',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			return getFromCalilecWeb(str,7);
		}
	},
	//}}}
	
	//{{{
	{
		title:'CQ115',
		source:'cailele',
		name:'cq11x5',
		enable:true,
		timer:'cq11x5',

		option:{
			host:"www.cailele.com",
			timeout:30000,
			path: '/static/cq11x5/newlyopenlist.xml',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				//return getFromCaileWeb(str,15);
				str=str.substr(0,200);
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				//<row expect="2013071985" opencode="09,08,06,04,05" opentime="2013-07-19 23:00:20"/>
				var m;
	
				if(m=str.match(reg)){
					return {
						type:15,
						time:m[3],
						number:m[1].replace(/^(\d{8})(\d{2})$/, '$1-0$2'),
						data:m[2]
					};
				}					
			}catch(err){
				throw('重庆11选5解析数据不正确');
			}
		}
	},
	//}}}
	
	//{{{
	{
		title:'GD115',
		source:'cailele',
		name:'gd11x5',
		enable:true,
		timer:'gd11x5',

		option:{
			host:"www.cailele.com",
			timeout:30000,
			path: '/static/gd11x5/newlyopenlist.xml',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				//return getFromCaileWeb(str,6);
				str=str.substr(0,200);
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				//<row expect="2013071984" opencode="04,11,05,03,07" opentime="2013-07-19 23:00:15"/>
				var m;
	
				if(m=str.match(reg)){
					return {
						type:6,
						time:m[3],
						number:m[1].replace(/^(\d{8})(\d{2})$/, '$1-0$2'),
						data:m[2]
					};
				}					
			}catch(err){
				throw('广东11选5解析数据不正确');
			}
		}
	},
	//}}}
	
	//{{{
	{
		title:'北京PK10',
		source:'娱乐平台',
		name:'bjpk10',
		enable:true,
		timer:'bjpk10',

		option:{

			host:"www.bwlc.net",
			timeout:50000,
			path: '/bulletin/trax.html',
			headers:{
				"User-Agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/29.0.1271.64 Safari/537.11"
			}
		},
		
		parse:function(str){
			try{
				return getFromPK10(str,20);
			}catch(err){
				throw('解析数据不正确');
			}
		}
	},
	//}}}
	

	//{{{
	{
		title:'3D',
		source:'500wan',
		name:'fc3d',
		enable:true,
		timer:'fc3d',

		option:{
			host:"www.500wan.com",
			timeout:30000,
			path: '/static/info/kaijiang/xml/sd/list10.xml',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				str=str.substr(0,300);
				var m;
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)" trycode="[\d\,]*?" tryinfo="" \/>/;                                      
				if(m=str.match(reg)){
					return {
						type:9,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}
			}catch(err){
				throw('3D解析数据不正确');
			}
		}
	},
	//}}}
	
	//{{{
	{
		title:'P3',
		source:'500wan',
		name:'pai3',
		enable:true,
		timer:'pai3',

		option:{
			host:"www.500wan.com",
			timeout:30000,
			path: '/static/info/kaijiang/xml/pls/list10.xml',
			headers:{
				"User-Agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/25.0.1271.64 Safari/537.11"
			}
		},
		
		parse:function(str){
			try{
				str=str.substr(0,300);
				var m;	 
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/;
				if(m=str.match(reg)){
					return {
						type:10,
						time:m[3],
						number:20+m[1],
						data:m[2]
					};
				}
			}catch(err){
				throw('P3解析数据不正确');
			}
		}
	},
	//}}}
	
	//{{{
	{
		title:'XJC',
		source:'xjflcp',
		name:'xjssc',
		enable:true,
		timer:'xjssc',

		option:{
			host:"www.xjflcp.com",
			timeout:30000,
			path: '/ssc/',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				return getFromXJFLCPWeb(str,12);
			}catch(err){
				throw('新疆时时彩解析数据不正确');
			}
		}
	},
	//}}}

	//{{{
	{
		title:'cqklsf',
		source:'cailele',
		name:'cqklsf',
		enable:true,
		timer:'cqklsf',

		option:{
			host:"www.cailele.com",
			timeout:50000,
			path: '/lottery/cqklsf/',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				return getFromCaileleWeb_1(str,18);
			}catch(err){
				throw('重庆快乐十分解析数据不正确');
			}
		}
	},
        //}}}

	//{{{
	{
		title:'jsk3',
		source:'ceilele',
		name:'jsk3',
		enable:true,
		timer:'jsk3', 

		option:{
			host:"www.cailele.com",
			timeout:50000,
			path: '/lottery/k3/',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		parse:function(str){
			try{
				return getFromCaileleWeb_1(str,25);
			}catch(err){
				throw('江苏快3解析数据不正确');
			}
		}
	},
    //}}}

	//{{{
	{
		title:'JXC',
		source:'cailele',
		name:'jxssc',
		enable:true,
		timer:'jxssc',

		option:{
			host:"www.cailele.com",
			timeout:30000,
			path: '/static/jxssc/newlyopenlist.xml',
			headers:{
				"User-Agent": "Opera/8.0 (Macintosh; PPC Mac OS X; U; en)"
			}
		},
		
		parse:function(str){
			try{
				//return getFromShishicaiWeb(str,3);
				str=str.substr(0,200);
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				//<row expect="20130719084" opencode="3,0,6,3,6" opentime="2013-07-19 23:12:25"/>
				var m;
	
				if(m=str.match(reg)){
					return {
						type:3,
						time:m[3],
						number:m[1].replace(/^(\d{8})(\d{3})$/, '$1-$2'),
						data:m[2]
					};
				}	
			}catch(err){
				throw('江西时时彩解析数据不正确');
			}
		}
	},
//}}}

];

// 出错时等待
exports.errorSleepTime=15;

// 重启时间间隔，以小时为单位，0为不重启
exports.restartTime=0;

exports.submit={
	//host:'www.ssc.com',
	host:'localhost',
	path:'/admin.php/dataSource/kj'
}

exports.dbinfo={
	host:'localhost',
	user:'user',
	password:'bhpKh3cwN4FCKVAA',
	database:'ssc2014'
}

global.log=function(log){
	var date=new Date();
	console.log('['+date.toDateString() +' '+ date.toLocaleTimeString()+'] '+log)
}

  function strtotime(str){
            var new_str = str.replace(/\:/g,'-');
            new_str = new_str.replace(/\ /g,'-');
            var arr = new_str.split("-");
            arr[4] = arr[4] == undefined ? '0' : arr[4];
            arr[5] = arr[5] == undefined ? '0' : arr[5];
            arr[3] = arr[3] == undefined ? '0' : arr[3];
            var datum = new Date(Date.UTC(arr[0],arr[1]-1,arr[2],arr[3]-8,arr[4],arr[5]));
            return datum.getTime()/1000;
        }

function getFromShishicaiWeb(str, type, char){
	//var reg=/var\s*listIssue\s*\=\s*\[(.*?)\,{/,
	var reg=/\{\"i\"\:\"[\d\-]+\"\,\"b\"\:\"[\d\,]+\"\,\"s\"\:\d+\,\"et\"\:\"[\d\-\: ]+\"\}/,
	match=str.match(reg);
	matchData=str.split('kkListNumber.show(["')[1].split('",')[0];
	if(type!=7) matchData=matchData.split('').join(',');
	//console.log(matchData);
	char=char||'';
	if(!match) throw new Error('数据不正确');
	
	// 解析数据
	try{
		var data=JSON.parse(match[0]);

		data={
			type:type,
			time:data.et,
			number:data.i,
			data:matchData
			//data:data.b.split(char).join(',')
		}
		//console.log(data);
		return data;
		
	}catch(err){
		throw('解析数据失败：'+match[1]);
	}
}

function getFromCaileleWeb_1(str, type){
	str=str.substr(str.indexOf('<tbody id="openPanel">'), 120).replace(/[\r\n]+/g,'');
         
	var reg=/<tr.*?>[\s\S]*?<td.*?>(\d+)<\/td>[\s\S]*?<td.*?>([\d\:\- ]+?)<\/td>[\s\S]*?<td.*?>([\d\,]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	//console.log(match);
	var number,_number,number2;
	var d = new Date();
	var y = d.getFullYear();
	if(match[1].length==9 || match[1].length==8){number='20'+match[1];}else if(match[1].length==7){number='2014'+match[1];}else{number=match[1];}
	_number=number;
	if(number.length==11){number2=number.replace(/^(\d{8})(\d{3})$/, '$1-$2');}else{number2=number.replace(/^(\d{8})(\d{2})$/, '$1-0$2');_number=number.replace(/^(\d{8})(\d{2})$/, '$10$2');}
	try{
		var data={
			type:type,
			time:_number.replace(/^(\d{4})(\d{2})(\d{2})\d{3}/, '$1-$2-$3 ')+match[2],
			number:number2,
			data:match[3]
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFrom6ie6Web(str, type){

	try{
		str=str.substr(str.indexOf('class="rec_table">'),3000).replace(/[\r\n]+/g,'').replace(/[\t]+/g,'').replace(/&nbsp;/g,'').replace(/\ /g,'');
		str=str.substr(str.indexOf('<tbody>'),600);
		str = str.split("\<\/tr\>\<tr\>")[1];
		str = str.split("\<\/td\>\<td");
		var number = str[0].replace(/\<td\>/g,"");
		var time =str[6].substr(1,str[6].indexOf('</td>')-1);
		time = time.substr(0,10)+" "+time.substr(10,time.length);
		time = new Date(time);
		time = (time.getFullYear()+"-"+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":00");
	
		var data={
			type:type,
			time:time,
			number:number.substr(0,8)+"-"+number.substr(8,number.length),
			data:str[1].replace(/\>/g,"")
		}
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}

function getFromPK10(str, type){

	str=str.substr(str.indexOf('<div class="lott_cont">'),350).replace(/[\r\n]+/g,'');
    //console.log(str);
	var reg=/<tr class=".*?">[\s\S]*?<td>(\d+)<\/td>[\s\S]*?<td>(.*)<\/td>[\s\S]*?<td>([\d\:\- ]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	//console.log(match);
	try{
		var data={
			type:type,
			time:match[3],
			number:match[1],
			data:match[2]
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}

function getFromCaileleWeb(str, type){

	//console.log(str);
	str=str.substr(str.indexOf('<tr bgcolor="#FFFAF3">'),540);
	
	//console.log(str);
	
	var reg=/<td.*?>(\d+)<\/td>[\s\S]*?<td.*?>([\d\- \:]+)<\/td>[\s\S]*?<td.*?>((?:[\s\S]*?<div class="ball_yellow">\d+<\/div>){3,5})\s*<\/td>/,
	match=str.match(reg);
	
	//console.log(match);
	
	//console.log(str);
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:match[2],
			number:'20'+match[1].replace(/^(\d{6})/,'$1-')
		}
		
		reg=/<div.*>(\d+)<\/div>/g;
		data.data=match[3].match(reg).map(function(v){
			var reg=/<div.*>(\d+)<\/div>/;
			return v.match(reg)[1];
		}).join(',');
		
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}

function getFromCaileWeb(str, type){

	//console.log(str);
	str=str.substr(str.indexOf('<tr bgcolor="#FFFAF3">'),540);
	
	//console.log(str);
	
	var reg=/<td.*?>(\d+)<\/td>[\s\S]*?<td.*?>([\d\- \:]+)<\/td>[\s\S]*?<td.*?>((?:[\s\S]*?<div class="ball_yellow">\d+<\/div>){3,5})\s*<\/td>/,
	match=str.match(reg);
	
	//console.log(match);
	
	//console.log(str);
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:match[2],
			number:match[1].replace(/^(\d{8})/,'$1-0')
		}
		
		reg=/<div.*>(\d+)<\/div>/g;
		data.data=match[3].match(reg).map(function(v){
			var reg=/<div.*>(\d+)<\/div>/;
			return v.match(reg)[1];
		}).join(',');
		
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}


function getFromCalilebWeb(str, type){
	//console.log(str);
	str=str.substr(str.indexOf('<tbody id="openPanel">'),100);
	var reg=/.*(\d{8}).*([\d+\:]{5}).*([\d+,]{14})<\/td><\/tr>/,
	
	match=str.match(reg);
	dat=new Date();
	preYear=dat.getFullYear();
	preMonth=dat.getMonth()+1;
	preDate=dat.getDate();
	date=preYear+'-'+preMonth+'-'+preDate;
	
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:date+' '+match[2]+':00',
			number:'20' + match[1].replace(/(\d{6})(\d{2})/,'$1-0$2'),
			data:match[3]
		}
		

		return data;
	}catch(err){
		throw('解析数据失败');
	}
}


function getFromCalilecWeb(str, type){
	//console.log(str);
	str=str.substr(str.indexOf('<tbody id="openPanel">'),100);
	var reg=/.*(\d{6}).*([\d+\:]{5}).*([\d+,]{14})<\/td><\/tr>/,
	
	match=str.match(reg);
	dat=new Date();
	preYear=dat.getFullYear();
	preMonth=dat.getMonth()+1;
	preDate=dat.getDate();
	date=preYear+'-'+preMonth+'-'+preDate;
	
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:date+' '+match[2]+':00',
			number:preYear + match[1].replace(/(\d{4})(\d{2})/,'$1-0$2'),
			data:match[3]
		}
		

		return data;
	}catch(err){
		throw('解析数据失败');
	}
}


function getFromiCailecWeb(str, type){
	//console.log(str);
	str=str.substr(str.indexOf('<tbody id="openPanel">'),100);
	var reg=/.*(\d{6}).*([\d+\:]{5}).*([\d+,]{14})<\/td><\/tr>/,
	
	match=str.match(reg);
	dat=new Date();
	preYear=dat.getFullYear();
	preMonth=dat.getMonth()+1;
	preDate=dat.getDate();
	date=preYear+'-'+preMonth+'-'+preDate;
	
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:date+' '+match[2]+':00',
			number:preYear + match[1].replace(/(\d{4})(\d{2})/,'$1-0$2'),
			data:match[3]
		}
		

		return data;
	}catch(err){
		throw('解析数据失败');
	}
}


function getFromXJFLCPWeb(str, type){
	str=str.substr(str.indexOf('<td><a href="javascript:detatilssc'), 300).replace(/[\r\n]+/g,'');
         
	var reg=/(\d{10}).+(\d{2}\:\d{2}).+<p>([\d ]{9})<\/p>/,
	match=str.match(reg);
	
	if(!match) throw new Error('数据不正确');
	//console.log('期号：%s，开奖时间：%s，开奖数据：%s', match[1], match[2], match[3]);
	
	try{
		var data={
			type:type,
			time:match[1].replace(/^(\d{4})(\d{2})(\d{2})\d{2}/, '$1-$2-$3 ')+match[2],
			number:match[1].replace(/^(\d{8})(\d{2})$/, '$1-$2'),
			data:match[3].split(' ').join(',')
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromICAILESH11X5Web(str, type){
	str=str.substr(str.indexOf('class=f12'),300).replace(/[\r\n]+/g,'').replace(/[\t]+/g,'').replace(/&nbsp;/g,'').replace(/\ /g,'').split("\<\/td\>\<\/tr\>")[0].split("\<\/td\>\<td\>");   
	if(str.length < 3) throw new Error('数据不正确');
	var date = str[1].split("\>")[1]+","+str[2].split("\>")[1]+","+str[3].split("\>")[1]+","+str[4].split("\>")[1]+","+str[5].split("\>")[1];
	str[0] = "20"+str[0].split("\<td\>")[1];
	var num__c = str[0].substr(8,str[0].length);
	if(num__c.length < 2){
		num__c = "00"+num__c;
	}else if(num__c.length < 3){
		num__c = "0"+num__c;
	}
	var num = str[0].substr(0,8)+"-"+num__c;
	var time = new Date(new Date().getFullYear()+"-"+(new Date().getMonth()+1)+"-"+new Date().getDate()+" 09:00").getTime() + (parseInt(str[0].substr(8,str[0].length))*10*60*1000);
	time = new Date(time);
	time = (time.getFullYear()+"-"+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":00");
	try{
		var data={
			type:type,
			time:time,
			number:num,
			data:date
		}
		

		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromLecaiWeb(str, type){
	str=str.substr(str.indexOf('class="px12line21"'),600).replace(/[\r\n]+/g,'').replace(/[\t]+/g,'').split("\<\/td\>\<td\>");   
	str = str[2].replace(/&nbsp;/g,'').replace(/\ /g,'').split("\<\/td\>\<td\>");
	if(str.length < 2) throw new Error('数据不正确');
	var date = str[1];
	str[0] = "20"+str[0];
	var num = str[0].substr(0,8)+"-"+str[0].substr(8,str[0].length);
	var time = new Date(new Date().getFullYear()+"-"+(new Date().getMonth()+1)+"-"+new Date().getDate()+" 09:00").getTime() + (parseInt(str[0].substr(8,str[0].length))*10*60*1000);
	time = new Date(time);
	time =(time.getFullYear()+"-"+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":00");
	try{
		var data={
			type:type,
			time:time,
			number:num,
			data:date
		}
		console.log("date+++++++++++++++++++++++++++++++++++++++",data);		

		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromLecaiaWeb(str, type){
	str=str.substr(str.indexOf('class="newsPrize"'),500).replace(/[\r\n]+/g,'').replace(/[\t]+/g,'').split("\<\/td\>\<\/tr\>\<tr\>\<td\>");  
	if(str.length < 3) throw new Error('数据不正确');
	str = str[1].split("\<\/td\>\<td\>");
	if(str.length < 2) throw new Error('数据不正确');
	var date = str[1].trim().replace(/\ /g,"\,").split(",");
	for(var i = 0; i< date.length; i++){
		if(date[i].length < 2){
			date[i] = "0"+date[i];
		}
	};
	date = date.toString();
	var num = str[0].substr(0,8)+"-"+str[0].substr(8,str[0].length);
	var time = new Date(new Date().getFullYear()+"-"+(new Date().getMonth()+1)+"-"+new Date().getDate()+" 09:00").getTime() + (parseInt(str[0].substr(8,str[0].length))*12*60*1000);  //格式如：20131224-001  03,12,05,07,02 09:12:00 
	time = new Date(time);
	time = (time.getFullYear()+"-"+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":00");
	try{
		var data={
			type:type,
			time:time,
			number:num,
			data:date
		}

		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromLecaibWeb(str, type){
	var reg=/width=\"100%\" id=\"kj_table_1\">.*?<\/table>/;
	str=reg.exec(str)[0].replace(/\s+/g,'').replace(/<\/?span.*?>/g, '');
			//<tr ><td>372834期</td><td>23:12</td><td>05040801071003020609</td></tr>
	
	reg=/(\d{6}).*([\d+\:]{5}).*(\d{20})/;
	var m=reg.exec(str);
	dat=new Date();
	preYear=dat.getFullYear();
	preMonth=dat.getMonth()+1;
	preDate=dat.getDate();
	date=preYear+'-'+preMonth+'-'+preDate

	var data={};

	data.type=type,
	data.number=m[1];
	data.time=dat;
	data.data=m[3].replace(/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1,$2,$3,$4,$5,$6,$7,$8,$9,$10');

	return data;
}
