<?php
header("Content-type: text/html; charset=utf-8");
?>
<?php
 include("include/db_connect.php");
  include("functions/functions.php");
 session_start();
  include("include/auth_cookie.php");
  // unset($_SESSION['auth']);
//  setcookie('rememberme','',0,'/');
$id = clear_string($_GET["id"]);
$action = clear_string($_GET["action"]);

switch ($action) {

   case 'clear':
     $clear = mysql_query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
   break;

     case 'delete':
     $delete = mysql_query("DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);
     break;

}


if (isset($_POST["submitdata"]))
{

$_SESSION["order_delivery"] = $_POST["order_delivery"];
$_SESSION["order_fio"] = $_POST["order_fio"];
$_SESSION["order_email"] = $_POST["order_email"];
$_SESSION["order_phone"] = $_POST["order_phone"];
$_SESSION["order_address"] = $_POST["order_address"];
$_SESSION["order_note"] = $_POST["order_note"];
}

?>

<html>

<head>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/main-script.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
  <script type="text/javascript" src="trackbar/jquery.trackbar.js"></script>
  <script type="text/javascript" src="js/TextChange.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title>Корзина</title>
</head>

<body>

<div id="block-body">

  <?php
  include("include/nav-bar.php");
  ?>


<div id="block-content-cart">

<?php
$action = clear_string($_GET["action"]);
 switch ($action) {

case 'oneclick':

echo '
<div id="block-step">
<div id="name-step">
<ul>
<li><a class="active" >1. Корзина</a></li>
<li><span>&harr;</span></li>
<li><a>2. Контактная информация</a></li>
</ul>
</div>
<p>Шаг 1 из 2</p>
<a href="cart.php?action=clear" >Удалить</a>
</div>
';



$result = mysql_query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products",$link);

if(mysql_num_rows($result) > 0){
$row = mysql_fetch_array($result);

echo '
<div id="header-list-cart">
<div id="head1" >Фотография</div>
<div id="head2" >Название продукта</div>
<div id="head3" >Кол-во</div>
<div id="head4" >Цена</div>
</div>
';

do{

$int = $row["cart_price"] * $row["cart_count"];
$all_price = $all_price + $int;

if  (strlen($row["image"]) > 0 && file_exists("./uploads_images/".$row["image"]))
{
$img_path = './uploads_images/'.$row["image"];
$max_width = 100;
$max_height = 100;
 list($width, $height) = getimagesize($img_path);
$ratioh = $max_height/$height;
$ratiow = $max_width/$width;
$ratio = min($ratioh, $ratiow);

$width = intval($ratio*$width);
$height = intval($ratio*$height);
}else
{
$img_path = "img/no_image.gif";
$width = 120;
$height = 105;
}

echo '

<div class="block-list-cart">

<div class="img-cart">
<p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
</div>

<div class="title-cart">
<p id="nazv"><strong>'.$row["title"].'</strong></p>
<p class="cart-mini-features">
'.$row["mini_features"].'
</p>
</div>

<div class="count-cart">
<ul class="count-style">

<li>
<p align="center"><input class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
</li>

</ul>
</div>

<div  class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p>'.group_numerals($int).' тенге</p></div>
<div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete"  ><img src="img/cart_delete.png" width="20" height="20" /></a></div>

<div id="bottom-cart-line"></div>
</div>

';

}
while ($row = mysql_fetch_array($result));

echo '
<h2 class="itog-price" align="right">Итого: <strong>'.$all_price.'</strong> тенге</h2>
<p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далее</a></p>
';

}
else
{
   echo '<h3 id="clear-cart" align="center">Ваша корзина пуста</h3>';
}


break;

case 'confirm':

echo '
<div id="block-step">
<div id="name-step">
<ul>
<li><a href="cart.php?action=oneclick">1. Корзина</a></li>
<li><span>&harr;</span></li>
<li><a class="active">2. Контактная информация</a></li>
</ul>
</div>
<p>Шаг 2 из 2</p>
</div>
';

if ($_SESSION['order_delivery'] == "По почте") $chck1 = "checked";
if ($_SESSION['order_delivery'] == "Курьер") $chck2 = "checked";
if ($_SESSION['order_delivery'] == "Самовывоз") $chck3 = "checked";

 echo '

<h3 class="h3-title" >Выберите способ досатвки ваших товаров:</h3>
<form method="post">
<ul id="info-radio">
<li>
<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="По почте" '.$chck1.'  />
<label class="label_order_delivery" for="order_delivery1">По почте</label>
</li>
<li>
<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Курьер" '.$chck2.' />
<label class="label_order_delivery" for="order_delivery2">Курьер</label>
</li>
<li>
<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery3" value="Самовывоз" '.$chck3.' />
<label class="label_order_delivery" for="order_delivery3">Самовывоз</label>
</li>
</ul>
<h3 class="h3-title" >Введите данные:</h3>
<ul id="info-order">
';
  if ( $_SESSION['log'] != 'yes_auth' )
{
echo '
<li><label for="order_fio"><span>*</span>ФИО</label><input type="text" name="order_fio" id="order_fio" value="'.$_SESSION["order_fio"].'" /></li>
<li><label for="order_email"><span>*</span>E-mail</label><input type="text" name="order_email" id="order_email" value="'.$_SESSION["order_email"].'" /></li>
<li><label for="order_phone"><span>*</span>Телефон</label><input type="text" name="order_phone" id="order_phone" value="'.$_SESSION["order_phone"].'" /></li>
<li><label class="order_label_style" for="order_address"><span>*</span>Адресс</label><input type="text" name="order_address" id="order_address" value="'.$_SESSION["order_address"].'" /></li>
';
}
echo '
<li><label class="order_label_style" for="order_note">Примечание</label><textarea name="order_note"  >'.$_SESSION["order_note"].'</textarea></li>
</ul>
<p align="right" ><input type="submit" name="submitdata" id="confirm-button-next" value="Оплатить" /></p>
</form>


 ';

break;


 default:

 echo '
 <div id="block-step">
 <div id="name-step">
 <ul>
 <li><a class="active" >1. Корзина</a></li>
 <li><span>&harr;</span></li>
 <li><a>2. Контактная информация</a></li>
 </ul>
 </div>
 <p>Шаг 1 из 2</p>
 <a href="cart.php?action=clear" >Удалить</a>
 </div>
 ';



 $result = mysql_query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products",$link);

 if(mysql_num_rows($result) > 0){
 $row = mysql_fetch_array($result);

 echo '
 <div id="header-list-cart">
 <div id="head1" >Фотография</div>
 <div id="head2" >Название продукта</div>
 <div id="head3" >Кол-во</div>
 <div id="head4" >Цена</div>
 </div>
 ';

 do{

 $int = $row["cart_price"] * $row["cart_count"];
 $all_price = $all_price + $int;

 if  (strlen($row["image"]) > 0 && file_exists("./uploads_images/".$row["image"]))
 {
 $img_path = './uploads_images/'.$row["image"];
 $max_width = 100;
 $max_height = 100;
  list($width, $height) = getimagesize($img_path);
 $ratioh = $max_height/$height;
 $ratiow = $max_width/$width;
 $ratio = min($ratioh, $ratiow);

 $width = intval($ratio*$width);
 $height = intval($ratio*$height);
 }else
 {
 $img_path = "img/no_image.gif";
 $width = 120;
 $height = 105;
 }

 echo '

 <div class="block-list-cart">

 <div class="img-cart">
 <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
 </div>

 <div class="title-cart">
 <p id="nazv"><strong>'.$row["title"].'</strong></p>
 <p class="cart-mini-features">
 '.$row["mini_features"].'
 </p>
 </div>

 <div class="count-cart">
 <ul class="count-style">

 <li>
 <p align="center"><input class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
 </li>

 </ul>
 </div>

 <div  class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p>'.group_numerals($int).' тенге</p></div>
 <div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete"  ><img src="img/cart_delete.png" width="20" height="20" /></a></div>

 <div id="bottom-cart-line"></div>
 </div>

 ';

 }
 while ($row = mysql_fetch_array($result));

 echo '
 <h2 class="itog-price" align="right">Итого: <strong>'.$itogpricecart.'</strong> тенге</h2>
 <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далее</a></p>
 ';

 }
 else
 {
    echo '<h3 id="clear-cart" align="center">Ваша корзина пуста</h3>';
 }

 break;
 }

?>

</div>


</div>
</body>
<?php
include("include/footer.php");
?>
</html>
