<?php
/**
 * µ¥ÀýÄ£Ê½ -  mysql
*/
$db['host'] ='127.0.0.1';
$db['port'] = '3306';
$db['name'] ='root';
$db['password'] ='123465';
$db['database'] = 'test'; 
function mysql_featch($sql)
{
	global $db;
	$connect = mysql_connect($db['host'].':'.$db['port'],$db['name'],$db['password']) or die(mysql_error());
	mysql_select_db($db['database'],$connect) or die(mysql_error());
	//var_dump($connect);
	return mysql_query($sql);	
}

$obj = mysql_featch("select * from pid where 1");
while($result = mysql_fetch_assoc($obj))
{
	print_r($result);
}
