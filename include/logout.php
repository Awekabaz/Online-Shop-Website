<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
      session_start();
      unset($_SESSION['log']);
      setcookie('rememberme','',0,'/');
      echo 'logout';
}

?>
