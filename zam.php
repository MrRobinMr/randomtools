<?php
session_start();
foreach ($_SESSION["koszyk"] as $key => $value) {
  echo $_POST[$value];
}

 ?>
