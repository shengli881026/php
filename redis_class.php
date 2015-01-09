<?php
/**
 * 实例化一个redis 类
*/
class Redis{

	private $obj;
	private $connect;

	public function __construct()
	{
		$this->obj = new Redis();
	}
	/**
	 * 建立连接  
    */
	public function connect($host,$port)
	{
		$this->connect = $this->obj->connect($host,$port);
	}
	/**
     * set 
	*/
	public function set($key,$value)
	{
		return $this->connect->set($key,$value)
	}
	/**
     * setex 带失效时间
    */
	public function setex($key,$value,$time)
	{
		return $this->connect->setex($key,$time,$value);
	}
	/**
     * get
	*/
	public function get($key)
	{
		return $this->connect->get($key);
	}
}
