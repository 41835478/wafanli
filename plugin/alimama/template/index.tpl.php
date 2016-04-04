<?php 
include(TPLPATH.'/header.tpl.php');
$search_tip='请输入淘宝订单编号到这里查询';
$alimama_cha_num=num_check('alimama','get');
$yzm=yzm();
?>    	
<link rel="stylesheet" href="<?=PLUGIN_TPLURL?>css/index.css" type="text/css" />
<script>
var goodsMoney=0;
var fxje=0;
$(function(){
	$('#alimama_form').submit(function(){
		var tid=$('#search_tip').val();
		if(isNaN(tid)==true){
			alert('订单号格式错误');
			return false;
		}

		$('#wait_loading').show();
		$('#tip_word').hide();
		$('#baoqian').hide();
		$('#have_goods').hide();

		$.ajax({
			url: '<?=p(MOD,'ajax')?>&t=<?=TIME?>&tid='+tid+'&captcha='+$('#yzm').val(),
			dataType:'json',
			success: function(data){
				$('#wait_loading').hide();
				
				if(data.s==0){
					$("#baoqian_msg").html(data.r);
					$('#baoqian').show();
					if(data.num>3){
						$('#yzm_div').show();
					}
					$('#yzm_div img').click();
				}
				else{
					$('#trade_id').html(data.r.trade_id);
					$('#trade_status').html(data.r.status);
					$('#trade_item_title a').html(data.r.item_title);
					$('#ddFxje').html(data.r.jifenbao);
					$('#ddprice').html(data.r.real_pay_fee);
					$('.trade_url').attr('href',data.r.url);
					$('#have_goods').show();
				}
			}
		});
		return false;
	});
});
function checkform(){
	return false;
}
</script>
<div class="biaozhun5" style="width:1000px; background:#FFF; margin:auto; margin-top:10px; padding-bottom:10px">
<div class="c_border" style="border-top-style:solid; border-top-width:2px;">
<form action="index.php" onSubmit="return checkform();" id="alimama_form" >
    <div class="clear_div n_shop_center" style="position: relative; *position: static; z-index: 100; min-height:310px; padding-top:50px">
        <div class="n_shop_950" style="position: relative; *position: static; z-index: 99">
        
            <div class="clear_div n_center_list" style="background: none;" id="item_content">

                
                      <dl class="shop_search" >
                    <dd>
                <input name="search" type="text" id="search_tip" class="shop_text input_search_text" value="<?=$search_tip?>" onFocus="javascript:if(this.value=='<?=$search_tip?>') this.value=''; else this.select();" onBlur="javascript:if(this.value=='') this.value='<?=$search_tip?>';" style="border:none;" /></dd>
                    <dt>
                        <input type="submit" value="立即查询" class="shop_btn" style="border:none;" /></dt>
                </dl>
                <div class="clear_div shop_ok">
                <div id="yzm_div" style="margin-left:210px;width:550px;height:35px; margin-top:20px; display:<?=$alimama_cha_num>3?'block':'none'?>">
                <span style="font-size:14px;font:bold">请输入查询验证码：</span>
                <input value="" name="yzm" id="yzm" type="text"  style="width:80px;height:20px;line-height:20px"/><?=$yzm?>
                </div>
                    <div class="clear_div fan_tishi">
                        <dl class="clear_div orange_link shop_ok" style="width: 550px;" id="tip_word">

						           <dd style="width: 98%;">
                                <div style='text-align: left; color: #000000; font-weight: normal; font-size: 14px; line-height: 30px;'>亲！在拍下付款后的5分钟内可搜索到订单，如有疑问请咨询在线客服。</div>
                            </dd>
                        </dl>
                    
							<div id="have_goods" style="display:none; padding-top:10px">
						    <dl class="clear_div orange_link shop_ok" style="margin:0px auto 0px auto; width:550px"><dt> <a target="_blank" class="trade_url" href=""><img style="padding:1px;" id="pic_url" src="<?=PLUGIN_TPLURL?>css/images/face.png"/> </a></dt>
							<dd>
							恭喜！您搜索的订单号已跟踪到！
							<p>订单号：<span id="trade_id" class="orange_text"></span></p>
							<p>交易状态：<span id="trade_status" class="orange_text"></span></p>
							<p>商品：<span id="trade_item_title" class="orange_text"><a class="trade_url" href="" target="_blank" ></a></span></p>
							<p>交易额：<span id="ddprice" style="color:#060; font-size:14px; font-weight:bold"></span>元</p>
                            <p>预计返利：<span class="orange_text"><span id="ddFxje" style="color:#F30; font-size:14px; font-weight:bold"></span><?=TBMONEYUNIT?><?=TBMONEY?></span>（实际以收货后淘宝返回数据为准）</p>
                            </dd>
							</dl><dl class="clear_div orange_link shop_ok" style="margin:0px auto 30px auto; width:550px"><dd style="padding-top:15px;float:none;width:100%;">
							<p>温馨提示：</p>
							<p>1、如果一个订单包含多个商品，这里仅显示其中一件商品的标题</p>
							<p>2、建议您下单前清空Cookie后再按流程去下单，不要点击其他人的推广链接。</p></dd></dl>
                            </div>
                            </div>
                            <div id="wait_loading" style="display:none; text-align:center; padding-top:50px"><img src="<?=PLUGIN_TPLURL?>css/images/wait.gif" /></div>
                            <dl id="baoqian" class="clear_div orange_link shop_ok" style="width:550px; display:none"><dt><img src="<?=PLUGIN_TPLURL?>css/images/face2.png" title="errow" /></dt><dd><b id="baoqian_msg">很抱歉，未查询到您的订单！</b><p>建议您下单付款后1-5分钟后再搜索查询。</p><p>如超过1个小时还未搜索到，则该订单可能未跟踪到，</p><p>建议您重新按正确流程下单或咨询在线客服，谢谢！</p></dd></dl>
                    </div>
					
		
                    </div>

                </div>
                <!--end提示框-->
            </div>
            <!--结束列表-->

    </form>
</div></div>
<div style="clear:both"></div>
<?php include(TPLPATH.'/footer.tpl.php');?>