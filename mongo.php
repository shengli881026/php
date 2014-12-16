<?php
/**
 * PHP 连接mongo 
*/
//连接mongo实例
$db  = new Mongo("192.168.6.59:30000");

//选择db 和表
$obj_deal = $db->selectDB('deal')->selectCollection('aloplan');

//执行查询
$result = $obj_deal->findOne(array('_id'=>'1330682845955_12_82ec6c30644f11e18670f5cbf99cfb3c95529900685509'));
echo '<pre/>';
var_dump($result);
exit;

