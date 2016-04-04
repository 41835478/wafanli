<?php //多多
if(!defined('INDEX')){
	exit('Access Denied');
}
$alimama_cha_num=num_check('alimama','get');

function check_tid($duoduo){
	$dduser=$duoduo->dduser;
	$webset=$duoduo->webset;
	
	/*if($webset['alimama']['open']==0){
		$re=array('s'=>0,'r'=>'查询功能关闭');
		return dd_json_encode($re);
	}*/
	
	$tid=$_GET['tid'];
	if($_SESSION['alimama_cha_num']>3){
		if($_GET['captcha']==''){
			$re=array('s'=>0,'r'=>'验证码不能为空');
			return $re;
		}
		else{
			if (reg_captcha($_GET['captcha']) == 0) {
				$re=array('s'=>0,'r'=>'验证码错误');
				return $re;
			}
		}
	}
	if($tid==''){
		$re=array('s'=>0,'r'=>'订单号不能为空');
		return $re;
	}
	
	if(TAOTYPE==1){
		$where = ' and trade_id_former = "' . $tid . '"';
		$trade = $duoduo->select_all('tradelist', '*', 'del=0' . $where . ' order by id desc limit 10000');
		if(!empty($trade)){
			if ($webset['taoapi']['trade_check'] == 0 && $dduser['id']>0) {
				foreach ($trade as $row) {
					if($row['uid']==0 && $row['checked']==0){
						if ($row['status'] == 5) {
							$row['ddjt'] = '';
							$row['checked'] = 2;
							$duoduo->rebate($dduser, $row, 8); //8号明细，确认淘宝订单
						} else {
							$fxje=fenduan($row['commission'],$webset['fxbl'],$dduser['type']);
							$jifenbao=jfb_data_type($fxje*TBMONEYBL);
							$update['checked'] = 3;
							$update['outer_code'] = $dduser['id'];
							$update['uid'] = $dduser['id'];
							$update['fxje'] = $fxje;
							$update['jifenbao'] = $jifenbao;
							$duoduo->update('tradelist', $update, 'id=' . $row['id']);
						}
					}
				}
				if($webset['taoapi']['auto_fanli']==1){
					$duoduo->trade_uid($dduser['id'],$row['trade_id_former'],'add');
				}
			}
			$trade=$trade[0];
			$trade['trade_id']=preg_replace('/_\d+/','',$trade['trade_id']);
			$trade['url']=u('tao','view',array('iid'=>$trade['num_iid']));
			if($dduser['id']>0){
				$fxje=fenduan($trade['commission'],$webset['fxbl'],(int)$dduser['type']);
				$trade['jifenbao']=jfb_data_type($fxje*TBMONEYBL);
			}
			$trade['jifenbao']=(float)$trade['jifenbao'];
			$trade['status']=$trade['status']==5?'已结算':'已付款';
			$trade['real_pay_fee']=$trade['real_pay_fee']>0?$trade['real_pay_fee']:$trade['pay_price']*$trade['item_num'];
			$a=array('trade_id'=>$trade['trade_id'],'num_iid'=>$trade['num_iid'],'item_title'=>$trade['item_title'],'jifenbao'=>$trade['jifenbao'],'status'=>$trade['status'],'real_pay_fee'=>$trade['real_pay_fee'],'url'=>$trade['url']);
			$re=array('s'=>1,'r'=>$a);
		}
		else{
			$re=array('s'=>0,'r'=>'订单未查到','num'=>num_check('alimama','set'));
		}
	}
	else{
		$where = 'trade_id = "' . $tid . '"';
		$trade = $duoduo->select('plugin_alimama', '*', $where . ' order by id desc');
		if(!empty($trade)){
			$trade['url']=u('tao','view',array('iid'=>$trade['num_iid']));
			$fxje=fenduan($trade['commission'],$webset['fxbl'],(int)$dduser['type']);
			$trade['jifenbao']=jfb_data_type($fxje*TBMONEYBL);
			$trade['jifenbao']=(float)$trade['jifenbao'];
			$trade['status']=$trade['status']==5?'已结算':'已付款';
			$trade['real_pay_fee']=$trade['real_pay_fee']>0?$trade['real_pay_fee']:$trade['pay_price']*$trade['item_num'];
			$a=array('trade_id'=>$trade['trade_id'],'num_iid'=>$trade['num_iid'],'item_title'=>$trade['item_title'],'jifenbao'=>$trade['jifenbao'],'status'=>$trade['status'],'real_pay_fee'=>$trade['real_pay_fee'],'url'=>$trade['url']);
			$re=array('s'=>1,'r'=>$a);
		}
		else{
			$re=array('s'=>0,'r'=>'订单未查到','num'=>num_check('alimama','set'));
		}
	}
	return $re;
}
echo dd_json_encode(check_tid($duoduo));
?>