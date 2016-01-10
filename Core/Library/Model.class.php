<?php
class Model{
  protected $dbType;
  protected $host;
  protected $port;
  protected $user;
  protected $password;
  protected $dbName;
  protected $prefix;
  protected $table;

  protected $connection;

  protected $data;
  protected $field;
  protected $where;
  protected $group;
  protected $sql;

  public function __construct($table='',$prefix='',$db='')
  {
    //加载指定数据库配置或默认配置
    if(empty($db)||empty(C(strtoupper($db).'_DB_CONFIG')))
    {
      $dbConfig = C('DEFAULT_DB_CONFIG');
    }
    else
    {
      $dbConfig = C(strtoupper($db).'_DB_CONFIG');
    }
    $this->dbType   = $dbConfig['DB_TYPE'];
    $this->host     = $dbConfig['DB_HOST'];
    $this->port     = $dbConfig['DB_PORT'];
    $this->user     = $dbConfig['DB_USER'];
    $this->password = $dbConfig['DB_PWD'];
    $this->user     = $dbConfig['DB_USER'];
    $this->dbName   = $dbConfig['DB_NAME'];
    $this->prefix   = empty($prefix) ? $dbConfig['DB_PREFIX'] : $prefix;
    $this->table    = strtolower($this->prefix.$table);

    @$this->connection = mysql_connect($this->host.':'.$this->port,$this->user,$this->password) or die('Fail to connect database');
    mysql_select_db($this->dbName);

  }

  protected function getPK()
  {
    $this->sql  = 'DESC '.$this->table;
    $desc = $this->query();
    if(!empty($desc))
    {
      foreach($desc as $v)
      {
        if($v['Key']=='PRI')
        {
          return $v['Field'];
          break;
        }
      }
    }
    return false;
  }

  public function query($sql='')
  {
    if(!empty($sql))
    {
      $this->sql = $sql;
    }

    $query = mysql_query($this->sql);
    if(is_resource($query))
    {
      $result = array();
      while($row=mysql_fetch_assoc($query))
      {
        array_push($result,$row);
      }
      return $result;
    }
    return $query;
  }

  public function data($data)
  {
    $this->data = $data;
    return $this;
  }
  public function group($group)
  {
    $pattern = '/group.*by/';
    $group   = trim(preg_replace($pattern,'',$group));
    if(!empty($group))
    {
        $this->group = ' GROUP BY '.$group;
    }
    return $this;
  }
  public function field($field='')
  {
    if(empty($field))
    {
      $this->field = '*';
    }
    else
    {
        if(!is_array($field))
        {
          $field = explode(',',$field);
        }
        $this->field = "`".implode("`,`",$field)."`";
    }
    return $this;
  }

  public function where($where='')
  {
    if(is_array($where))
    {
      $whereArr = array();
      foreach($where as $k=>$v)
      {

      }
    }
  }

  public function add($data=array())
  {
    if(!empty($data))
    {
      $this->data = $data;
    }
    $keyArr = array_keys($this->data);
    $valArr = array_values($this->data);

    $keyStr = "`".implode("`,`",$keyArr)."`";
    $valStr = "'".implode("','",$valArr)."'";

    $this->sql = "insert into ".$this->table."(".$keyStr.") values (".$valStr.")";
    $query     = $this->query();
    if($query)
    {
      return mysql_insert_id();
    }
    else
    {
      return false;
    }
  }

  public function addAll($data=array())
  {
    if(!empty($data))
    {
      $this->data = $data;
    }

    //如果是一维数组，执行单条插入
    if(!is_array($this->data[0]))
    {
      return $this->add();
    }

    $keyArr = array_keys($this->data[0]);
    $keyStr = "`".implode("`,`",$keyArr)."`";

    $totalValArr = array();
    foreach($this->data as $v)
    {
      $valArr = array_values($v);
      $valStr = "'".implode("','",$valArr)."'";

      array_push($totalValArr,$valStr);
    }
    $totalValStr = "(".implode("),(",$totalValArr).")";

    $this->sql = "insert into ".$this->table." (".$keyStr.") values ".$totalValStr;
    $query = $this->query();
    if($query)
    {
      return mysql_insert_id();
    }
    else
    {
      return false;
    }
  }

  public function delete($ids='')
  {
    $pk = $this->getPK();
    if(empty($pk))
    {
      return false;
    }
    //计算删除了几条数据
    $beforeCount  = $this->count();
    $this->sql    = 'DELETE FROM `'.$this->table.'` where `'.$pk.'` in ('.$ids.')';
    $delete       = $this->query();
    if($delete)
    {
        $afterCount   = $this->count();
        return $beforeCount - $afterCount;
    }
    return false;
  }

  public function count()
  {
    $this->sql = 'SELECT COUNT(*) as my_count FROM `'.$this->table.'` '.$this->where.$this->group;
    $count     = $this->query();
    if(!empty($count))
    {
      return intval($count[0]['my_count']);
    }
    return false;
  }

  public function find($sql)
  {
    $query = $this->query($sql);
    return mysql_fetch_assoc($query);
  }

  public function select($sql)
  {
    return $this->query($sql);
  }

}
