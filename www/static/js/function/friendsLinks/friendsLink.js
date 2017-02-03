define(function(require,exports,module){
	require("globalPath/globalUtils");
	
	exports.iniHref=function(){
		$(".friendsLinks").click(function(){
			var url = $.trim($(this).attr("url")),
			name = $.trim($(this).text());
			$.ajax({
				type:"POST",
				url:"/friendsLinks/clickHref",
				data:{
					"name":name
				},
				dataType:"JSON",
				async:false,
				success:function(r){
					window.open(url);
				},
				error:function(xhr){
					console.info(xhr);
				}
			});
		});
	};
	exports.loadFriendsLinks=function(){
		$.ajax({
			type:"POST",
			url:"/friendsLinks/load",
			dataType:"JSON",
			async:true,
			success:function(r){
				if(r.success){
					$("#friendsLinksDiv").show();
					var buffer = new StringBuilder();
					$.each(r.list,function(index,item){
						buffer.append('<li><a href="javascript:(0);" class="friendsLinks" url="'+item.value+'">'+item.key+'</a></li>');
					});
					$("#friendsLinksUl").html(buffer.toString());
					exports.iniHref();
				}else{
					$("#friendsLinksDiv").hide();
				}
			},
			error:function(xhr){
				console.info(xhr);
			}
		});
	};
	
	$(function(){
		exports.loadFriendsLinks();
		
		
	});
	
	
});







