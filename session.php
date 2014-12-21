<?php
session_start();
//SID 预定义常量 windows 下使用。
/**
 * 当客户端禁用 cookie 使,
 在linux 和Unix下使用下面的方法:
 1、设置php.ini中的session.use_trans_sid = 1或者编译时打开打开了--enable-trans-sid选项，让PHP自动跨页传递session id。
 2、手动通过URL传值、隐藏表单传递session id。
 3、用文件、数据库等形式保存session_id,在跨页过程中手动调用。
*/
/**
 * session 设置过期时间 在php.ini 中配置
 * 可以在PHP中,设置php.ini,找到 session.gc_maxlifetime = 1440 #(PHP5默认24分钟)
 -------------------session 的过期时间------------------------
 session.gc_probability = 1 
 session.gc_divisor = 1000
 //garbage collection 有个概率的，1/1000就是session 1000次才有一次被回收。
 //php.ini文件中的 gc_maxlifetime 变量就可以延长session的过期时间了
*/
$s_name = session_name();
if(empty($_SESSION['username']) || empty($_COOKIE[$s_name]))
{
	echo '需要重新登陆';
	$u ='admin';
	$tmp_pwd ='admin';
	$username = !empty($_REQUEST['username']) ? $_REQUEST['username'] : '';
	$pwd = !empty($_REQUEST['pwd']) ? $_REQUEST['pwd'] : '';
	//var_dump($username,$pwd);exit;
	$is_set = !empty($_REQUEST['is_set']) ? $_REQUEST['is_set'] : 0;
	if($username ==$u && $pwd ==$tmp_pwd)
	{
		//$lifetime =10;
		//setcookie(session_name(),session_id(),time()+10,"/");
		if(SID=='')
		{
			echo 'sid ---------set cookie';
			setcookie(session_name(),session_id(),time()+10,"/");
		}else{
			echo 'sid --------set session';
			$lifetime=10;//保存1分钟
			session_set_cookie_params($lifetime);
			session_regenerate_id(true);
		}
		//print_r(session_get_cookie_params());
		$_SESSION['username'] = $username;
		$_SESSION['pwd'] = $pwd;
		//var_dump($_REQUEST);
		//echo '';
	}
}else{
	echo '登陆成功';exit;
}
?>
<!DOCTYPE html> 
<html>
<head>
<!--STATUS OK-->
<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>-----------</title>
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
</head>
<body>
<script type="text/javascript">

</script>
<form action="session.php" method="post">
 username:<input type="text" name="username" value=''/><br/>
 password:<input type="password" name="pwd" value='' /></br/>
 下次自动登陆:<input type="checkbox" name="is_set" value="1"/><br/>
 提交:<input type="submit" name="login" value="提交"/>---<input type="reset" name="reset" value="重置"/>
</form>
</body>
</html>