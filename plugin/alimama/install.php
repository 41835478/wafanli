<?php
include('../../comm/dd.config.php');
$code='alimama'; //应用标识码
$re=add_plugin_test($code);
if($re==1){
	echo "安装成功";
}
else{
	echo $re;
}
?>