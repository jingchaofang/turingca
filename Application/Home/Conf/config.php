<?php
return array(
	//用于异位或加密的KEY
	'ENCRYPTION_KEY'=>'com.turingca.com',
	//自动登陆保存时间
	'AUTO_LOGIN_TIME'=> 3600*24*7 ,//一个星期
	//图片上传
	'UPLOAD_MAX_SIZE' => 2000000,	//最大上传大小2M
	'UPLOAD_PATH' => './Uploads/',	//文件上传保存路径
	'UPLOAD_EXTS' => array('jpg', 'jpeg', 'gif', 'png'),	//允许上传文件的后缀

	
);