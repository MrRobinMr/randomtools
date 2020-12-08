<?php
session_start();
$us = $_GET["id_p"];
echo $us;
if(count($_SESSION["koszyk"])<=1){
  unset($_SESSION["koszyk"]);
}
foreach ($_SESSION["koszyk"] as $key => $value) {
  if($value==$us){
    unset($_SESSION["koszyk"][$key]);
  }
}
header("Location: koszyk.php");
?>
