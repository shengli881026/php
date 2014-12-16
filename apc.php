<?php
/**
 * APC 单例模式类
*/
class apc
{
	public function set_cache($key,$val,$time_out)
	{
		if(isset($key))
		{
			return apc_store($key,$val,$time_out);
		}else{
			return false;
		}
	}
	public function get_cache($key)
	{
		return apc_fetch($key);
	}
	public function cache_info()
	{
		return apc_cache_info();
	}
}
$obj_apc = new apc();
$cache_key = 'apc_cache_a';
$cache_value = array('a','c','c');
$obj_apc->set_cache($cache_key,$cache_value,10);
var_dump($obj_apc->get_cache($cache_key));
var_dump($obj_apc->cache_info());