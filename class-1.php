<?php
/**
 * class 类的封装 ,直接封装getUserInfo 方法
 -------------魔术函数----------------
 __get 当调用类内部的私有的private 的方法和属性是执行。
 __set 设置类内部的私有属性才会执行
 __isset
 __unset
 ---------------------------------------
*/
class user_class
{
	var  $user_info = array();
	private $user_name;
	private $u_id;
	/**
	 * __construct 构造函数 
	*/
	public function __construct($u_id,$user_name,$pwd)
	{
		///session_start();
		echo '---user_class auto load------<br/>';
		$this->user_info['sid'] = $u_id;
		$this->setUserName($user_name);
		$this->setPassword($pwd);
	}
	public function getUserInfo()
	{
		return $this->user_info;
	}
	private function setUserName($user_name)
	{
		$this->user_info['user_name']=$user_name;
		$this->user_name = $user_name;
	}
	private function setPassword($pwd)
	{
		$this->user_info['password'] =$pwd;
	}
	/**
	 * 魔术方法 
	*/
	function __get($f_name)
	{
		//echo $f_name.'-- 不能被调用<br/>';
		echo $this->$f_name;
	}
	function __set($name,$value)
	{
		$this->$name = $value;
		//var_dump($name,$value);
	}
	/**
	 * 析构函数
	*/
	public function __destruct()
	{
		echo '再见.....';
	}
}

$user = new user_class('32193719381039','test','123465');
$user->user_name;
$user->user_name='abcd';
echo $user->user_name."<br/>";
echo '<pre/>';
print_r($user->getUserInfo());
echo '----'; 
