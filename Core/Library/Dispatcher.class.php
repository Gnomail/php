<?php
class Dispatcher{
  static public function dispatch()
  {

    $pathinfo = empty($_SERVER['PATH_INFO']) ? '' : trim($_SERVER['PATH_INFO'],'/');


    if(empty($pathinfo))
    {
      $module     = DEFAULT_MODULE;
      $controller = DEFAULT_CONTROLLER;
      $action     = DEFAULT_ACTION;
    }
    else
    {
      $pathinfo = explode('/',$pathinfo);
      foreach($pathinfo as $k=>$v)
      {
        $pathinfo[$k] = ucfirst(strtolower($v));
      }

      if(is_dir(CONTROLLER_PATH.$pathinfo[0]))
      {
        $module     = $pathinfo[0];
        $controller = empty($pathinfo[1]) ? DEFAULT_CONTROLLER : $pathinfo[1];
        $action     = empty($pathinfo[2]) ? DEFAULT_CONTROLLER : $pathinfo[2];
      }
      else
      {
        $module     = DEFAULT_MODULE;
        $controller = empty($pathinfo[0]) ? DEFAULT_CONTROLLER : $pathinfo[0];
        $action     = empty($pathinfo[1]) ? DEFAULT_CONTROLLER : $pathinfo[1];
      }
    }

    define('CONTROLLER_NAME',$controller);
    define('MODULE_NAME'    ,$module);
    define('ACTION_NAME'    ,$action);

    $controllerName = $controller.'Controller';

    require(CONTROLLER_PATH.$module.DS.$controller.'Controller'.EXT);
    $obj = new $controllerName();
    $obj->$action();
  }
}
