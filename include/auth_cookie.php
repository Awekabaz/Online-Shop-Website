<?php
 if ($_SESSION['auth'] != 'yes_auth' && $_COOKIE["rememberme"])
  {

  $str = $_COOKIE["rememberme"];

  // Длина строки
  $all_len = strlen($str);
  // длина логина
  $login_len = strpos($str,'+');
  // Обрезаем строку до плюча и получаем логин
  $login = clear_string(substr($str,0,$login_len));

  // получаем пароль
  $pass = clear_string(substr($str,$login_len+1,$all_len));


     $result = mysql_query("SELECT * FROM user WHERE (login = '$login' or email = '$login') AND password = '$pass'",$link);
If (mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    session_start();
    $_SESSION['auth'] = 'yes_auth';
    $_SESSION['auth_pass'] = $row["password"];
    $_SESSION['auth_login'] = $row["login"];
    $_SESSION['auth_surname'] = $row["surname"];
    $_SESSION['auth_name'] = $row["name"];
    $_SESSION['auth_otec'] = $row["otec"];
    $_SESSION['auth_address'] = $row["address"];
    $_SESSION['auth_phone'] = $row["phone"];
    $_SESSION['auth_email'] = $row["email"];

}



  }
?>
