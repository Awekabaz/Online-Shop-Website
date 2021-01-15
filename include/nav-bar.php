
<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <span class="navbar-text" style="font:25px sans-serif; color:#cc0000;">
  <strong>Ares Computing</strong>
</span>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="assembler.php">Главная страница</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">О нас</a>
      </li>
              <?php
              if ($_SESSION['log'] == 'yes_auth')
              {

               echo '
              <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Вы вошли как, <strong style="color:#cc0000;">'.$_SESSION['log_name'].'</strong>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="user_profile.php"><img src="img/user_profile.png" width="15" height="15"/>Профиль</a>
          <a class="dropdown-item" id="logout" style="  cursor: pointer;" ><img src="img/logout.png" width="15" height="15"/>Выйти</a>
        </div>
      </li> ';
    }
      else{
        echo '
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Войти
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item vhod" href="#">Вход</a>
            <a class="dropdown-item" href="registration.php">Зарегистрироваться</a>
        </li>';
      }
?>
<div class="overlay1 js-overlay-campaign1" style="position: fixed;
width: 100%;
height: 100%;
top: 0;
left: 0;
background-color: rgba(0, 0, 0, .8);
display: none;">
<div id="block-vhod" >


<form method="post">


<ul id="email-pass">

<h3>Вход</h3>

<p id="message-auth">Неправильный логин или пароль</p>

<li><center><input type="text" id="auth_login" placeholder="Введите ваш E-mail" /></center></li>
<li><center><input type="password" id="auth_pass" placeholder="Введите пароль" /><span id="password-show" class="pass-show"></span></center></li>

<ul id="list-auth">
<li><input type="checkbox" name="rememberme" id="rememberme" /><label for="rememberme">Запомнить меня</label></li>
</ul>



<p align="right" id="button-auth" ><a>Вход</a></p>
<p align="right" class="loading"><img src="img/loading.gif" /></p>

</ul>
</form>


</div>
</div>

    </ul>
    <form class="form-inline my-2 my-lg-0"  method="GET" action="search.php?q=">
      <input class="form-control mr-sm-2" type="search" placeholder="Поиск товара" aria-label="Search"  id="input-search" name="q" value="<?php echo $search; ?>">
      <button class="btn btn-danger"  type="submit">Поиск</button>
    </form>
  </div>
</nav>
<div id="top-menu">
<p align="right" id="block-basket"><img src="img/basket.png" width="20" height="20"><a href="cart.php?action=oneclick">Корзина пуста</a></p>
</div>
