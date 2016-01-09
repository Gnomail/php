<?php
require(LIB_PATH.'Dispatcher'.EXT);
class App{

  /*
   *初始化框架，加载各种文件
   */
  public static function init()
  {
    include(LIB_PATH.'Common/function.php');
    if(is_file(COMMON_PATH.'function.php')) include(COMMON_PATH.'function.php');
  }

  public static function run()
  {
    self::init();
    Dispatcher::dispatch();
  }

}
