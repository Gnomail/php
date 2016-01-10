<?php

/*
 *生成随机字符串
 */
 function getRandStr($length=4,$type='all')
 {
   switch ($type) {
     case 'letter':
       $pool = 'abcdefghijklmnopqrstuvwxyz';
       break;
     case 'number':
       $pool = '1234567890';
       break;
     default:
       $pool = 'abcdefghijklmnopqrstuvwxyz1234567890';
       break;
   }

   $pLen = strlen($pool)-1;

   $string = '';
   for($i=0;$i<$length;$i++)
   {
      $rand = rand(0,$pLen);
      $string.=substr($pool,$rand,1);
   }
   return $string;
 }
