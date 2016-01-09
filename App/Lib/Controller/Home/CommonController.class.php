<?php
require(LIB_PATH.'Controller'.EXT);
class CommonController extends Controller{
  public function Time()
  {
    $this->assign('time',date('Y-m-d H:i:s'));
    $this->display();
  }
}
