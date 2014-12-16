<?php
//mysql_connect

$mysql_obj = mysql_connect('192.168.6.11:3307','okooo_php','123465');
$mysql_db  = mysql_select_db('RiskControl',$mysql_obj);
$sql ="select * from luck_ssq_blue where 1";
//$sql="INSERT INTO `luck_ssq_blue` (`lottery_type`, `lottery_no`, `source_type`, `result`, `prize_level`, `prize`,`create_time`)VALUES ('SSQ', '203113', 'zhcw', '11', '1', '200032.12','2014-12-05 12:00:00')";

//mysql_query - select 返回 resource  资源类型 
//mysql_query - insert update delete  返回bool 类型

$query = mysql_query($sql,$mysql_obj);
if(is_resource($query))
{
	while($row = mysql_fetch_array($query,MYSQL_ASSOC))
	{
		print_r($row);
		//print_r(array_change_key_case($row, CASE_LOWER));
    }
	print 'mysql_query_rows='.mysql_num_rows($query);	
}else{

	print 'query =true'.'mysql_rows=:'.mysql_affected_rows();
	
}
