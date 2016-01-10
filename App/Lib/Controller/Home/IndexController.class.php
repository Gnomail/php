<?php
require(LIB_PATH.'Controller'.EXT);
class IndexController extends Controller{
  public function Index()
  {
    $a = M('User')->count();
    print_r($a);
  }

  public function add()
  {
    $s = microtime(true);
    $bigData = array();
    for($i=0;$i<100;$i++)
    {
      $name = ucfirst(getRandStr(4,'letter'));
      $age  = getRandStr(2,'number');
      $data = array(
        'name' => $name,
        'age'  => $age
      );
      array_push($bigData,$data);
    }
    $addAll = M('User')->addAll($bigData);
    $e = microtime(true);
    var_dump($addAll);
    var_dump($e-$s);
  }
}
