<?php
/**
 * const 常量关键字 
 * const 修饰成员属性为常量，只能修饰成员属性。
 * 1、常量使用大写,不能使用$
 * 2、常量在声明时就个初始值
 * 3、常量的访问方式和static 访问相同
*/
class Demo
{
	const AGE =10;
	public function __construct()
	{
		echo 'class -- demo';
	}
	/**
      * 类内部访问
    */
	public function get_age()
	{
		echo self::AGE;
	}
}
$demo_obj = new Demo();
echo $demo_obj->get_age();
echo Demo::AGE;
