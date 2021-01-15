<?php
header("Content-type: text/html; charset=utf-8");
mysql_query("SET NAMES 'cp1251';");
?>
<?php
 include("include/db_connect.php");
 include("functions/functions.php");
 session_start();
  include("include/auth_cookie.php");
?>

<html>

<head>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/main-script.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
  <script type="text/javascript" src="js/jquery.form.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/TextChange.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript">
$(document).ready(function() {
    $('#form_reg').validate(
      {
        rules:{
          "reg_login":{
            required:true,
            minlength:5,
            maxlength:15,
            remote: {
            type: "post",
           url: "registration/check_login.php"
                              }
          },
          "reg_pass":{
            required:true,
            minlength:5,
            maxlength:15
          },
          "reg_surname":{
            required:true,
            minlength:2,
            maxlength:15
          },
          "reg_name":{
            required:true,
                          minlength:2,
                          maxlength:15
          },
          "otec":{
            required:true,
                          minlength:2,
                          maxlength:25
          },
          "reg_email":{
              required:true,
            email:true
          },
          "reg_phone":{
            required:true
          },
          "reg_address":{
            required:true
          },

        },

        // сообщения при ошибках
        messages:{
          "reg_login":{
            required:"Поле должно быть заполнено!",
                          minlength:"от 5 до 15 символов!",
                          maxlength:"от 5 до 15 символов!",
                          remote: "Логин занят!"
          },
          "reg_pass":{
            required:"Поле должно быть заполнено!",
                          minlength:"от 5 до 15 символов!",
                          maxlength:"от 5 до 15 символов!"
          },
          "reg_surname":{
            required:"Поле должно быть заполнено!",
                          minlength:"от 2 до 15 символов!",
                          maxlength:"от 2 до 15 символов!"
          },
          "reg_name":{
            required:"Поле должно быть заполнено!",
                          minlength:"от 2 до 15 символов!",
                          maxlength:"от 2 до 15 символов!"
          },
          "otec":{
            required:"Поле должно быть заполнено!",
                          minlength:"от 2 до 25 символов!",
                          maxlength:"от 2 до 25 символов!"
          },
          "reg_email":{
              required:"Укажите E-mail",
            email:"Не корректный E-mail"
          },
          "reg_phone":{
            required:"Поле должно быть заполнено!"
          },
          "reg_address":{
            required:"Укажите свой адресс!"
          },

        },

submitHandler: function(form){
$(form).ajaxSubmit({
success: function(data) {

      if (data == 'true')
  {
     $("#block-form-registration").fadeOut(300,function() {

      $("#reg_message").addClass("reg_message_success").fadeIn(400).html("Регистрация прошла успешно");
      $("#form_submit").hide();

     });

  }
  else
  {
     $("#reg_message").addClass("reg_message_error").fadeIn(400).html(data);
  }
  }
    });
    }
    });
    });

</script>

  <title>Регистрация</title>
</head>

<body>

<div id="block-body">

  <?php
  include("include/nav-bar.php");
  ?>



<div id="block-content-reg">

  <h2 class="h2-title">Регистрация</h2>
  <form method="post" id="form_reg" action="registration/srav_reg.php">
  <p id="reg_message"></p>
  <div id="block-form-registration">
  <ul id="form-registration">

  <li>
  <label>Логин</label>
  <span class="star" >*</span>
  <input type="text" name="reg_login" id="reg_login"  />
  </li>

  <li>
  <label>Пароль</label>
  <span class="star" >*</span>
  <input type="text" name="reg_pass" id="reg_pass"  />
  <span id="gen_pass">Подобрать</span>
  </li>

  <li>
  <label>Фамилия</label>
  <span class="star" >*</span>
  <input type="text" name="reg_surname" id="reg_surname" />
  </li>

  <li>
  <label>Имя</label>
  <span class="star" >*</span>
  <input type="text" name="reg_name" id="reg_name"  />
  </li>

  <li>
  <label>Отчество</label>
  <span class="star" >*</span>
  <input type="text" name="otec" id="otec" />
  </li>

  <li>
  <label>E-mail</label>
  <span class="star" >*</span>
  <input type="text" name="reg_email" id="reg_email"  />
  </li>

  <li>
  <label>Телефон(мобильный)</label>
  <span class="star" >*</span>
  <input type="text" name="reg_phone" id="reg_phone"  />
  </li>

  <li>
  <label>Ваш адресс</label>
  <span class="star" >*</span>
  <input type="text" name="reg_address" id="reg_address"  />
  </li>

  <li>

  </li>

  </ul>
  </div>

  <p align="right"><input type="submit" name="reg_submit" id="form_submit" value="Зарегистрироваться" /></p>

  </form>

</div>

</div>

</body>

</html>
