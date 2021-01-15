<div id="block-category">
<p class="header-title">Категории товаров</p>

<ul>

<li><a id="index1"><img src="img/cpu.png" id="cpu-image" width="22" height="22"><strong>Процессоры</strong></a>
<ul class="category-section">
<li><a href="page_category.php?type=CPU"><strong style="color:#cc0000">Все модели</strong></a></li>

<?php
$result = mysql_query("SELECT * FROM category WHERE type='CPU'",$link);

If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
echo '

<li><a href="page_category.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>

  ';
}
while ($row = mysql_fetch_array($result));
}

?>

</ul>
</li>

<li><a id="index2"><img src="img/ram.png" id="ram-image" width="22" height="22"><strong>ОЗУ</strong></a>
<ul class="category-section">
    <li><a href="page_category.php?type=RAM"><strong style="color:#cc0000">Все модели</strong></a></li>
  <?php
  $result = mysql_query("SELECT * FROM category WHERE type='RAM'",$link);

  If (mysql_num_rows($result) > 0)
  {
  $row = mysql_fetch_array($result);
  do
  {
  echo '

  <li><a href="page_category.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>

    ';
  }
  while ($row = mysql_fetch_array($result));
  }

  ?>

</ul>
</li>

<li><a id="index3"><img src="img/mother.png" id="mother-image" width="22" height="22"><strong>Материнская плата</strong></a>
<ul class="category-section">
  <li><a href="page_category.php?type=mother"><strong style="color:#cc0000">Все модели</strong></a></li>
  <?php
  $result = mysql_query("SELECT * FROM category WHERE type='mother'",$link);

  If (mysql_num_rows($result) > 0)
  {
  $row = mysql_fetch_array($result);
  do
  {
  echo '

  <li><a href="page_category.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>

    ';
  }
  while ($row = mysql_fetch_array($result));
  }

  ?>

</ul>
</li>

<li><a id="index4"><img src="img/blok.png" id="bp-image" width="22" height="22"><strong>Блок питания</strong></a>
<ul class="category-section">
  <li><a href="page_category.php?type=power"><strong style="color:#cc0000">Все модели</strong></a></li>
  <?php
  $result = mysql_query("SELECT * FROM category WHERE type='power'",$link);

  If (mysql_num_rows($result) > 0)
  {
  $row = mysql_fetch_array($result);
  do
  {
  echo '

  <li><a href="page_category.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>

    ';
  }
  while ($row = mysql_fetch_array($result));
  }

  ?>

</ul>
</li>

<li><a id="index5"><img src="img/gpu.png" id="gpu-image" width="22" height="22"><strong>Видеокарты</strong></a>
<ul class="category-section">
  <li><a href="page_category.php?type=GPU"><strong style="color:#cc0000">Все модели</strong></a></li>
  <?php
  $result = mysql_query("SELECT * FROM category WHERE type='GPU'",$link);

  If (mysql_num_rows($result) > 0)
  {
  $row = mysql_fetch_array($result);
  do
  {
  echo '

  <li><a href="page_category.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>

    ';
  }
  while ($row = mysql_fetch_array($result));
  }

  ?>

</ul>
</li>
</ul>
</div>
