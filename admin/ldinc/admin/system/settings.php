<article class="module width_full">
	<header><h3 class="tabs_involved">系统设置</h3></header>
	<form name="system_install" action="/wjadmin.php/system/updateSettings" method="post" target="ajax" call="sysSettings" onajax="sysSettingsBefor">
	<table class="tablesorter left" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td width="160" style="text-align:left;">配置项目</td>
				<td style="text-align:left;">配置值</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>平台名称</td>
				<td><input type="text" value="<?=$this->settings['webName']?>" name="webName"/></td>
			</tr>
			<tr>
				<td>网站服务开关</td>
				<td>
					<label><input type="radio" value="1" name="switchWeb" <?=$this->iff($this->settings['switchWeb'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchWeb" <?=$this->iff(!$this->settings['switchWeb'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
		
			<tr>
				<td>关闭网站公告</td>
				<td>
					<textarea name="webCloseServiceResult" cols="56" rows="5"><?=$this->settings['webCloseServiceResult']?></textarea>
				</td>
			</tr>
            <tr>
				<td>投注功能开关</td>
				<td>
					<label><input type="radio" value="1" name="switchBuy" <?=$this->iff($this->settings['switchBuy'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchBuy" <?=$this->iff(!$this->settings['switchBuy'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>代理投注开关</td>
				<td>
					<label><input type="radio" value="1" name="switchDLBuy" <?=$this->iff($this->settings['switchDLBuy'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchDLBuy" <?=$this->iff(!$this->settings['switchDLBuy'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>最大返点限制</td>
				<td>
                	  元模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian0']?>" name="betModeMaxFanDian0"/>%
                	　角模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian1']?>" name="betModeMaxFanDian1"/>%
                	　分模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian2']?>" name="betModeMaxFanDian2"/>%
                </td>
			</tr>
			<tr>
				<td>最大投注限制</td>
				<td>
                	  最大注数：<input type="text" class="textWid1" value="<?=$this->settings['betMaxCount']?>" name="betMaxCount"/>注
                	　最大中奖：<input type="text" class="textWid1" value="<?=$this->settings['betMaxZjAmount']?>" name="betMaxZjAmount"/>元
                </td>
			</tr>
           
			<tr>
				<td>充值限制</td>
				<td>
                	最低金额：<input type="text" class="textWid1" value="<?=$this->settings['rechargeMin']?>" name="rechargeMin"/>元&nbsp;&nbsp; 
                    最高金额：<input type="text" class="textWid1" value="<?=$this->settings['rechargeMax']?>" name="rechargeMax"/>元
                    <br /><br />
                	支付宝/财付通：最低金额 <input type="text" class="textWid1" value="<?=$this->settings['rechargeMin1']?>" name="rechargeMin1"/>元&nbsp;&nbsp;最高金额 <input type="text" class="textWid1" value="<?=$this->settings['rechargeMax1']?>" name="rechargeMax1"/>元&nbsp;&nbsp;
                    
                </td>
			</tr>
			<tr>
				<td>提现限制</td>
				<td>
                	消费满：<input type="text" class="textWid1" value="<?=$this->settings['cashMinAmount']?>" name="cashMinAmount"/>%&nbsp;&nbsp;
					最低金额：<input type="text" class="textWid1" value="<?=$this->settings['cashMin']?>" name="cashMin"/>元&nbsp;&nbsp;
					最高金额：<input type="text" class="textWid1" value="<?=$this->settings['cashMax']?>" name="cashMax"/>元&nbsp;&nbsp;
					时间段： 从 <input type="time" value="<?=$this->settings['cashFromTime']?>" name="cashFromTime" class="textWid1"/> 到 <input type="time" value="<?=$this->settings['cashToTime']?>" name="cashToTime" class="textWid1"/>
                    <br /><br />
                	支付宝/财付通：最低金额 <input type="text" class="textWid1" value="<?=$this->settings['cashMin1']?>" name="cashMin1"/>元&nbsp;&nbsp;最高金额 <input type="text" class="textWid1" value="<?=$this->settings['cashMax1']?>" name="cashMax1"/>元&nbsp;&nbsp;
				</td>
			</tr>
			<tr>
				<td>清理账号规则</td>
				<td>账户金额低于&nbsp;<input type="text" value="<?=$this->settings['clearMemberCoin']?>" name="clearMemberCoin" id="clearMemberCoin"/>元，&nbsp;且&nbsp;<input type="text" value="<?=$this->settings['clearMemberDate']?>" name="clearMemberDate" id="clearMemberDate"/> &nbsp;天未登录&nbsp;&nbsp;<a method="post" target="ajax" onajax="clearUsersBefor" call="clearDataSuccess" title="数据清除不可修复，是否继续！" dataType="json" id="alt_btn3" href="/wjadmin.php/System/clearUser">清理</a></td>
			</tr>
			<tr>
				<td>清理数据</td>
				<td>清除当前 <input type="date" readonly="readonly" id="clearData" /> 日期及以前数据&nbsp;&nbsp;<a method="post" target="ajax" onajax="clearDataBefor" call="clearDataSuccess" title="数据清除不可修复，是否继续！" dataType="json" id="alt_btn3" href="/wjadmin.php/System/clearData">清理</a></td>
			</tr>
			<tr>
				<td>赠送活动</td>
				<td>首次注册绑定工行送<input class="textWid1" type="text" value="<?=$this->settings['huoDongRegister']?>" name="huoDongRegister"/>元 &nbsp;&nbsp;每天签到每次送<input type="text" class="textWid1" value="<?=$this->settings['huoDongSign']?>" name="huoDongSign"/>元，如果为0则关闭活动</td>
			</tr>
			<tr>
				<td>充值佣金活动</td>
				<td>每天首次充值金额<input class="textWid1" type="text" value="<?=$this->settings['rechargeCommissionAmount']?>" name="rechargeCommissionAmount"/>元以上，上家送<input type="text" class="textWid1" value="<?=$this->settings['rechargeCommission']?>" name="rechargeCommission"/>元佣金，上上家送<input class="textWid1" type="text" value="<?=$this->settings['rechargeCommission2']?>" name="rechargeCommission2"/>元佣金，如果为0则关闭活动</td>
			</tr>
			<tr>
				<td>消费佣金活动</td>
				<td>
				<p>每天消费达<input class="textWid1" type="text" value="<?=$this->settings['conCommissionBase']?>" name="conCommissionBase"/>元时，上家送<input  class="textWid1"type="text" value="<?=$this->settings['conCommissionParentAmount']?>" name="conCommissionParentAmount"/>元佣金，上上家送<input  class="textWid1"type="text" value="<?=$this->settings['conCommissionParentAmount2']?>" name="conCommissionParentAmount2"/>元佣金，如果为0则关闭活动</p>
				</p></td>
			</tr>
			<tr>
				<td>返点最大值</td>
				<td><input type="text" value="<?=$this->settings['fanDianMax']?>" name="fanDianMax"/>% &nbsp;&nbsp;不定位返点最大值<input type="text" value="<?=$this->settings['fanDianBdwMax']?>" name="fanDianBdwMax"/>%</td>
			</tr>
			<tr>
				<td>上下级返点最小差值</td>
				<td><input type="text" value="<?=$this->settings['fanDianDiff']?>" name="fanDianDiff"/>%</td>
			</tr>
			<tr>
				<td>最低限制人数返点</td>
				<td><input type="text" value="<?=$this->settings['minFanDianUserCount']?>" name="minFanDianUserCount"/>%</td>
			</tr>
			<tr>
				<td>积分比例</td>
				<td>
					<input type="text" value="<?=$this->settings['scoreProp']?>" name="scoreProp"/> 每消费1元积的分数
				</td>
			</tr>
			<tr>
				<td>积分规则</td>
				<td>
					<textarea name="scoreRule" cols="56" rows="5"><?=$this->settings['scoreRule']?></textarea>
				</td>
			</tr>
            <tr>
				<td>客服状态</td>
				<td>
					<label><input type="radio" value="1" name="kefuStatus" <?=$this->iff($this->settings['kefuStatus'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="kefuStatus" <?=$this->iff(!$this->settings['kefuStatus'],'checked="checked"')?>/>关闭</label>

				</td>
			</tr>
			<tr>
				<td>客服链接</td>
				<td>
					<textarea name="kefuGG" cols="56" rows="5"><?=$this->settings['kefuGG']?></textarea>
				</td>
			</tr>
			<tr>
				<td>网站公告</td>
				<td>
					<textarea name="webGG" cols="56" rows="5"><?=$this->settings['webGG']?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
			<input type="submit" value="保存修改设置" title="保存设置" class="alt_btn">&nbsp;&nbsp;
			<input type="button" onclick="load('system/settings')" value="重置" title="重置原来的设置" >
		</div>
	</footer>
	</form>
</article>