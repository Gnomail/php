<?php
require(LIB_PATH.'Controller'.EXT);
class IndexController extends Controller{
  public function Index()
  {

  }

  public function Welcome()
  {
    $this->assign('name','Gnomail');
    $this->display();
  }
}
