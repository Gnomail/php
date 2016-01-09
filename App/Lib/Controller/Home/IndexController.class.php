<?php
require(LIB_PATH.'Controller'.EXT);
class IndexController extends Controller{
  public function Index()
  {
    $sql = 'select * from mkt_user';
    $result = M()->query($sql);
    print_r($result);
  }

  public function Welcome()
  {
    $this->assign('name','Gnomail');
    $this->display();
  }
}
