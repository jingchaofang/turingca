<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE' =>  'mysql',     // 数据库类型
    'DB_HOST' =>  '127.0.0.1', // 服务器地址
    'DB_NAME' =>  'turingca',          // 数据库名
    'DB_USER' =>  'root',      // 用户名
    'DB_PWD'  =>  '',          // 密码
    'DB_PORT' =>  '3306',        // 端口
    'DB_PREFIX' =>  'tca_',    // 数据库表前缀
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    //URL路由配置
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES'=>array(
    ':uid\d'=>'Home/User/index',
    ),
    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' =>true,

    
);