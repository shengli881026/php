<?php
/**
 * register_tick_function  注册标记函数   register_shutdown_function 关闭注册函数 unregister_tick_function 删除标记
*/
//----------位置----------
//register_tick_function('get_str',true);
//register_shutdown_function('get_str');

/**
 * 
*/
//---------------
register_tick_function('get_str',true);
//register_shutdown_function('get_str');
//unregister_tick_function('get_str');
declare(ticks=2);

echo '############<br/>';

//***不能在这个位置,或者
function get_str()
{
	print 'str';
}
//或者--------------
















/*
set_time_limit(0);
    
function profiler($return = false)
{
	static $m = 0;
	if($return) return $m . " bytes";
	if(($mem = memory_get_usage()) > $m) $m = $mem;
}

register_tick_function('profiler');
declare(ticks = 1);

$numbers = array();
for($i=0; $i<100; $i++)
{
	print($i . "<br />");
}

print(profiler(true));
*/













