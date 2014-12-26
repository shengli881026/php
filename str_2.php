<?php
/**
 * 面试中经常问到字符串 - 面试题
*/
/**
 * 1、字符串 'www.baidu.com' 实现字符串反转
*/
$str ='www.baidu.com';
//str_rev($str);
//fun($str);
//自定义函数字符串反转
/**
 * 自定义函数实现字符串反转
*/
function str_rev($str)
{
	if($str)
	{
		$rev_str ='';
		for($i=1;$i<=strlen($str);$i++)
		{
				$rev_str .= substr($str,-$i,1);
		}
		echo $rev_str;
	}
}
/**
 * 自定义函数实现字符串反转
*/
function fan($str)
{
	$num = strlen($str)-1;
	$new_str ='';	
	for($i=$num;$i >=0;$i--)
	{
		$new_str .=$str[$i];
	}
	echo $new_str;
}
/**
 * 2、字符串 '123456789' 写一个函数实现 123,456,789  
*/
$n_str ='1234567891011';
//php 自带函数 
//echo number_format($n_str,0,'',',');

num_format($n_str);

function num_format($n_str)
{
	$str_len = strlen($n_str);
	$n_int = intval($str_len/3);
	//echo substr($n_str,6,3);
//	$new_str ='';
	for($i=0;$i<$n_int;$i++)
	{
		$new_str[]=substr($n_str,$i*3,3);	
	}
	echo join(',',$new_str);	
}
