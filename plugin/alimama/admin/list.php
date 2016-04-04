<?php 
/**
 * ============================================================================
 * 版权所有 2008-2012 多多科技，并保留所有权利。
 * 网站地址: http://soft.duoduo123.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

if(!defined('ADMIN')){
	exit('Access Denied');
}
$indexs_1=$duoduo->show_index('plugin_alimama');
if(!in_array('create_time',$indexs_1)){
	$duoduo->query("ALTER TABLE  `".BIAOTOU."plugin_alimama` ADD INDEX (  `create_time` )");
}
$duoduo->delete('plugin_alimama','create_time<"'.date("Y-m-d",strtotime("-14 day")).'"'); //删除14天前的记录
?>
<form name="form1" action="" method="get">
<table cellspacing="0" width="100%" style="border:1px  solid #DCEAF7; border-bottom:0px; background:#E9F2FB">
  <tr>
    <td width="20%">&nbsp;<img src="images/arrow.gif" width="16" height="22" align="absmiddle" />&nbsp; </td>
    <td width="" align="right">商品名：<input type="text" name="item_title" value="<?=$_GET['item_title']?>" />&nbsp;<input type="submit" value="搜索" /></td>
    <td width="150px" align="right">共有 <b><?=$total?></b> 条记录&nbsp;&nbsp;</td>
    </tr>
</table>
<input type="hidden" name="mod" value="<?=MOD?>" />
<input type="hidden" name="act" value="<?=ACT?>" />
<input type="hidden" name="do" value="<?=$do?>" />
<input type="hidden" name="plugin_id" value="<?=$plugin_id?>" />
<input type="hidden" name="sql_where" value="{item_title:char:like:full}" />
<input type="hidden" name="order_by" value="order by id desc" />
</form>
      <form name="form2" method="get" action="" style="margin:0px; padding:0px">
      <table id="listtable" border=1 cellpadding=0 cellspacing=0 bordercolor="#dddddd">
        <tr>
          <th width="3%" ><input type="checkbox" onClick="checkAll(this,'ids[]')" /></th>
          <th width="">商品名称</th>
          <th width="">掌柜</th>
          <th width="80px">价格</th>
          <th width="12%">订单号</th>
		  <th width="8%">状态</th>
          <th width="7%">下单时间</th>
          <th width="6%">会员</th>
        </tr>
		<?php foreach ($plugin_data as $r){?>
	    <tr>
          <td><input type='checkbox' name='ids[]' value='<?=$r["id"]?>' id='content_<?=$r["id"]?>' /></td>
          <td><a href="http://item.taobao.com/item.html?id=<?=$r["num_iid"]?>" target="_blank"><?=$r["item_title"]?></a></td>
          <td><?=$r["seller_nick"]?></td>
		  <td><?=$r["pay_price"]?></td>
		  <td><?=$r["trade_id"]?></td>
          <td><?=$r["status"]?></td>
          <td><?=$r['create_time']?></td>
          <td><?=$r["uid"]>0?$duoduo->select('user','ddusername','id="'.$r["uid"].'"'):'-- --'?></td>
		</tr>
		<?php }?>
        </table>
        <div style="position:relative; padding-bottom:10px">
            <input type="hidden" name="mod" value="<?=MOD?>" />
      <input type="hidden" name="act" value="<?=ACT?>" />
      <input type="hidden" name="do" value="<?=$do?>" />
      <input type="hidden" name="plugin_id" value="<?=$plugin_id?>" />
      <input type="hidden" name="do" value="del" />
            <div style="position:absolute; left:5px; top:5px"><input type="submit" value="删除" class="myself" onclick='return confirm("确定要删除?")'/></div>
            <div class="megas512" style=" margin-top:5px;"><?=pageft($total,$pagesize,$page_arr);?></div>
            </div>
       </form>