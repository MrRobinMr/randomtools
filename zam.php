<?php
session_start();
$cena = 0;
require_once "conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
foreach ($_SESSION["koszyk"] as $value) {
  $sth = $db->prepare('SELECT cena from produkty where id=:id');
  $sth->bindValue(':id', $value, PDO::PARAM_STR);
  $sth->execute();
  $c = $sth->fetch();
  echo $c;
}
echo $cena;
 ?>
