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

  public function data($data)
  {
    $this->data = $data;
    return $this;
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
