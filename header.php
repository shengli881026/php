<?php
//$stamp =time()+120;
//header("Expires:".gmdate("D, d M Y H:i:s",$stamp)." GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
//header('Cache-Control:max-age=200,must-revalidate');

//set_header_cache();
/**
* 设置Header头缓存 
* 如果服务器的apache 和 nginx 代理服务器,使用此函数进行设置缓存
* apache配置 Expires 对图片和js和CSS 进行缓存
*
* @param    int     $life_time  缓存时间
*/
function set_header_cache($life_time=600)
{
	//设置缓存,参数(private、no-cache、max-age、must-revalidate)
	@header("Cache-Control: max-age=$life_time ,must-revalidate");
	@header('Pragma:');//
	//指示资源的最后修改日期和时间
	@header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT' );
	//响应过期的日期和时间
	@header("Expires: " .gmdate ('D, d M Y H:i:s', time() + $life_time). ' GMT');
}
/**
 * 
 * 判断缓存是过期,返回304 状态码  加载客户端缓存
 * If-Modified-Since 
 * 把浏览器端缓存页面的最后修改时间发送到服务器去，服务器会把这个时间与服务器上实际文件的最后修改时间进行对比
 * Last-Modified 和 If-Modified-Since 进行对比
 * 
 * 目前现在apache 和 nginx 有此算法,需要进行服务器配置。个人倾向nginx 响应模式
 * 
*/
//$file_name = __FILE__;
caching_headers(__FILE__,filemtime(__FILE__));
//if_modified_since($file_name);
function if_modified_since($fn)
{
	$headers = apache_request_headers(); 
	// Checking if the client is validating his cache and if it is current.
    if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($fn))) {
        // Client's cache IS current, so we just respond '304 Not Modified'.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($fn)).' GMT', true, 304);
    } else {
        // Image not cached or cache outdated, we respond '200 OK' and output the image.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($fn)).' GMT', true, 200);
        header('Content-Length: '.filesize($fn));
    }
}
/**
 * 设置页面缓存 和过期时间 通过判断文件的修改时间来进行304,达到缓存的目的
 * 
*/
function caching_headers ($file, $timestamp,$life_time=200)
{
    $gmt_mtime = gmdate('r', $timestamp);
	header("Cache-Control: max-age=$life_time ,must-revalidate");
	header('Pragma:');
	header('ETag: "'.md5($timestamp.$file).'"');
	header("Expires: " .gmdate ('D, d M Y H:i:s', time() + $life_time). ' GMT');

    header('Last-Modified: '.$gmt_mtime);
    header('Cache-Control: public');
    //有兴趣的可以看下 $_SERVER 函数 可以通过 HTTP_IF_MODIFIED_SINCE 判断过期时间
   
    if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH'])) 
	{
        if ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime || str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp.$file)) {
			//header('HTTP/1.1 304 Not Modified');
			//exit();
        }
    }
    if_modified_since($file);
}


echo "<a href='header.php' target='_blank'>header-file</a>";
//var_dump(apache_request_headers());
/*
header("Pragma: public"); // required 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Cache-Control: private",false); // required for certain browsers 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60) . " GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
*/
/*
 * 
*/
echo '<br/>'.date('Y-m-d H:i:s');
var_dump($_SERVER);
$html ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src=""></script>
<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style>
</head>
';
$html.='
<body>
<div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>
</body>
</html>
';
echo $html;
    

