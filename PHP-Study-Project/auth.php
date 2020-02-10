<?
require_once('patterns/user.php');

$login = $_POST['login'];
$password = $_POST['password'];
$r_password = $_POST['r_password'];

$user = new LoginUser($login, $password, $r_password);
$result = $user->userCheck();

if($result) {
  if (session_start()) {
    $_SESSION['username'] = $login;
    print "<script language='Javascript' type='text/javascript'>
     location.href = 'catalog.php';
     </script>";
  }
  else {
    "<script language='Javascript' type='text/javascript'>
     alert ('Ошибка создания сессии');
     location.href = 'index.php';
     </script>";
  }
}
else {
  print $result;
}
