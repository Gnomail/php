<?php
//数据库配置文件
return array(
    //查询使用从库
    'DEFAULT_DB_CONFIG' => array(
      'DB_TYPE'           =>'mysql',
      'DB_HOST'           =>'127.0.0.1',
      'DB_NAME'           =>'market',
      'DB_USER'           =>'root',
      'DB_PWD'            =>'',
      'DB_PORT'           =>'3306',
      'DB_PREFIX'         =>'mkt_',
      'LOGIN_TIMEOUT'     =>'999',
    ),


    //bbs单独库
    'BBS_DB_PREFIX'     =>'lzh_',
    'BBS_CONNECTION'    =>'mysql://pccb:Q#afeEc9oi09@121.40.201.120:3306/kuku',

    //写入使用主库
    'MAIN_DB_PREFIX'    =>'lzh_',
    'MAIN_CONNECTION'   =>'mysql://pccb_test:QAZWSxedc123@192.168.1.77:3306/kuku'
);
