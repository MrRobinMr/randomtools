<?php

include_once('header1.php');

foreach ($_SESSION["koszyk"] as $key => $value) {
  echo $value."<br>";
}

include_once('footer.php');
?>
