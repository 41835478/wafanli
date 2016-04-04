<?php //多多
if(!defined('DDROOT')){
	exit('Access Denied');
}

if($plugin_config['tongxin_password']=='' || md5($plugin_config['tongxin_password'])!=$_GET['pwd']){
	$a=array('s'=>0,'msg'=>'通信密钥错误','time'=>SJ);
	create_file(DDROOT.'/data/plugin/alimama.txt',dd_json_encode($a));
	exit;
}

$a=array('s'=>1,'msg'=>'传输成功','time'=>SJ);
create_file(DDROOT.'/data/plugin/alimama.txt',dd_json_encode($a));

$data=$_POST['trade'];

if(empty($data)){
	echo dd_json_encode(array('s'=>0,'r'=>'订单数据为空'));
	exit;
}
$data=str_replace('\&quot;','"',$data);
$data=explode('#####',$data);
$shuju=array();
$items=array();

unlink(DDROOT.'/a.txt');
foreach($data as $vo){
	$vo=stripslashes($vo);
	$return=json_decode($vo,1);
	$paymentList=$return['data']['paymentList'];
	if(is_array($paymentList)){
		$items=array();
		foreach($paymentList as $ment){
			$goods=array();
			$yjbl=(float)$ment['finalDiscountToString'];//佣金金额
			$zfje=$ment['totalAlipayFeeString']?$ment['totalAlipayFeeString']:$ment['realPayFeeString'];//支付金额
			$zbl=(float)trim(str_replace('%','',$ment['discountAndSubsidyToString']));
			$btbl=$zbl-$yjbl;//补贴比例
			//必须1开始
			$goods[1]=$ment['createTime'];//创建时间
			$goods[2]=$ment['auctionTitle'];//商品信息
			$goods[3]=$ment['auctionId'];//商品ID
			$goods[4]=$ment['exNickName'];//掌柜旺旺
			$goods[5]=$ment['exShopTitle'];//所属店铺
			$goods[6]=$ment['auctionNum'];//商品数
			$goods[7]=round($ment['payPrice']/$ment['auctionNum'],2);//商品单价
			if($ment['payStatus']==3){
				$goods[8]='订单结算';//订单状态
			}else{
				$goods[8]='订单付款';//订单状态
			}
			$goods[10]=$ment['discountAndSubsidyToString'];//收入比率
			$goods[11]=$ment['shareRate'];//分成比率
			$goods[12]=$zfje;//付款金额
			$goods[13]=$ment['feeString'];//效果预估
			$goods[14]=$ment['realPayFeeString'];//结算金额
			$goods[15]=$ment['tkPubShareFeeString'];//预估收入
			$goods[16]=$ment['earningTime'];//结算时间
			$goods[17]=$yjbl.'%';//佣金比率
			$goods[18]=round($zfje*(float)$yjbl/100,2);//佣金金额
			$goods[19]=$btbl.'%';//补贴比率
			$goods[20]=round($zfje*($btbl/100),2);//补贴金额
			$goods[21]=$ment['tkBizTag']==2?'天猫':'';//补贴类型
			$goods[22]=$ment['terminalType'];//成交平台
			$goods[23]='第三方服务来源';//第三方服务来源
			$goods[24]=number_format($ment['taobaoTradeParentId'],0,'','');//订单编号
			$items[]=$goods;
		}
		$shuju=array_merge($shuju,$items);
	}
}
if($shuju){
	if(TAOTYPE==1){
		$result=$duoduo->trade_import($shuju);
		$result['insert_num']=0;
		$result['update_num']=0;
		$result['delete_num']=0;
		$result['bubian_num']=0;
		$pagesize=300;
		$tradelist_temp=$duoduo->select_all('tradelist_temp','*',' 1 ORDER BY id ASC LIMIT '.$pagesize);
		if(empty($tradelist_temp)){
			$duoduo->query('truncate  `'.BIAOTOU.'tradelist_temp`');
			$duoduo->query('OPTIMIZE TABLE  `'.BIAOTOU.'tradelist_temp`');
			$msg="操作完成";
			echo dd_json_encode(array('s'=>1,'r'=>$msg));
		}
		else{
			foreach($tradelist_temp as $vo){
				$id=$vo['id'];
				unset($vo['id']);
				if(empty($vo['pay_time'])){
					unset($vo['pay_time']);
				}
				if(empty($vo['settletime'])){
					unset($vo['settletime']);
				}
				$result =$duoduo->trade_ruku($vo,$result);
				$duoduo->delete('tradelist_temp','id="'.$id.'"');
			}
			$msg="共插入".$result['insert_num']."条新订单，更新".$result['update_num']."条订单，删除".$result['delete_num']."条订单，有".$result['bubian_num']."条订单不变";
			echo dd_json_encode(array('s'=>1,'r'=>$msg));
		}
	}
	else{
		foreach($shuju as $k=>$row){
			unset($arr);
			$arr['status'] = $row[8];
        	$arr['create_time'] = $row[1];
        	$arr['item_title'] = preg_replace('/\'|"/','',$row[2]);
        	$arr['shop_title'] = preg_replace('/\'|"/','',$row[5]);
        	$arr['seller_nick'] = preg_replace('/\'|"/','',$row[4]);
        	$arr['num_iid'] = $row[3];
        	$arr['item_num'] = $row[6];
        	$arr['pay_price'] = $row[7];
        	$arr['trade_id'] = $row[24];
			$arr['commission_rate'] = round(str_replace('%','',$row[17])/100,2);
			$arr['commission']=round($row[15],2);
			if($arr['commission']==0){
				$arr['commission']=round($arr['commission_rate']*$arr['pay_price']*$arr['item_num'],2);//效果预估
			}
			
			$id=(int)$duoduo->select('plugin_alimama','id','trade_id="'.$arr['trade_id'].'"');
			if($id==0){
				$plugin_alimama_id=$duoduo->insert('plugin_alimama',$arr);
				if($arr['trade_id']==$tid){
					$arr['id']=$plugin_alimama_id;
					$trade=$arr;
				}
			}
		}
		echo dd_json_encode(array('s'=>1,'r'=>'导入完成'));
	}
}
else{
	echo dd_json_encode(array('s'=>1,'r'=>'无数据'));
}
?>