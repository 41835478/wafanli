<?php //多多
$a=array (
  'admin_nav' => 
  array (
    'index' => 
    array (
      'title' => '基本设置',
    ),
	'list' => 
    array (
      'title' => '淘宝临时订单',
    ),
  ),
  'admin_auto' => 
  array (
    'index' => 1,
    'list' => 1,
    'addedi' => 1,
    'del' => 1,
  ),
  'table' => 
  array (
    'alimama' => 
    array (
      'id' => 'int(11) NOT NULL auto_increment',
      'item_title' => 'varchar(255) default NULL',
      'shop_title' => 'varchar(255) default NULL',
      'num_iid' => 'bigint(15) NOT NULL default "0"',
      'seller_nick' => 'varchar(50) default NULL',
      'pay_price' => 'double(10,2) NOT NULL default "0.00"',
      'commission_rate' => 'double(6,3) NOT NULL default "0.000"',
      'commission' => 'double(10,2) NOT NULL default "0.00"',
      'item_num' => 'int(11) NOT NULL default "0"',
      'trade_id' => 'varchar(20) NOT NULL',
      'pic_url' => 'varchar(255) default NULL',
      'status' => 'varchar(10) default NULL',
      'create_time' => 'date default NULL',
      'uid' => 'int(11) NOT NULL default "0"',
      'duoduo_table_index' => 'PRIMARY KEY  (`id`),KEY `num_iid` (`num_iid`),KEY `create_time` (`create_time`),UNIQUE KEY `trade_id` (`trade_id`)',
    ),
  ),
  'act_arr' => 
  array (
    0 => 
    array (
      'act' => 'index',
      'title' => '订单查询',
      'tag' => 'alimama',
      'nav' => 1,
    ),
  ),
  'install_sql' => '',
  'uninstall_sql' => '',
  'need_include' => 0,
  'rewrite' => 1,
  'debug' => 0,
);
if(TAOTYPE==1){
	unset($a['admin_nav']['list']);
}
return $a;
?>