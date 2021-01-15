<?php
header("Content-type: text/html; charset=utf-8");
?>
<?php

session_start();
if ($_SESSION['log'] == 'yes_auth')
{

 include("include/db_connect.php");
  include("functions/functions.php");

  if ($_POST["save_submit"])
    {

   $_POST["info_surname"] = clear_string($_POST["info_surname"]);
   $_POST["info_name"] = clear_string($_POST["info_name"]);
   $_POST["info_otec"] = clear_string($_POST["info_otec"]);
   $_POST["info_address"] = clear_string($_POST["info_address"]);
   $_POST["info_phone"] = clear_string($_POST["info_phone"]);
   $_POST["info_email"] = clear_string($_POST["info_email"]);

   $error = array();

   $pass   = md5($_POST["info_pass"]);
   $pass   = strrev($pass);
   $pass   = "1w3r5y7u".$pass."0m9b8v";

  if($_SESSION['log_pass'] != $pass)
  {
   $error[]='Неверный пароль!';
  }else
   {

     if($_POST["info_new_pass"] != "")
  {
           if(strlen($_POST["info_new_pass"]) < 5 || strlen($_POST["info_new_pass"]) > 15)
             {
              $error[]='Укажите новый пароль от 5 до 15 символов!';
             }else
               {
                    $newpass   = md5(clear_string($_POST["info_new_pass"]));
                    $newpass   = strrev($newpass);
                    $newpass   = "1w3r5y7u".$newpass."0m9b8v";
                    $newpassquery = "password='".$newpass."',";
               }
  }



       if(strlen($_POST["info_surname"]) < 2 || strlen($_POST["info_surname"]) > 15)
  {
   $error[]='Укажите фамилию от 2 до 15 символов!';
  }


       if(strlen($_POST["info_name"]) < 2 || strlen($_POST["info_name"]) > 15)
  {
   $error[]='Укажите имя от 2 до 15 символов!';
  }


       if(strlen($_POST["info_otec"]) < 2 || strlen($_POST["info_otec"]) > 25)
  {
   $error[]='Укажите отчество от 2 до 25 символов!';
  }


       if(!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($_POST["info_email"])))
  {
   $error[]='Укажите корректный E-mail!';
  }

     if(strlen($_POST["info_phone"]) == "")
  {
   $error[]='Укажите свой телефон!';
  }

     if(strlen($_POST["info_address"]) == "")
  {
   $error[]='Укажите свой адресс!';
  }



   }

  if(count($error))
  {
   $_SESSION['msg'] = "<p align='left' id='form-error'>".implode('<br />',$error)."</p>";
  }else
   {
       $_SESSION['msg'] = "<p align='left' id='form-success'>Профиль успешно отредактирован!</p>";

    $dataquery = $newpassquery."surname='".$_POST["info_surname"]."',name='".$_POST["info_name"]."',otec='".$_POST["info_otec"]."',email='".$_POST["info_email"]."',phone='".$_POST["info_phone"]."',address='".$_POST["info_address"]."'";
    $update = mysql_query("UPDATE user SET $dataquery WHERE login = '{$_SESSION['log_login']}'",$link);

   if ($newpass){ $_SESSION['log_pass'] = $newpass; }


   $_SESSION['log_surname'] = $_POST["info_surname"];
   $_SESSION['log_name'] = $_POST["info_name"];
   $_SESSION['log_otec'] = $_POST["info_otec"];
   $_SESSION['log_address'] = $_POST["info_address"];
   $_SESSION['log_phone'] = $_POST["info_phone"];
   $_SESSION['log_email'] = $_POST["info_email"];

   }

    }

?>

<html>

<head>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/main-script.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
  <script type="text/javascript" src="trackbar/jquery.trackbar.js"></script>
  <script type="text/javascript" src="js/TextChange.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>

<div id="block-body">

  <?php
  include("include/nav-bar.php");
  ?>


</div>
<div id="block-content-1" style="margin-top:25px;">

  <h3 class="h3-title">Редактирование профиля(<a id="user-glav" href="assembler.php" style=" color:#cc0000;">Главная</a>)</h3>

<?php
if($_SESSION['msg'])
{
echo $_SESSION['msg'];
unset($_SESSION['msg']);
}
 ?>

  <form method="post">

  <ul id="info-profile">
  <li>
  <label for="info_pass">Текущий пароль</label>
  <span class="star">*</span>
  <input type="text" name="info_pass" id="info_pass" value="" />
  </li>

  <li>
  <label for="info_new_pass">Новый пароль</label>
  <span class="star">*</span>
  <input type="text" name="info_new_pass" id="info_new_pass" value="" />
  </li>

  <li>
  <label for="info_surname">Фамилия</label>
  <span class="star">*</span>
  <input type="text" name="info_surname" id="info_surname" value="<?php echo $_SESSION['log_surname']; ?>"  />
  </li>

  <li>
  <label for="info_name">Имя</label>
  <span class="star">*</span>
  <input type="text" name="info_name" id="info_name" value="<?php echo $_SESSION['log_name']; ?>"  />
  </li>

  <li>
  <label for="info_otec">Отчество</label>
  <span class="star">*</span>
  <input type="text" name="info_otec" id="info_otec" value="<?php echo $_SESSION['log_otec']; ?>" />
  </li>


  <li>
  <label for="info_email">E-mail</label>
  <span class="star">*</span>
  <input type="text" name="info_email" id="info_email" value="<?php echo $_SESSION['log_email']; ?>" />
  </li>

  <li>
  <label for="info_phone">Телефон</label>
  <span class="star">*</span>
  <input type="text" name="info_phone" id="info_phone" value="<?php echo $_SESSION['log_phone']; ?>" />
  </li>

  <li>
  <label for="info_address">Ваш адресс</label>
  <span class="star">*</span>
  <textarea name="info_address"  > <?php echo $_SESSION['log_address']; ?> </textarea>
  </li>

  </ul>

   <p align="right"><input type="submit" id="form_submit" name="save_submit" value="Сохранить" /></p>
  </form>

</div>
</body>

</html>
<?php
}  else { header("Location: assembler.php");  }
 ?>
