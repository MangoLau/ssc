<?php
	$para=$_GET;
	
	// 用户限制
	if($para['username'] && $para['username']!="用户名"){
		$userWhere="and u.username like '%{$para['username']}%'";
	}
	
	// $this->pageSize=3;

	$sql="select b.name bankName, i.*, u.username userAccount from {$this->prename}member_bank i, {$this->prename}bank_list b, {$this->prename}members u where b.id=i.bankId and i.uid=u.uid and b.isDelete=0 and i.enable=1 $userWhere";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<article class="module width_full">
    <header>
    	<h3 class="tabs_involved">银行信息
            <form action="/wjadmin.php/member/bank" target="ajax" dataType="html" class="submit_link wz" call="defaultSearch" >
                会员名：<input type="text" class="alt_btn"  name="username" placeholder="会员名"/>&nbsp;&nbsp;
               <input type="submit" value="查找" class="alt_btn">
            </form>
        </h3>
    </header>
	<table class="tablesorter" cellspacing="0">
	<thead>
		<tr>
			<td>会员编号</td>
			<td>用户名</td>
			<td>银行名称</td>
			<td>银行账号</td>
			<td>开户姓名</td>
		</tr>
	</thead>
	<tbody>
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
		<tr>
			<td><?=$var['uid']?></td>
			<td><?=$var['userAccount']?></td>
			<td><?=$var['bankName']?></td>
			<td><?=$var['account']?></td>
			<td><?=$var['username']?></td>
		</tr>
	<?php } ?>

	</tbody>
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/bank-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
	</footer>
</article>