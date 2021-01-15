<?php
$db_host='localhost';
$db_user='admin';
$db_pass='123456789';
$db_database='db_assembler';

$link=mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_database,$link) or die("Не подключено к Базе Данных".mysql_error());
mysql_query("SER names cp1251");
?>
