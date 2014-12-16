<?php
/**
 * APC 单例模式类
*/
class apcCache
{
	/**
	 * apc 设置用户缓存
	 * @return bool 
	*/
	public function set_cache($key,$value,$time_out=0)
	{
		$time_out = $time_out >0 ? $time_out : 0;
		
		return apc_store($key,$value,$time_out);
	}
	/**
	 * @获取缓存
	*/
	public function get_cache($key)
	{
		return apc_fetch($key);
	}
	/**
	 * @清除缓存
	*/
	public function delete_cache($key)
	{
		return apc_delete($key);
	}
	/**
	 * @检查缓存是否存在
	*/
	public function exists_cache($key)
	{
		return apc_exists($key);
	}
	/**
	 * 获取缓存信息
	*/
	public function cache_info()
	{
		return apc_cache_info();
	}
}
$obj_apc = new apcCache();
$cache_key = 'apc_cache_a';
$cache_value = array('a','c','c');
$obj_apc->set_cache($cache_key,$cache_value,500);
var_dump($obj_apc->get_cache($cache_key));
var_dump($obj_apc->delete_cache($cache_key));
var_dump($obj_apc->exists_cache($cache_key));