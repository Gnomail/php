<?php
require(LIB_PATH.'Smarty/Smarty.class.php');
class View extends Smarty{
  public function __construct()
  {
    parent::__construct();
    $this->template_dir = VIEW_PATH;
    $this->compile_dir  = COMPILE_PATH.MODULE_NAME.DS.CONTROLLER_NAME;
    $this->cache_dir    = CACHE_PATH.MODULE_NAME.DS.CONTROLLER_NAME;
    $this->caching      = FALSE;
  }

  public function mydisplay($tpl)
  {
    if(empty($tpl))
    {
      $tpl = ACTION_NAME.TPL_EXT;
    }
    $tpl = MODULE_NAME.DS.CONTROLLER_NAME.DS.$tpl;
    $this->display($tpl);
  }

  public function myfetch($tpl)
  {
    if(empty($tpl))
    {
      $tpl = ACTION_NAME.TPL_EXT;
    }
    $tpl = MODULE_NAME.DS.CONTROLLER_NAME.DS.$tpl;
    return $this->fetch($tpl);
  }
}
