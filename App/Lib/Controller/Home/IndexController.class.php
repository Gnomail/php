<?php
require(LIB_PATH.'Controller'.EXT);
class IndexController extends Controller{
  public function Index()
  {
    $data   = array(
      'name' => 'Mike',
      'age'  => '27'
    );
    $result = M('user')->add($data);
    var_dump($result);
  }

  public function Welcome()
  {
    $this->assign('name','Gnomail');
    $this->display();
  }
}
