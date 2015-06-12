<?php
class Weixin
{
	public $AppId		= '';
	public $AppSecret	= '';
	public $AccessToken = '';

	public $errcode = array(
				'-1'=>'系统繁忙',
				'0'=>'请求成功',
				'40001'=>'获取access_token时AppSecret错误，或者access_token无效',
				'40002'=>'不合法的凭证类型',
				'40003'=>'不合法的OpenID',
				'40004'=>'不合法的媒体文件类型',
				'40005'=>'不合法的文件类型',
				'40006'=>'不合法的文件大小',
				'40007'=>'不合法的媒体文件id',
				'40008'=>'不合法的消息类型',
				'40009'=>'不合法的图片文件大小',
				'40010'=>'不合法的语音文件大小',
				'40011'=>'不合法的视频文件大小',
				'40012'=>'不合法的缩略图文件大小',
				'40013'=>'不合法的APPID',
				'40014'=>'不合法的access_token',
				'40015'=>'不合法的菜单类型',
				'40016'=>'不合法的按钮个数',
				'40017'=>'不合法的按钮个数',
				'40018'=>'不合法的按钮名字长度',
				'40019'=>'不合法的按钮KEY长度',
				'40020'=>'不合法的按钮URL长度',
				'40021'=>'不合法的菜单版本号',
				'40022'=>'不合法的子菜单级数',
				'40023'=>'不合法的子菜单按钮个数',
				'40024'=>'不合法的子菜单按钮类型',
				'40025'=>'不合法的子菜单按钮名字长度',
				'40026'=>'不合法的子菜单按钮KEY长度',
				'40027'=>'不合法的子菜单按钮URL长度',
				'40028'=>'不合法的自定义菜单使用用户',
				'40029'=>'不合法的oauth_code',
				'40030'=>'不合法的refresh_token',
				'40031'=>'不合法的openid列表',
				'40032'=>'不合法的openid列表长度',
				'40033'=>'不合法的请求字符，不能包含\uxxxx格式的字符',
				'40035'=>'不合法的参数',
				'40038'=>'不合法的请求格式',
				'40039'=>'不合法的URL长度',
				'40050'=>'不合法的分组id',
				'40051'=>'分组名字不合法',
				'41001'=>'缺少access_token参数',
				'41002'=>'缺少appid参数',
				'41003'=>'缺少refresh_token参数',
				'41004'=>'缺少secret参数',
				'41005'=>'缺少多媒体文件数据',
				'41006'=>'缺少media_id参数',
				'41007'=>'缺少子菜单数据',
				'41008'=>'缺少oauth code',
				'41009'=>'缺少openid',
				'42001'=>'access_token超时',
				'42002'=>'refresh_token超时',
				'42003'=>'oauth_code超时',
				'43001'=>'需要GET请求',
				'43002'=>'需要POST请求',
				'43003'=>'需要HTTPS请求',
				'43004'=>'需要接收者关注',
				'43005'=>'需要好友关系',
				'44001'=>'多媒体文件为空',
				'44002'=>'POST的数据包为空',
				'44003'=>'图文消息内容为空',
				'44004'=>'文本消息内容为空',
				'45001'=>'多媒体文件大小超过限制',
				'45002'=>'消息内容超过限制',
				'45003'=>'标题字段超过限制',
				'45004'=>'描述字段超过限制',
				'45005'=>'链接字段超过限制',
				'45006'=>'图片链接字段超过限制',
				'45007'=>'语音播放时间超过限制',
				'45008'=>'图文消息超过限制',
				'45009'=>'接口调用超过限制',
				'45010'=>'创建菜单个数超过限制',
				'45015'=>'回复时间超过限制',
				'45016'=>'系统分组，不允许修改',
				'45017'=>'分组名字过长',
				'45018'=>'分组数量超过上限',
				'46001'=>'不存在媒体数据',
				'46002'=>'不存在的菜单版本',
				'46003'=>'不存在的菜单数据',
				'46004'=>'不存在的用户',
				'47001'=>'解析JSON/XML内容错误',
				'48001'=>'api功能未授权',
				'50001'=>'用户未授权该api'
			);

	public function __construct( $AppId, $AppSecret ){
		
		$this->AppId		= $AppId;
		$this->AppSecret	= $AppSecret;
	}

	#2.4 基础支持 上传下载多媒体文件( 图片（image）、语音（voice）、视频（video）和缩略图（thumb） )
	public function setFile( $type='image', $file ){

		/*
		$comd = 'curl -F media=@1.jpg "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->AccessToken.'&type='.$type.'"';
		shell_exec($comd,$result);
		var_dump($result);exit;
		pr($result);
		*/
		/*
		$url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->AccessToken.'&type='.$type;
		$data = 'media='.$file;
		$data = 'media='.file_get_contents('1.jpg');
		pr($this->postUrlContent($url,$data));
		*/
	}

	#2.4 基础支持 上传下载多媒体文件( 图片（image）、语音（voice）、视频（video）和缩略图（thumb） )
	public function getFile( $media_id ){
		$url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->AccessToken.'&media_id='.$media_id;
		echo $url;
		exit;
	}

	#3.1 接收消息 验证消息真实性
	public function valid()
    {
		#验证信息
		if(!empty($_GET["echostr"]))
		{
			echo $_GET["echostr"];exit;
		}
    }

	#3.2 接收消息 接收普通消息
	public function getMsg()
	{
		#接收消息
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$postObj->ToUserName;	#开发者微信号
			$postObj->FromUserName;	#发送方帐号（一个OpenID）
			$postObj->CreateTime;	#消息创建时间 （整型）
			$postObj->MsgType;		#消息类型（ text image voice video location link ）
			$postObj->MsgId;		#消息id，64位整型 

			#text	文本消息
			$postObj->Content;		#文本消息内容
			$content = $postObj->Content;

			#image	图片消息
			$postObj->PicUrl;		#图片链接
			$postObj->MediaId;		#图片消息媒体id，可以调用多媒体文件下载接口拉取数据。

			if($postObj->MsgType=='image') 
			$content = 'MediaId：'.$postObj->MediaId."\nPicUrl:".$postObj->PicUrl;

			#voice	语音消息
			$postObj->Format;		#语音格式，如amr，speex等 
			$postObj->MediaId;		#语音消息媒体id，可以调用多媒体文件下载接口拉取数据。

			if($postObj->MsgType=='voice')
			$content = 'MediaId：'.$postObj->MediaId."\nFormat:".$postObj->Format; 

			#video	视频消息
			$postObj->ThumbMediaId;	#视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据
			$postObj->MediaId;		#视频消息媒体id，可以调用多媒体文件下载接口拉取数据。  

			if($postObj->MsgType=='video')
			$content = 'MediaId：'.$postObj->MediaId."\nThumbMediaId:".$postObj->ThumbMediaId; 

			#location	地理位置消息
			$postObj->Location_X;	#地理位置维度
			$postObj->Location_Y;	#地理位置经度 
			$postObj->Scale;		#地图缩放大小
			$postObj->Label;		#地理位置信息

			if($postObj->MsgType=='location')
			$content = 'Location_X:'.$postObj->Location_X."\nLocation_Y:".$postObj->Location_Y."\nScale:".$postObj->Scale."\nLabel:".$postObj->Label; 
			
			#link	链接消息
			$postObj->Title;		#消息标题
			$postObj->Description;	#消息描述 
			$postObj->Url;			#消息链接

			if($postObj->MsgType=='link')
			$content = 'Title:'.$postObj->Title."\nDescription:".$postObj->Description."\nUrl:".$postObj->Url;

			#语音识别
			$postObj->Recognition;		#语音识别结果，UTF8编码 
			if($postObj->Recognition)
			$content = $postObj->Recognition;
			
			#自动回复消息
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";

			#回复文本消息	text
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						</xml>";
			
			#回复图片消息	image
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Image>
						<MediaId><![CDATA[EPK_MUh0gNfIKJW4mzdkqAn4NALJTgVptYQb0zLJKgWQzf62CEZHteKpXZWWA6dX]]></MediaId>
						</Image>
						</xml>";
			
			#回复语音消息	voice
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Voice>
						<MediaId><![CDATA[EPK_MUh0gNfIKJW4mzdkqAn4NALJTgVptYQb0zLJKgWQzf62CEZHteKpXZWWA6dX]]></MediaId>
						</Voice>
						</xml>";
			
			#回复视频消息	video
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Video>
						<MediaId><![CDATA[EPK_MUh0gNfIKJW4mzdkqAn4NALJTgVptYQb0zLJKgWQzf62CEZHteKpXZWWA6dX]]></MediaId>
						<Title><![CDATA[title]]></Title>
						<Description><![CDATA[description]]></Description>
						</Video>
						</xml>";
			
			#回复音乐消息	music
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Music>
							<Title><![CDATA[TITLE]]></Title>
							<Description><![CDATA[DESCRIPTION]]></Description>
							<MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
							<HQMusicUrl><![CDATA[HQ_MUSIC_Url]]></HQMusicUrl>
							<ThumbMediaId><![CDATA[media_id]]></ThumbMediaId>
						</Music>
						</xml>";

			#回复图文消息	news
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>2</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[标题1]]></Title> 
						<Description><![CDATA[描述1]]></Description>
						<PicUrl><![CDATA[http://www.baidu.com/img/baidu_sylogo1.gif]]></PicUrl>
						<Url><![CDATA[http://www.baidu.com/]]></Url>
						</item>
						<item>
						<Title><![CDATA[标题2]]></Title> 
						<Description><![CDATA[描述2]]></Description>
						<PicUrl><![CDATA[http://www.baidu.com/img/baidu_sylogo1.gif]]></PicUrl>
						<Url><![CDATA[http://www.baidu.com/?dd]]></Url>
						</item>
						</Articles>
						</xml>";


			echo sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), 'news', $content);
        }
    }

	#3.3 接收消息 接收事件推送
	public function getEvent()
    {
		#接收消息
		if (!empty($GLOBALS["HTTP_RAW_POST_DATA"])){
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			return $postObj;

			$postObj->ToUserName;	#开发者微信号
			$postObj->FromUserName;	#发送方帐号（一个OpenID）
			$postObj->CreateTime;	#消息创建时间 （整型）
			$postObj->MsgType;		#消息类型，event 

			#关注/取消关注事件
			$postObj->Event;	#事件类型，subscribe(订阅)、unsubscribe(取消订阅) 

			#扫描带参数二维码事件	用户未关注时
			$postObj->Event;		#事件类型， subscribe  
			$postObj->EventKey;		#事件KEY值，qrscene_为前缀，后面为二维码的参数值 
			$postObj->Ticket;		#二维码的ticket，可用来换取二维码图片

			#扫描带参数二维码事件	用户已关注时
			$postObj->Event;		#事件类型， SCAN   
			$postObj->EventKey;		#事件KEY值，是一个32位无符号整数，即创建二维码时的二维码scene_id 
			$postObj->Ticket;		#二维码的ticket，可用来换取二维码图片
			
			if( $postObj->Event=='subscribe' || $postObj->Event=='SCAN' )
			{
				$content = trim($postObj->EventKey,'qrscene_');
			}

			#上报地理位置事件
			$postObj->Event;		#事件类型，LOCATION
			$postObj->Latitude;		#地理位置纬度
			$postObj->Longitude;	#地理位置经度
			$postObj->Precision;	#地理位置精度
			if($postObj->Event=='LOCATION')
			{
				$content = 'Latitude:'.$postObj->Latitude."\nLongitude:".$postObj->Longitude."\nPrecision:".$postObj->Precision;
			}

			#自定义菜单事件		拉取消息
			$postObj->Event;		#事件类型，CLICK 
			$postObj->EventKey;		#事件KEY值，与自定义菜单接口中KEY值对应 

			if($postObj->Event=='CLICK')
			{
				$content = 'EventKey:'.$postObj->EventKey;
				if( $postObj->EventKey=='kefu' )
				{
					$content = '如您需要帮助，请致电我们客服中心。客服电话：4000-168-168。';
				}
			}

			#自定义菜单事件		跳转
			$postObj->Event;		#事件类型，VIEW 
			$postObj->EventKey;		#事件KEY值，设置的跳转URL  

			if($postObj->Event=='VIEW')
			{
				$content = 'EventKey:'.$postObj->EventKey;
			}


			#自动回复消息
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
			echo sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), 'text', $content);
        }
    }

	#4.2 发送消息 发送客服消息
	public function sendMsg()
    {
		$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->AccessToken;

		#菜单
		$msg = array(
			'touser'=>'oFziZjhjo5YxTI-mcYlz5Bsxb5n8',
			'msgtype'=>'text',
			'text'=>array(
				'content'=>urlencode('你好，欢迎关注我们微信号！')
			)
			);
		$msg = urldecode(json_encode($msg));

		$result = $this->postUrlContent( $url, $msg );
		pr($result);
	}

	#4.3 发送消息 高级群发消息
	public function sendMsgs()
    {
		/*
		$url = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.$this->AccessToken;
		$msg = '{"articles": [
		 {
                        "thumb_media_id":"G9ZtpPWlxzUHbrpaSouj5Wt0Uj_2iAsX28d0_gKpzEJyyw0ym5G5t2uTY0d9cb2W",
                        "author":"xxx",
			 "title":"Happy Day",
			 "content_source_url":"www.qq.com",
			 "content":"content",
			 "digest":"digest",
                        "show_cover_pic":"1"
		 },
		 {
                        "thumb_media_id":"G9ZtpPWlxzUHbrpaSouj5Wt0Uj_2iAsX28d0_gKpzEJyyw0ym5G5t2uTY0d9cb2W",
                        "author":"xxx",
			 "title":"Happy Day",
			 "content_source_url":"www.qq.com",
			 "content":"content",
			 "digest":"digest",
                        "show_cover_pic":"0"
		 }]}';
		$result = $this->postUrlContent( $url, $msg );
		[type] => news
		[media_id] => ZzFoV9ag53n6CPF5mcgqND56rIXJA6AynaV6MKprswvIxnPZW8y2c66BHOh1L2dp
		[created_at] => 1407491857
		*/


		#根据OpenID列表群发 
		$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$this->AccessToken;
		$msg = '{"touser":[
			"oFziZjiir3ihuFbytP7XeGsl6sLo",
			"oFziZjhjo5YxTI-mcYlz5Bsxb5n8"
		   ],
		   "mpnews":{
			  "media_id":"ZzFoV9ag53n6CPF5mcgqND56rIXJA6AynaV6MKprswvIxnPZW8y2c66BHOh1L2dp"
		   },
			"msgtype":"mpnews"}';

		$result = $this->postUrlContent( $url, $msg );
		pr($result);


		#删除群发消息
		/*
		$url = 'https://api.weixin.qq.com//cgi-bin/message/mass/delete?access_token='.$this->AccessToken;
		$msg = '{"msgid":30124}';
		$result = $this->postUrlContent( $url, $msg );
		pr($result);
		*/

	}

	#7.1 自定义菜单 创建
	public function createMenus( $menu=array() )
    {
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->AccessToken;
		return $this->postUrlContent( $url, urldecode(json_encode(array('button'=>$menu))) );
    }

	public function createMenusUrl( $url ){
		return urlencode('http://wx.hd.bitauto.com/index.php/indexs/Authorize/?redirect_url='.urlencode($url));
	}

	#7.2 自定义菜单 查询
	public function getMenus()
    {
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->AccessToken;

		$result = $this->getUrlContent( $url );
		pr($result);
    }

	#7.3 自定义菜单 删除
	public function delMenus()
    {
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->AccessToken;
		$result = $this->getUrlContent( $url );
		pr($result);
    }

	#8.1 生成带参数的二维码 (scene_id 1--100000 )
	public function createQRCode( $scene_id=100 )
    {
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->AccessToken;

		#永久
		$content = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id":'.$scene_id.'}}}';

		#临时
		#$content = '{"expire_seconds": 1800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id":'.$scene_id.'}}}';
		
		$result = $this->postUrlContent( $url, $content );

		#获取二维码
		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$result['ticket'];
		header("location:".$url);
		exit;
    }

	#设置 token
	public function setAccessToken( $access_token = array() ){

		#mysql 中的 access_token 有效
		if((intval($access_token['time']) - time()) <= 0 || empty($access_token['access_token']) )
		{
			$access_token = $this->getAccessToken();
		}
		$this->AccessToken = $access_token['access_token'];
		return $access_token;
	}

	#给用户发送消息
	public function postMsg( $openid, $msg = '', $msgtype='text'){

		$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->AccessToken;
		$content = '{"touser":"'.$openid.'","msgtype":"'.$msgtype.'","text":{"content":"'.$msg.'"}}';
		return $this->postUrlContent( $url, $content );
	}

	#获取access token 每日限额 （2000）
	public function getAccessToken(){
		$info = $this->getUrlContent('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->AppId.'&secret='.$this->AppSecret);
		#echo '--';
		#pr($info);
		#echo '==';

		return array('access_token'=>$info['access_token'],'time'=>time()+3600);
	}

	#第一步：用户同意授权，获取code
	public function getUserRedirect( $url, $state='' ){
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->AppId.'&redirect_uri='.urlencode($url).'&response_type=code&scope=snsapi_base&state='.$state.'#wechat_redirect';
		$this->redirect($url);
	}

	#第二步：通过code换取网页授权access_token
	public function getUserInfo($code){
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->AppId.'&secret='.$this->AppSecret.'&code='.$code.'&grant_type=authorization_code';
		$user_info = $this->getUrlContent($url);

		#执行 第四步
		return $this->getUser( $this->AccessToken,$user_info['openid'] );
	}

	#第三步：刷新access_token（如果需要）
	public function referToken($refresh_token){
		$url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$this->AppId.'&grant_type=refresh_token&refresh_token='.$refresh_token;
		
		return $this->getUrlContent($url);
	}

	#第四步：拉取用户信息(需scope为 snsapi_userinfo)
	public function getUser( $access_token, $openid ){
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		#$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		return $this->getUrlContent($url);
	}

	public function getCodeImg(){

		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->AccessToken;
		$content = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 100000}}}';

		$info = $this->postUrlContent( $url, $content );
		pr($info);

		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$info['ticket'];
		
		return $this->redirect($url);
	}

	#跳转
	public function redirect($url){
		header("location:".$url);
		exit;
	}

	#获取内容
	public function getUrlContent($url){

		return $this->postUrlContent($url);
	}

	#获得内容
	public function postUrlContent($url='', $data='' ){
		//分析url
		$domain_info = parse_url($url);

		//基础配置
		$option = array(

			//要访问的地址
			CURLOPT_URL=>$url,

			//超时时间 5 秒
			CURLOPT_TIMEOUT=>5,

			//自动设置Referer
			CURLOPT_AUTOREFERER=>true,

			//手动设置Referer
		   CURLOPT_REFERER=>'http://'.$domain_info['host'].'/',

			//将获取的信息以文件流的形式返回
			CURLOPT_RETURNTRANSFER=>true,
			
			//模拟浏览器
			CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT'],

			//对认证证书来源的检查
			CURLOPT_SSL_VERIFYPEER=>0,
			
			//从证书中检查SSL加密算法是否存在
			CURLOPT_SSL_VERIFYHOST=>0

			);

		//设置COOKIE
		#$option[CURLOPT_COOKIEJAR]        = 'F:\cookie\cookies.txt';    //设置

		//POST
		if($data)
		{
			$option[CURLOPT_POST]					= true;
			$option[CURLOPT_POSTFIELDS]				= $data;
		}

		//初始化
		$ch = curl_init();

		//配置参数
		curl_setopt_array($ch, $option);

		//执行获得返回值
		$c = curl_exec($ch);

		//关闭
		curl_close($ch);

		$result = $this->resultFormat($c);
		
		#如果有错，直接显示错误信息。
		if(isset($result['errcode']) && $result['errcode']!=0)
		{
			if(isset($this->errcode[$result['errcode']]))
			{
				$this->msg($result['errcode'].'.系统错误：'.$this->errcode[$result['errcode']]);
			}
			else
			{
				$this->msg($result['errcode'].'异常错误：'.$result['errcode']);
			}
		}

		return $result;

		//返回结果 过滤换行
		#return strtr($c,array("\t"=>'',"\r"=>'',"\n"=>''));
		return strtr($c,array("\t"=>'',"\r\n"=>''));
	}

	#格式化返回结果
	public function resultFormat($str){
		return json_decode($str,true);
	}

	#输出消息
	public function msg($msg){
		echo $msg;
		exit;
	}
}