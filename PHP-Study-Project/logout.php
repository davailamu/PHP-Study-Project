<?
session_start();
session_destroy();
print "<script language='Javascript' type='text/javascript'>
 alert ('Вы вышли из системы');
 function reload() {
   top.location = '../../index.php'
 };
 setTimeout('reload()', 0);
 </script>";
