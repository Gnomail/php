<?php


// 类文件后缀
const EXT               = '.class.php';
//模板文件后缀
const TPL_EXT           = '.tpl';
//配置文件后缀
const CONF_EXT          = '.php';

const DS                = DIRECTORY_SEPARATOR;
//时区
date_default_timezone_set('Asia/Shanghai');

// 系统常量定义
defined('CORE_PATH')    or define('CORE_PATH'    , __DIR__.'/');
defined('LIB_PATH')     or define('LIB_PATH'     , CORE_PATH.'/Library/');

defined('COMMON_PATH')     or define('COMMON_PATH'     , APP_PATH.'/Common/');
defined('CONF_PATH')       or define('CONF_PATH'       , APP_PATH.'/Conf/');
defined('RUNTIME_PATH')    or define('RUNTIME_PATH'    , APP_PATH.'/Runtime/');
defined('COMPILE_PATH')    or define('COMPILE_PATH'    , RUNTIME_PATH.'/Compile/');
defined('CACHE_PATH')      or define('CACHE_PATH'      , RUNTIME_PATH.'/Cache/');
defined('PROJECT_PATH')    or define('PROJECT_PATH'    , APP_PATH.'/Lib/');
defined('CONTROLLER_PATH') or define('CONTROLLER_PATH' , PROJECT_PATH.'/Controller/');
defined('MODEL_PATH')      or define('MODEL_PATH'      , PROJECT_PATH.'/Model/');
defined('VIEW_PATH')       or define('VIEW_PATH'       , PROJECT_PATH.'/View/');


defined('DEFAULT_MODULE')     or define('DEFAULT_MODULE',    'Home');
defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER','Index');
defined('DEFAULT_ACTION')     or define('DEFAULT_ACTION',    'Index');

require(LIB_PATH.'App'.EXT);
App::run();
