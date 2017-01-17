<div class="manager-edit">
<form action="/wjadmin.php/manage/changeManagerPwd/<?=$args[0]?>" target="ajax" method="post" call="manageChangePwd" onajax="manageBeforeChangePwd">
<table class="tablesorter left" cellspacing="0"> 
	<tbody> 
		<tr> 
			<td>用户名</td> 
			<td><?=$this->getValue("select username from {$this->prename}members where uid=?", $args[0])?></td> 
		</tr> 
		<tr> 
			<td>原始密码</td> 
			<td><input type="password" value="" name="oldpwd"/></td> 
		</tr> 
		<tr> 
			<td>更改密码</td> 
			<td><input type="password" value="" name="password"/></td> 
		</tr> 
		<tr> 
			<td>再次输入密码</td> 
			<td><input type="password" value="" class="cpwd"></td> 
		</tr> 
	</tbody> 
</table>
</form>
</div>