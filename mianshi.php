<?php
//header("Content-type:text/html;charset=gbk");
/**
 * 时间函数
*/
//echo '上一天'.date('Y-m-d H:i:s',strtotime('-1 day'));
//echo '上一个月'.date('Y-m-d H:i:s',strtotime('-1 month'));
/**
 * 字符串的重新解析
*/
$str ='abc';
$$str ='new';
$$str .='100';
//echo $abc;
/**
 * 交换下面的$a、$b 的值，不用使用第三个变量。
*/
$a =111111;
$b =222222;
$b =$a.'#'.$b;
$b = explode('#',$b);
$a = $b[1];
$b = $b[0];
echo $b.'--------'.$a;

