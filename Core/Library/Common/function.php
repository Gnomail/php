<?php

/*
 * 加载/设置配置选项
 */
 function C($key='',$value='')
 {
   //加载核心配置文件
   $libConfig = include(LIB_PATH.'Conf/config.php');
   //加载项目配置文件
   $extConfig = is_file(CONF_PATH.'config'.CONF_EXT) ? include(CONF_PATH.'config'.CONF_EXT) : array();

   //合并配置文件
   $globalConfig = array_merge($libConfig,$extConfig);
   if(!empty($globalConfig['LOAD_EXT_CONFIG']))
   {
     $fileArr = explode(',',$globalConfig['LOAD_EXT_CONFIG']);
     foreach($fileArr as $v)
     {
       if(is_file(CONF_PATH.$v.CONF_EXT))
       {
         $tempConfig   = include(CONF_PATH.$v.CONF_EXT);
         $globalConfig = array_merge($globalConfig,$tempConfig);
       }
     }
   }
   if(empty($key))
   {
     return $globalConfig;
   }
   else
   {
     $key = strtoupper($key);
     if(empty($value))
     {
       return $globalConfig[$key];
     }
     else
     {
       $globalConfig[$key] = $value;
     }
   }
 }

/*
 *实例化数据库模型
 */
 function M($table='',$prefix='',$connection='')
 {
   return new Model($table,$prefix,$connection);
 }
