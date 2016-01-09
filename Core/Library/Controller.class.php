<?php
require(LIB_PATH.'Model'.EXT);
require(LIB_PATH.'View'.EXT);
class Controller{
  protected $view;

  public function __construct()
  {
    $this->view = new View();
  }

  protected function assign($key,$value)
  {
    $this->view->assign($key,$value);
  }

  protected function display($tpl='')
  {
    $this->view->mydisplay($tpl);
  }

  protected function fetch($tpl='')
  {
    return $this->view->myfetch($tpl);
  }
}
