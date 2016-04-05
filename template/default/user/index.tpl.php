<?php
if(!defined('INDEX')){
	exit('Access Denied');
}

if($dduser['email']==''){
	jump(u('user','info',array('from'=>u('user','index'))),'请先绑定邮箱');
}

if($dduser['mobile']==0){
	jump(u('user','info',array('from'=>u('user','index'))),'请先设置手机号');
}

$parameter=act_user_index();
extract($parameter);
if($dduser['txstatus']=='1'){
	$txstate_msg = "您当前有一笔提取申请正在处理当中，请耐心等待！ <a href='".u('user','mingxi',array('do'=>'out'))."'>>>查看详细</a>";
}else{
	if($dduser['money']==0){
		$txstate_msg = "感谢您使用".WEBNAME."，当您购物累积获得返利超过".$webset['tixian']['limit']."元，就可以申请提取。祝您购物愉快！";
	}elseif($dduser['live_money']<$webset['tixian']['limit']){
		$txstate_msg = '亲！您当前的可用余额是 <span>'.$dduser['live_money'].'</span> 元，还差 <span>'.($webset['tixian']['limit']-$dduser['live_money']).'</span> 元就可以申请提取了！';
	}else{
		$txstate_msg = "亲！您当前的可用余额是<span>".$dduser['live_money']."</span> 元，可以申请提取了！&nbsp;&nbsp;&nbsp;&nbsp;<img style='margin-bottom:-10px' src='images/face/2.gif'/><a href='".u('user','tixian',array('type'=>2))."'><b style='color:red;cursor:pointer'>申请提取</b>>>></a>";
	}
}

if(JIFENBAO==2){
	if($dduser['live_jifenbao']>0){
		$tbtxstate_msg = "亲！您当前的可用".TBMONEY."是<span>".$dduser['live_jifenbao'].TBMONEYUNIT."</span>，可以兑换商品了！&nbsp;&nbsp;&nbsp;&nbsp;<img style='margin-bottom:-10px' src='images/face/2.gif'/><a href='".u('huan','list')."'><b style='color:red;cursor:pointer'>兑换商品</b>>>></a>";
	}
	else{
		$tbtxstate_msg = "亲！您当前的可用".TBMONEY."是<span>".$dduser['live_jifenbao'].TBMONEYUNIT."</span>，抓紧购物吧！";
	}
}
else{
	if($dduser['tbtxstatus']=='1'){
		$tbtxstate_msg = "您当前有一笔".TBMONEY."提取申请正在处理当中，我们将支付到您的支付宝中，请注意查收！ <a href='".u('user','mingxi',array('do'=>'out'))."'>>>查看详细</a>";
	}else{
		if($dduser['jifenbao']==0){
			$tbtxstate_msg = "感谢您使用".WEBNAME."，天天复制淘宝商品查询返利送".$webset['sign']['jifenbao']."集分宝。祝您购物愉快！";
		}elseif($dduser['live_jifenbao']<$webset['tixian']['tblimit']){
			$tbtxstate_msg = '亲！您当前的可用'.TBMONEY.'是 <span>'.$dduser['live_jifenbao'].TBMONEYUNIT.'</span>，还差 <span>'.($webset['tixian']['tblimit']-$dduser['live_jifenbao']).'</span>'.TBMONEY.'就可以申请提取了！';
		}elseif($dduser['auto_jfb']>=500){
			$tbtxstate_msg = "亲！您当前已经设置当集分宝大于<span>".$dduser['auto_jfb']."</span>个集分宝时自动提取，挖返利会自动提到您的支付宝中。";

		}else{
			$tbtxstate_msg = "当前购物返利".TBMONEY.":<span>".$dduser['live_jifenbao'].TBMONEYUNIT."</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='".u('user','tixian',array('type'=>1))."'><b style='color:red;cursor:pointer'>申请提取</b>>>></a>";

		}
	}
}

if($dduser['search_jfb']>0){
	$searchjfbstate_msg="当前查询奖励集分宝剩余:<span>".$dduser['search_jfb']."个</span>&nbsp;&nbsp;<a href='".u('user','info',array('do'=>'caiwu'))."'><b style='color:red;cursor:pointer'>设置自动返利</b>>>></a>(查询奖励集分宝和购物返利集分宝1:1自动提取)";
}else{
	$searchjfbstate_msg="当前查询奖励集分宝:<span>0个</span>&nbsp;&nbsp;<a href='".u('user','info',array('do'=>'caiwu'))."'><b style='color:red;cursor:pointer'>设置自动返利</b>>>></a>(查询奖励集分宝和购物返利集分宝1:1自动提取)";

}

/*
if($sign==1){
	$sign_word='亲！您今天还没有签到哦！签到可获得';
	$sign_get='';
	if($webset['sign']['money']>0){
		$sign_get.='<span>'.$webset['sign']['money'].'</span>元 ';
	}
	if($webset['sign']['jifenbao']>0){
		$sign_get.='<span>'.$webset['sign']['jifenbao'].'</span>'.TBMONEY;
	}
	if($webset['sign']['jifen']>0){
		$sign_get.='<span>'.$webset['sign']['jifen'].'</span>积分 ';
	}
	$sign_word=$sign_word.$sign_get;
	$sign_word.='<img style="margin-bottom:-10px" src="images/face/2.gif"/><a href="javascript:;" id=sign><b style="color:red">点击签到</b>>>></a>';
}
elseif($sign==0){
    $sign_word='亲！您今天的签到奖励已经领取完毕，明天继续吧！';
}

$js_sign_get_tip=strip_tags($sign_get);
if($js_sign_get_tip!=''){
	$js_sign_get_tip='签到完成，获得'.$js_sign_get_tip;
}
else{
	$js_sign_get_tip='签到完成';
}

*/
$css[]=TPLURL."/inc/css/usercss.css";
include(TPLPATH.'/inc/header.tpl.php');
?>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script>
$(function(){
    $('#sign').click(function(){
		if(typeof post=='undefined'){
			post=1;
			$.ajax({
		    	url:'<?=u('ajax','sign')?>&time=<?=TIME?>',
				dataType:'jsonp',
				jsonp:"callback",
				success: function(data){
			    	if(data.s==0){
				    	alert(errorArr[data.id]);
					}
					else if(data.s==1){
						alert('<?=$js_sign_get_tip?>');
				    	location.replace(location.href);
					}
		    	}
			});
		}
    });

	$('.tubiao_closew').click(function(){
	    $('.adminright_ts1').fadeOut('slow');
		return false;
	});
})

</script>
<div class="mainbody">
	<div class="mainbody1000">
    <?php include(TPLPATH."/user/top.tpl.php");?>
    	<div class="adminmain">
        	<div class="adminleft biaozhun5">
                <?php include(TPLPATH."/user/left.tpl.php");?>
            </div>
        	<div class="adminright">
            	<div class="c_border" style="border-top-style:solid; border-top-width:2px;padding-top:10px;">
            <?php if($default_pwd!=''){?>
                <div class="adminright_gg">
                    <div class="gonggaotubiao"></div>
                    <b>提醒：</b> 您的本站原始密码为：<b style=' color:#F00;'><?=$default_pwd?></b> 为了您账号安全请及时修改！
                </div>
             <?php }?>
             <?php include(TPLPATH."/user/notice.tpl.php");?>
                <div class="adminright_user">
                    <div class="adminright_user_bt"><S class="adminuser_1"></S><h3>欢迎您：<?=$dduser['name']?></h3><s class="adminuser_2"></s></div>
                    <div class="adminright_user_time"><p>上次登录时间：<?=$dduser['lastlogintime']?></p></div>
                    <div class="adminright_user_main">
                        <div class="adminright_user_main_l">
                            <a href="<?=u('user','avatar')?>"><img src="<?=a($dduser['id'])?>" /></a>
                            <p><a href="<?=u('user','avatar')?>"> 修改头像</a></p>
                        </div>

						<div class="adminright_user_main_r">
							<p>可用余额：<span><?=$dduser['live_money']?></span> 元 (未结算：<?=$dduser['freeze_money']?> 元) <a href="<?=u('user','mingxi')?>"> 收入明细>></a></p>
							<p>购物返利<?=TBMONEY?>：<span><?=$dduser['live_jifenbao']?></span> <?=TBMONEYUNIT?>(未结算：<?=$dduser['freeze_jifenbao']?> <?=TBMONEYUNIT?>) <a href="<?=u('user','mingxi')?>"> 收入明细>></a> <?php if(JIFENBAO==1){?>&nbsp;<a target="_blank" href="https://jf.alipay.com/prod/integral.htm">查看集分宝余额</a><?php }?> </p>
							<p>查询奖励<?=TBMONEY?>：<span><?=$dduser['search_jfb'] > 0 ? $dduser['search_jfb'] :0?></span> 个 (购物返利集分宝和查询集分宝1:1自动提取)    <a id="auto" href="/index.php?mod=user&act=info&do=caiwu">立即设置自动返利</a></p>
							<p>已提金额：<span><?=$dduser['yitixian']?> 元</span>&nbsp;&nbsp;&nbsp;&nbsp;已提<?=TBMONEY?>：<span><?=jfb_data_type($dduser['tbyitixian'])?></span> <?=TBMONEYUNIT?>    &nbsp;</p>
							<p>会员等级：<span><?=$dengji_img?></span> 当前VIP等级购物额外奖励:<span><?=$vip_bili?>集分宝</span> <?php if($jiaocheng['dengji']!=''){?><a target="_blank" id="jiaocheng" href="<?=$jiaocheng['dengji']?>">如何升级VIP?</a><?php }?>&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=81cf3244f7167648ac0511558d25bbd1230bb386be887ac31a1b9148296d8af2"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="挖返利" title="挖返利"></a></p>
						</div>

                    </div>
                    <div class="adminright_user_wei"></div>
                </div>

                <?php if(FANLI==1){?>
                <div class="adminright_yuye">
                    <div class="tishitubiao"></div>
                    <p><?=$txstate_msg?></p>
                </div>
                <div class="adminright_yuye">
                    <div class="tishitubiao"></div>
                    <p><?=$tbtxstate_msg?></p>
                </div>
				<div class="adminright_yuye">
					<div class="tishitubiao"></div>
					<p><?=$searchjfbstate_msg?></p>
				</div>
				<div class="adminright_qd">
					<div class="tishitubiao"></div>
					<p>亲！每天复制任意淘宝商品标题查询返利奖励10个<?=TBMONEY?>,<a style="font-size: 14px;color: red;" href="http://www.wafanli.cn" target="_self">点击这里去首页查返利拿奖励</a></p>
				</div>
                <?php }?>

                <?php if($api_login_tip || $caiwu_tip || $mobile_tip || $tbnick_tip){?>
                <div class="adminright_ts1">
                	<div class="tubiao_tishi"></div>
                    <div class="adminright_ts1_bt">功能提示和安全设置！</div>
                    <a href="" class="tubiao_closew"></a>
                    <ul>
                    <?php if($api_login_tip==1){?>
                    	<li><p>您还没有绑定第三方登陆，享受<?=WEBNAME?>为您提供的多种登陆方式吧！</p><a href="<?=u('user','info',array('do'=>'apilogin'))?>"><div class="tubiao_bangdin"></div></a></li>
                    <?php }?>
                    <?php if($caiwu_tip==1){?>
                        <li id="noborder"><p>您还没有设置您的财务信息，这将使您无法返利和兑现，我们建议您立即设置！</p><a href="<?=u('user','info',array('do'=>'caiwu'))?>"><div class="tubiao_shezhi"></div></a></li>
                    <?php }?>
                    <?php if($mobile_tip==1){?>
                        <li id="noborder"><p>您还没验证您的手机号码，我们建议您立即验证！</p><a href="<?=u('user','info',array('do'=>'mobile'))?>"><div class="tubiao_shezhi"></div></a></li>
                    <?php }?>
                    <?php if($tbnick_tip==1){?>
                        <li id="noborder"><p>请绑定您的淘宝账号，以便给您自动返利！</p><a href="<?=u('user','info',array('do'=>'tbnick'))?>"><div class="tubiao_bangdin"></div></a></li>
                    <?php }?>
                    </ul>
                </div>
                <?php }?>
                </div>
            </div>

        </div>
  </div>
</div>
<?php

?>
<script>
bl=<?=TBMONEYBL?>;
type=<?=TBMONEYTYPE?>;
function jsJfb(v){
	var jifenbao=dataType(v*bl,type);
	jifenbao=dataType(jifenbao/(1+<?=JFB_FEE?>),type);
	$('#js_jfb').html(jifenbao);
}

$(function(){
    $('#huanqian').jumpBox({
	    title: '温馨提示：按照1比<?=TBMONEYBL?>的比例将人民币转换成<?=TBMONEY?>！<?php if(JFB_FEE>0){?><?=TBMONEY?>兑换需要额外支付<b style=" color:red"><?=JFB_FEE*100?>%</b>的手续费<?php }?>',
		titlebg:1,
		height:200,
		width:580,
		defaultContain:1
    });

	jsJfb(<?=$dduser['live_money']?>);

	$('#money').keyup(function(){
		var liveMoney=<?=$dduser['live_money']?>;
		var v=parseFloat($(this).val());
		if(v>liveMoney || isNaN(v)){
			alert('金额填写错误');
			$(this).focus().select();
		}
		else{
			jsJfb(v);
		}
	});

	$('#form1').submit(function(){
		$(this).find('.ShiftClass').attr('disabled','disabled');
		var v=$(this).find('#money').val();
		var action=$(this).attr('action');
		$.ajax({
	    	url: action,
			data:{money:v},
			dataType:'jsonp',
			jsonp:"callback",
			success: function(data){
		    	if(data.s==0){
			    	alert(errorArr[data.id]);
				}
				else if(data.s==1){
			    	alert('兑换成功');
					location.replace(location.href);
				}
			}
		});
		return false;
	});
});
</script>
<div class="LightBox" id="LightBox"></div><div id="jumpbox" show="0" class="jumpbox"><div class="top_left"></div><div class="top_center"></div><div class="top_right"></div><div class="middle_left"></div><div class="middle_center"><div class="close"><a></a></div><p class="title"></p><div class="contain">
<form id="form1" name="form1" autocomplete="off" method="post" action="<?=u('ajax','huanqian')?>" >
                        <table width="505" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="116" height="35" align="right">可转换金额：</td>
                            <td width="" height="35" align="left"><b class="bignum"><?=$dduser['live_money']?></b>元</td>
                            <td width="" align="right"></td>
                          </tr>
						  <tr>
                            <td width="" height="35" align="right">转换：</td>
                            <td align="left"><input name="money" type="text" class="ddinput" value="<?=$dduser['live_money']?>" id="money" style="width:60px;" /><label class="field_notice">元 = <b id="js_jfb" class="bignum"></b><?=TBMONEY?></label></td>
                            <td width="" align="left"></td>
                          </tr>
						  <tr>
                            <td width="" height="35" align="right"></td>
                            <td align="left" colspan="2"><div class="img-button "><p><input type="submit" value="提 交" class="ShiftClass" /></p></div></td>
                          </tr>
      </table>
        </form>
</div></div><div class="middle_right"></div><div class="end_left"></div><div class="end_center"></div><div class="end_right"></div></div>
<?php
include(TPLPATH.'/inc/footer.tpl.php');
?>