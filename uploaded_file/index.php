<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/*
 * 程序执行入口
*/

require_once("uploaded_file.class.php");

/* $file_obj = new uploaded_file();
$file_obj ->set("path", "./images/");
$file_obj ->set("maxsize", 2000000);
$file_obj ->set("allowtype", array('jpg','jpeg','png','pjpeg','gif','bmp','x-png'));
$file_obj ->set("israndname", true);
 */
$token = md5("wx.hd.bitauto.com/fit/");
$timestamp = time();

//echo "timestamp = ".$timestamp;
//echo "<br/>";
$tmpArr = array($token, $timestamp);
sort($tmpArr, SORT_STRING);
$tmpStr = implode($tmpArr);
$tmpStr = sha1($tmpStr);

//echo "tmpStr = ".$tmpStr;

//$check_key = $tmpStr;


/*echo urldecode("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx35c39ca798021b74&redirect_uri=http%3A%2F%2Fwx.hd.bitauto.com%2Ffit%2Factivity%2ForderSalerList%2F&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect");
echo "<br/>";
echo urlencode("http://wx1.hd.ctags.net/fit/activity/orderSalerList/");

echo "<br/>";

echo urldecode("http%3A%2F%2Fwx.hd.bitauto.com%2Ffit%2Factivity%2Fdealer_saler_submit%2F");
echo "<br/>";
echo urlencode("http://wx1.hd.ctags.net/fit/activity/dealer_saler_submit/");
exit; */

/* $token = md5('hd.yiche.com/fit/');
$timestamp = time();
$nonce = rand(1000,99999);
$echostr = "bit_auto_uploaded_file";

echo "token = ".$token;echo '<br/>';

echo "timestamp = ".$timestamp;echo '<br/>';
echo "nonce = ".$nonce;echo '<br/>';
echo "echostr = ".$echostr;echo '<br/>';

$tmpArr = array($token, $timestamp, $nonce,'');
sort($tmpArr, SORT_STRING);
$tmpStr = implode($tmpArr);
$tmpStr = sha1($tmpStr);


echo "signature = ".$tmpStr; */

//验收是否微信提交
//验证key 
//验证域名
$check_type = checkSignature();

if($check_type)
{
	$file_obj = new uploaded_file();
	$file_obj ->set("path", "./images/");
	$file_obj ->set("maxsize", 2000000);
	$file_obj ->set("allowtype", array('jpg','jpeg','png','pjpeg','gif','bmp','x-png'));
	$file_obj ->set("israndname", true);
	if($file_obj-> upload("pic"))
	{
		//获取上传后文件名子
		echo json_encode(array("code"=>'0000',"msg"=>'上传成功',"file_name"=>$file_obj->getFileName()));
		exit;
	}else
	{
		$error_code = $file_obj->getErrorMsg();
		$error_msg = $file_obj->errorMsg($error_code);
		echo json_encode(array("code"=>'-1',"msg"=>"$error_msg"));exit;
	}
}else{
	echo json_encode(array("code"=>'-1','msg'=>"签名不正确,禁止非法访问!"));
	exit;
}

//wx1.hd.ctags.net/weixin/?timestamp=1426153301&signature=7b938a6cc04c34219184ed117d7de51e6ac00d05&nonce=6480&echostr=adsaf31391s
//array($token,);
exit;
//使用对象中的upload方法， 就可以上传文件,方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false



 
/**
 * 签名的验证
 * 
*/
/**
 * For weixin server validation 
 */	
function checkSignature($str='')
{
	$signature = isset($_GET["signature"])?$_GET["signature"]:'';
	$signature = isset($_GET["msg_signature"])?$_GET["msg_signature"]:$signature; //如果存在加密验证则用加密验证段
	$timestamp = isset($_GET["timestamp"])?$_GET["timestamp"]:'';
			
	$token = md5("wx.hd.bitauto.com/fit/");
	$tmpArr = array($token, $timestamp);
	sort($tmpArr, SORT_STRING);
	$tmpStr = implode( $tmpArr );
	$tmpStr = sha1( $tmpStr );
	
	if( $tmpStr == $signature ){
		return true;
	}else{
		return false;
	}
}

