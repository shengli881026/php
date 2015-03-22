<?php
/**
 * 数组相关操作助手类
 * @author zhangsl@yiche.com
 */
class Helper_Arr
{
	/**
	 * 复制数组自身的值
	 *
	 * @param array $arr 目标数组
	 * @param array $table 复制映射表
	 * @param boolean $isPointer 是否使用指针
	 *
	 * @return boolean
	 */
	static public function copyValue(array &$arr, array $table = null, $isPointer = true)
	{
		foreach($table as $to => $copy ){
			if ($copy !== $to) {
				if ($value = self::get($arr, $copy, false) !== false) {
					if ($isPointer) {
						$arr[$to] = &$arr[$copy];
					} else {
						$arr[$to] = $value;
					}
				}
			}
		}
		return true;
	}
	
	/**
	 * 取出数组中的一个元素，如果没有元素则返回默认值
	 *
	 * @param array $arr
	 * @param string $name 元素名称
	 * @param mixed $default 默认值
	 */
	static public function get(array &$arr, $name, $default = null)
	{
		return isset($arr[$name]) ? $arr[$name] : $default;
	}

	/**
	 * 数组中的值作为数组的键值
	 *
	 * @param array $arr
	 * @param mixed $valuename
	 * @return array
	 */
    static public function valueToKey(array &$arr, $valuename)
    {
        $result = array();
        foreach($arr as $key => $value){
            $name = $value[$valuename];
            $result[$name] = $value;
        }
        return $result;
    }
	/**
	 * 根据值排序数组
	 *
	 * @param array $arr
	 * @param mixed $valuename
	 * @param boolean $desc
	 */
	static public function sortByValue(array &$arr, $valuename, $desc = true)
	{
		$result = array();
		$result = self::valueToKey($arr, $valuename);
		if($desc){
			krsort($result);
		}else{
			ksort($result);
		}
		return $result;
	}
}
