<?php
session_start();
if(isset($_SESSION["log"])){
    include_once('header_zalogowano.php');
}else{
  include_once('header_nie.php');
}
?>
