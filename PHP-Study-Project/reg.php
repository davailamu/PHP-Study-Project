<?
session_start();
require_once('patterns/user.php');

$fio = $_POST['reg_fio'];
$login = $_POST['reg_login'];
$mail = $_POST['reg_mail'];
$password = $_POST['reg_password'];
$r_password = $_POST['reg_r_password'];
$phone = $_POST['reg_phone'];
$sex = $_POST['reg_sex'];
$salt = $_POST['salt'];
$today = getdate();
$date = $today[year].'-'.$today[mon].'-'.$today[mday];
$date_log = $today[year].'-'.$today[mon].'-'.$today[mday].' '.$today[hours].':'.$today[minutes];

$fd = fopen('log.txt', 'w') or die('Ошибка записи log');
$success = 'Регистрация прошла успешно '.$date_log."\n";
$fail = 'Регистрация завершена ошибкой '.$date_log."\n";

$user = new NewUser($fio, $login, $mail, $password, $r_password, $phone, $sex, $salt, $date);

$result = $user->userCheck();
if($result) {
    if($user->userRegister()) {
      fwrite($fd, $success);
      fclose($fd);
      print "<script language='Javascript' type='text/javascript'>
       alert ('Пользователь успешно зарегистрирован!');
       function reload() {
         top.location = '../../index.php'
       };
       setTimeout('reload()', 0);
       </script>";
    }
  }
else {
  fwrite($fd, $fail);
  fclose($fd);
  print $result;
}
