define(function(require,exports,module){
	var global = require("global");
	exports.loadNews = function(){
		$.ajax({
			type:"POST",
			url : "/news/index" ,
			dataType:"JSON",
			success:function(d){
				if(d.success){
					var list = d.NEWS;
					$("#NEWS").html("");
					var buffer = new StringBuilder();
					if(list){
						$.each(list , function(i,n){
							buffer.append('<li><span>【新闻资讯】</span><a href="news/newInfoDetail/' + n.id + '" title='+ n.title + '>'+ n.title + '</a></li>');
							if(i >= 4){
								return false;
							}
						});
						$("#NEWS").html(buffer.toString());
					}
					//今日推荐
					list = d.JINRITUIJIAN;
					if(list){
						$("#JINRITUIJIAN").html("");
						buffer = new StringBuilder();
						$.each(list , function(i,n){
							buffer.append('<li><span>【今日推荐】</span><a href="news/recommendDetail/' + n.id + '" title='+ n.title + '>'+ n.title + '</a></li>');
							if(i >= 4){
								return false;
							}
						});
						$("#JINRITUIJIAN").html(buffer.toString());
					}
					//公告
					list = d.GONGGAO;
					if(list){
						$("#GONGGAO").html("");
						buffer = new StringBuilder();
						$.each(list , function(i,n){
							buffer.append('<li><a href="news/noticeDetail/' + n.id + '" title='+ n.title + '>'+ n.title + '</a></li>');
							if(i >= 4){
								return false;
							}
						});
						$("#GONGGAO").html(buffer.toString());
					}
					//投注技巧
					list = d.TOUZHUJIQIAO;
					if(list){
						$("#TOUZHUJIQIAO").html("");
						buffer = new StringBuilder();
						$.each(list , function(i,n){
							buffer.append('<li><a href="news/skillDetail/' + n.id + '" title='+ n.title + '>'+ n.title + '</a></li>');
							if(i >= 4){
								return false;
							}
						});
						$("#TOUZHUJIQIAO").html(buffer.toString());
					}
					
				}else{
					alert("加载新闻信息为空！");
				}
			},
			error:function(xhr){
				alert("服务器忙，请稍后重试！");
			}
		});
	};

	$(function(){
		exports.loadNews();
	})
	
})