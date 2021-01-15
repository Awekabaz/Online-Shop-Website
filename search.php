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

$search = clear_string($_GET["q"]);

 $sorting = $_GET["sort"];

 switch ($sorting)
 {
     case 'price-asc';

     $sorting = 'price ASC';
     $sort_name = 'От дешевых к дорогим';
     break;

     case 'price-desc';
     $sorting = 'price DESC';
     $sort_name = 'От дорогих к дешевым';
     break;

     case 'brand';
     $sorting = 'brand';
     $sort_name = 'По алфавиту';
     break;

     default:
     $sorting = 'products_id DESC';
     $sort_name = 'Нет сортировки';
     break;
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
  <script type="text/javascript" src="js/TextChange.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title>Поиск - <?php echo $search; ?></title>
</head>

<body>

<div id="block-body">

  <?php
include('include/nav-bar.php');
  ?>


<div id="block-cat">

  <?php
  include("include/block-category.php");
  ?>


</div>
<div id="block-content">

<?php
  if (strlen($search) >= 3 && strlen($search) < 64)
  {

  $num = 6; // сколько товарв на странице
    $page = (int)$_GET['page'];

  $count = mysql_query("SELECT COUNT(*) FROM table_products WHERE title LIKE '%$search%' AND visible = '1'",$link);
    $temp = mysql_fetch_array($count);

  If ($temp[0] > 0)
  {
  $tempcount = $temp[0];
  // общее число страниц
  $total = (($tempcount - 1) / $num) + 1;
  $total =  intval($total);

  $page = intval($page);

  if(empty($page) or $page < 0) $page = 1;

  if($page > $total) $page = $total;

  $start = $page * $num - $num;

  $qury_start_num = " LIMIT $start, $num";
  }

  If ($temp[0] > 0)
  {

    echo '
    <div id="block-sorting">
      <p id="nav-breadcrumbs"><a href="assembler.php"  style="color:#cc0000;">Главная страница</a></p>
      <ul id="list">
        <li>Вид:</li>
        <li><i id="style-setka" class="fas fa-th fa-lg" style="cursor:pointer;"></i></li>
        <li><i id="style-list" class="fas fa-list fa-lg" style="cursor:pointer;"></i></li>
          <li>Сортировать:</li>
          <li><a class="select-sort js-select-sort" id="select-sort">'.$sort_name.'<a>
    <ul class="sorting-list js-sorting-list">
    <li><a href="assembler.php?sort=price-asc">От дешевых к дорогим</a></li>
    <li><a href="assembler.php?sort=price-desc">От дорогих к дешевым</a></li>
    <li><a href="assembler.php?sort=brand">По алфавиту</a></li>
    </ul>
    </li>
    </ul>
    </div>
      <ul id="block-setka">
    ';

  $result=mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1' ORDER BY $sorting $qury_start_num",$link);

  if(mysql_num_rows($result) > 0){
  $row = mysql_fetch_array($result);

  do{

    if($row["image"] != "" && file_exists("./uploads_images/".$row["image"])){
      $img_path='./uploads_images/'.$row["image"];
      $max_width=200;
      $max_height=200;
      list($width,$height)= getimagesize($img_path);
      $ratioh=$max_height/$height;
      $ratiow=$max_width/$width;
      $ratio=min($ratioh,$ratiow);
      $width=intval($ratio*$width);
      $height=intval($ratio*$height);
    }
    else{
      $img_path="img/no_image.png";
      $width=200;
      $height=200;
    }


  echo '
  <li>
  <div class="image-setka"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/> </div>
  <p class="title-setka">'.$row["title"].'</p>
  <a class="add-cart-setka" tid="'.$row["products_id"].'"><img src="img/cart.png" width="30" height="30"></a>
  <p class="price-setka"><strong>'.group_numerals($row["price"]).'</strong> тг.</p>
  <div class="mini-features">'.$row["mini_features"].'
  </div>
  </li>

  ';

  }
       while ($row=mysql_fetch_array($result));
  }
  ?>
  </ul>

  <ul id="block-list">
  <?php
  $result=mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1' ORDER BY $sorting $qury_start_num",$link);

  if(mysql_num_rows($result) > 0){
  $row = mysql_fetch_array($result);

  do{

    if($row["image"] != "" && file_exists("./uploads_images/".$row["image"])){
      $img_path='./uploads_images/'.$row["image"];
      $max_width=150;
      $max_height=150;
      list($width,$height)= getimagesize($img_path);
      $ratioh=$max_height/$height;
      $ratiow=$max_width/$width;
      $ratio=min($ratioh,$ratiow);
      $width=intval($ratio*$width);
      $height=intval($ratio*$height);
    }
    else{
      $img_path="img/no_image.png";
      $width=80;
      $height=70;
    }


  echo '
  <li>
  <div class="image-list"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/> </div>
  <p class="title-list">'.$row["title"].'</p>
  <a class="add-cart-list" tid="'.$row["products_id"].'"><img src="img/cart.png" width="30" height="30"></a>
  <p class="price-list"><strong>'.group_numerals($row["price"]).'</strong> тг.</p>
  <div class="description-list">'.$row["description"].'
  </div>
  </li>

  ';

  }
       while ($row=mysql_fetch_array($result));
  }

echo '</ul>';
  if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="search.php?q='.$search.'&?page='.($page - 1).'">&lt;</a></li>';}
  if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="search.php?q='.$search.'&?page='.($page + 1).'">&gt;</a></li>';


  // формирование ссылок со страницами
  if($page - 5 > 0) $page5left = '<li><a href="search.php?q='.$search.'&page='.($page - 5).'">'.($page - 5).'</a></li>';
  if($page - 4 > 0) $page4left = '<li><a href="search.php?q='.$search.'&page='.($page - 4).'">'.($page - 4).'</a></li>';
  if($page - 3 > 0) $page3left = '<li><a href="search.php?q='.$search.'&page='.($page - 3).'">'.($page - 3).'</a></li>';
  if($page - 2 > 0) $page2left = '<li><a href="search.php?q='.$search.'&page='.($page - 2).'">'.($page - 2).'</a></li>';
  if($page - 1 > 0) $page1left = '<li><a href="search.php?q='.$search.'&page='.($page - 1).'">'.($page - 1).'</a></li>';

  if($page + 5 <= $total) $page5right = '<li><a href="search.php?q='.$search.'&page='.($page + 5).'">'.($page + 5).'</a></li>';
  if($page + 4 <= $total) $page4right = '<li><a href="search.php?q='.$search.'&page='.($page + 4).'">'.($page + 4).'</a></li>';
  if($page + 3 <= $total) $page3right = '<li><a href="search.php?q='.$search.'&page='.($page + 3).'">'.($page + 3).'</a></li>';
  if($page + 2 <= $total) $page2right = '<li><a href="search.php?q='.$search.'&page='.($page + 2).'">'.($page + 2).'</a></li>';
  if($page + 1 <= $total) $page1right = '<li><a href="search.php?q='.$search.'&page='.($page + 1).'">'.($page + 1).'</a></li>';


  if ($page+5 < $total)
  {
      $strtotal = '<li><p class="nav-point">...</p></li><li><a href="search.php?q='.$search.'&page='.$total.'">'.$total.'</a></li>';
  }else
  {
      $strtotal = "";
  }

  if ($total > 1)
  {
      echo '
      <div class="pstrnav">
      <ul>
      ';
      echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li class='pstr-active-li'><a class='pstr-active-a' href='search.php?q=".$search."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
      echo '
      </ul>
      </div>
      ';
  }

}
else{
  echo '<p>Извините, но ничего не найдено</p>';
}

}else{
  echo '<p>Поисковое значение должно состоять от 3 до 64 символов</p>';
}
  ?>


  </div>


</div>
</body>
<?php
include("include/footer.php");
?>
</html>
