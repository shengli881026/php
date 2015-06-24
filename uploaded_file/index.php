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
//$url ="http://wx.hd.bitauto.com/";


//file_put_contents("./log.txt",var_export("---uploaded_file --start---\n",true),FILE_APPEND);

echo header("Access-Control-Allow-Origin: http://wx.hd.bitauto.com");

require_once("uploaded_file.class.php");


//file_put_contents("./log.txt",var_export("---uploaded_file --start---\n".json_encode($_REQUEST),true),FILE_APPEND);

//验收是否微信提交
$check_type = checkSignature();
$saler_id = intval($_GET['saler_id']);

if($check_type)
{
	$file_obj = new uploaded_file();
	$file_obj ->set("path", "./dealer_saler/");
	$file_obj ->set("maxsize", 4000000);
	$file_obj ->set("allowtype", array('jpg','jpeg','png','pjpeg','gif','bmp','x-png'));
	$file_obj ->set("israndname", true);
	if($file_obj-> upload("upfile"))
	{
		//file_put_contents("./log.txt",var_export("---uploaded_file --upload -true---\n".json_encode($_REQUEST),true),FILE_APPEND);
		//获取上传后文件名子
		//echo json_encode(array("code"=>'0000',"msg"=>'上传成功',"file_name"=>$file_obj->getFileName()));
		//exit;
		//$url ="http://wx.hd.bitauto.com/fit/activity/dispose_upload_file/?openid=".$_GET['openid'];
		//$post_str = 'uploaded_file=y&file_name='.$file_obj->getFileName();
		dbquery($saler_id,"dealer_saler/".$file_obj->getFileName());
		//curlPost($url,$post_str);
		if($_REQUEST['view_upload_file'] ==1)
		{
			//判断是否返回json
			echo json_encode(array("status"=>true,"file_name"=>$file_obj->getFileName()));exit;
		}else{
			//$saler_id = $_GET['saler_id'];
			header('location:http://wx.hd.bitauto.com/fit/activity/dealer_saler_info/'.$saler_id.'/?openid='.$_GET['openid']);exit;
		}
	}else
	{
		if($_REQUEST['view_upload_file']==1)
		{
			//判断是否返回json
			echo json_encode(array("status"=>false,"file_name"=>$file_obj->getFileName()));exit;
		}else{
			$saler_id = $_GET['saler_id'];
			header('location:http://wx.hd.bitauto.com/fit/activity/dealer_saler_info/'.$saler_id.'/?openid='.$_GET['openid']);exit;
		}
		///file_put_contents("./log.txt",var_export("---uploaded_file --upload -false---\n".json_encode($file_obj->getErrorMsg()),true),FILE_APPEND);
		
		//$error_code = $file_obj->getErrorMsg();
		//$error_msg = $file_obj->errorMsg($error_code);
		//$url ="http://wx1.hd.ctags.net/fit/activity/dealer_saler_check_true/?openid=".$_GET['openid'];
		//$post_str = 'uploaded_file=n&file_name=&msg='.$error_msg;
		//curlPost($url,$post_str);
		//exit;
		//echo json_encode(array("code"=>'-1',"msg"=>"$error_msg"));exit;
	}
}else{
	echo json_encode(array("code"=>'-1','msg'=>"签名不正确,禁止非法访问!"));
	exit;
}

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
	$signature = isset($_REQUEST["signature"])?$_REQUEST["signature"]:'';
	$signature = isset($_REQUEST["msg_signature"])?$_REQUEST["msg_signature"]:$signature; //如果存在加密验证则用加密验证段
	$timestamp = isset($_REQUEST["timestamp"])?$_REQUEST["timestamp"]:'';
			
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
/**
 * 发送curl 请求
*/
function curlPost($url,$post_str)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//发送一个常规的POST请求
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	//要传送的所有数据
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$res = curl_exec($ch);
	$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if ($res == NULL) { 
		curl_close($ch);
		return array('result'=>false,'respond'=>'');
	} else if($responseCode != "200") {
		curl_close($ch);
		return array('result'=>false,'respond'=>'');
	}elseif(!empty($res))
	{
		curl_close($ch);
		return array('result'=>true,'respond'=>$res);
	}
}


//$saler_id $data 图片路径
function dbquery($saler_id,$data=null){
	
	//mysql_connect
	if(!empty($data)){
		$mysql_obj = @mysql_connect('192.168.5.101:3306','root','11111&aaa');
		$mysql_db  = @mysql_select_db('hd_huodong',$mysql_obj);
		$sql ="update disperse_dealer_saler set photo='".$data."' where id=".$saler_id." limit 1";
		//$sql="INSERT INTO `luck_ssq_blue` (`lottery_type`, `lottery_no`, `source_type`, `result`, `prize_level`, `prize`,`create_time`)VALUES ('SSQ', '203113', 'zhcw', '11', '1', '200032.12','2014-12-05 12:00:00')";
		//mysql_query - select 返回 resource  资源类型 
		//mysql_query - insert update delete  返回bool 类型
		$query = @mysql_query($sql,$mysql_obj);
		
	}
	
}
