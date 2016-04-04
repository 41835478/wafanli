<?php //多多
if(!defined('DDROOT')){
	exit('Access Denied');
}

if(!function_exists('num_check')){
	function num_check($name,$do,$genju=''){
		if($genju==''){
			$genju=$_SERVER['REMOTE_ADDR'];
		}
		$file=DDROOT.'/data/temp/session/'.date('Ymd').'/'.$name.'/'.$genju.'.txt';
		if($do=='get'){
			if(file_exists($file)){
				$num=(int)file_get_contents($file);
			}
			else{
				$num=0;
			}
		}
		else{
			if(file_exists($file)){
				$num=(int)file_get_contents($file);
			}
			else{
				$num=0;
			}
			$num++;
			create_file($file,$num);
		}
		return $num;
	}
}