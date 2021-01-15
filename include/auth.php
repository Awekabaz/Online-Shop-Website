<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	include('db_connect.php');
    include('../functions/functions.php');

    $login = clear_string($_POST["login"]);

    $pass   = md5(clear_string($_POST["password"]));
    $pass   = strrev($pass);
    $pass   = strtolower("1w3r5y7u".$pass."0m9b8v");



    if ($_POST["rememberme"] == "yes")
    {

            setcookie('rememberme',$login.'+'.$pass,time()+3600*24*31, "/");

    }


   $result = mysql_query("SELECT * FROM user WHERE (login = '$login' OR email = '$login') AND password = '$pass'",$link);
If (mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    session_start();
    $_SESSION['log'] = 'yes_auth';
    $_SESSION['log_pass'] = $row["password"];
    $_SESSION['log_login'] = $row["login"];
    $_SESSION['log_surname'] = $row["surname"];
    $_SESSION['log_name'] = $row["name"];
    $_SESSION['log_otec'] = $row["otec"];
    $_SESSION['log_address'] = $row["address"];
    $_SESSION['log_phone'] = $row["phone"];
    $_SESSION['log_email'] = $row["email"];
    echo 'yes_auth';

}else
{
    echo 'no_auth';
}
}

?>
