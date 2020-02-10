<?
interface User {
  public function userCheck();
}

class NewUser implements User {
  public function __construct($fio, $login, $mail, $password, $r_password, $phone, $sex, $salt, $date) {
    $this->fio = $fio;
    $this->login = $login;
    $this->mail = $mail;
    $this->password = $password;
    $this->r_password = $r_password;
    $this->phone = $phone;
    $this->sex = $sex;
    $this->salt = $salt;
    $this->date = $date;
  }
  public function userCheck() {
    $link = mysqli_connect("127.0.0.1", "root", "12345", "phpfinal") or die("Ошибка " . mysqli_error($link));
    $query = "SELECT * FROM users WHERE login = '$login'";
    $result  = mysqli_query($link, $query) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    if(count($row) == 0) {
      if ($this->salt == $_SESSION['captcha']) {
          if(preg_match('/^[A-ZА-Яa-zа-я0-9_]{4,}$/', $this->login) && !preg_match('/([\S])\1\1\1+/', $this->login)) {
            if(!preg_match('/[#$%^&_=+-]/', $this->password) && strlen($this->password) >= 8) {
              if($this->password == $this->r_password) {
                if(preg_match("/^[0-9]{9}$/", $this->phone)){
                    return true;
                  }
                  else {
                    $result = "<script language='Javascript' type='text/javascript'>
                     alert ('Неверный формат номера телефона');
                     href.location = 'index.php';
                     </script>";
                    return $result;
                  }
              }
              else {
                $result = "<script language='Javascript' type='text/javascript'>
                 alert ('Пароли не совпадают');
                 href.location = 'index.php';
                 </script>";
                return $result;
              }
            }
            else {
              $result = "<script language='Javascript' type='text/javascript'>
               alert ('Неверный формат пароля');
               location.href = 'index.php';
               </script>";
              return $result;
            }
          }
          else {
            $result = "<script language='Javascript' type='text/javascript'>
             alert ('Неверный формат логина');
             location.href = 'index.php';
             </script>";
            return $result;
          }
      }
      else {
        $result = "<script language='Javascript' type='text/javascript'>
         alert ('Неверное значение капчи');
         location.href = 'index.php';
         </script>";
        return $result;
      }
    }
    else {
      $result = "<script language='Javascript' type='text/javascript'>
       alert ('Пользователь уже существует');
       location.href = 'index.php';
       </script>";
      return $result;
    }
  }
  public function userRegister() {
    $this->password = md5(md5($this->password).$this->salt);
    $link = mysqli_connect("127.0.0.1", "root", "12345", "phpfinal") or die("Ошибка " . mysqli_error($link));
    $query = ("INSERT into users (login, password, salt, mail, fio, sex, reg_date, phone)
    values ('$this->login', '$this->password', '$this->salt', '$this->mail', '$this->fio', '$this->sex', '$this->date', '$this->phone')");
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if ($result) {
      return true;
    }
  }
}

class LoginUser implements User {
  public function __construct($login, $password, $r_password) {
    $this->login = $login;
    $this->password = $password;
    $this->r_password = $r_password;
  }
  public function userCheck() {
    $link = mysqli_connect("127.0.0.1", "root", "12345", "phpfinal") or die("Ошибка " . mysqli_error($link));
    $query = "SELECT password, salt FROM users WHERE login = '$this->login'";
    $result  = mysqli_query($link, $query) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    $password_from_base = $row[password];
    if(count($row) != 0) {
      if($this->password == $this->r_password) {
        $this->password = md5(md5($this->password).$row[salt]);
        if($this->password == $password_from_base) {
          return true;
        }
        else {
          $result = "<script language='Javascript' type='text/javascript'>
          alert('Неверный пароль');
          location.href = 'index.php';
           </script>";
           return $result;
        }
      }
      else {
        $result = "<script language='Javascript' type='text/javascript'>
        alert('Пароли не совпадают');
        location.href = 'index.php';
         </script>";
         return $result;
      }
    }
    else {
      $result = "<script language='Javascript' type='text/javascript'>
      alert('Пользователь не найден');
      location.href = 'index.php';
       </script>";
       return $result;
    }
  }
}
