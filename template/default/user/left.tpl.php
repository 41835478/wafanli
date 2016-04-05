<div class="adminmenu">
  <div class="adminmenu_bt c_border">
    <div class="adminmenu_bt_font"><div class="shutiao c_bgcolor"></div><a href="<?=u('user','index')?>">管理中心</a></div>
      <div class="tree_on"></div>
   </div>
   <ul>
	<li><div class="adminmenu_tixian"></div><div class="adminmenu_a"><a id="index" href="<?=u('user','index')?>">会员中心</a></div></li>
	<li><div class="adminmenu_dindan"></div><div class="adminmenu_a"><a id='tradelist' href="<?=u('user','tradelist')?>">返利订单</a></div></li>
    <li><div class="adminmenu_wenti"></div><div class="adminmenu_a"><a id='mingxi' href="<?=u('user','mingxi')?>">返利明细</a></div></li>
    <li><div class="adminmenu_zhannei"></div><div class="adminmenu_a"><a id='msg' href="<?=u('user','msg')?>">客服消息</a></div></li>
    <li><div class="adminmenu_fenxiang"></div><div class="adminmenu_a"><a id='baobei' href="/index.php?mod=user&act=msg&do=send">联系客服</a></div></li>
    <?php if($webset['user']['shoutu']==1 && FANLI==1){?>
	<li><div class="adminmenu_lianmen"></div><div class="adminmenu_a"><a id='yaoqing' href="<?=u('user','yaoqing')?>">我的邀请</a></div></li>
    <?php }?>
    <li><div class="adminmenu_bangdin"></div><div class="adminmenu_a"><a id='info' href="<?=u('user','info')?>">自动返利</a></div></li>
  </ul>
</div>
<script>
$('.adminmenu #<?=ACT?>').addClass('current');
</script>