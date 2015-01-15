<?php
/**
 * curl 方法
*/
/**
 * 实例
 $url ="http://59.151.36.245/vespid/";
 $post_str = 'drawId='.intval($drawId).'&timestamp='.$timestamp.'&userId='.intval($this->user_id).'&MD5='.md5($md_str);
 curlPost($url,$post_str);
*/
private function curlPost($url,$post_str)
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
