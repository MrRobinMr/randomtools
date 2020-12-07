<?php
include_once("admin_menu.php");
$id = $_POST["id"];
$sth = $db->prepare('UPDATE klienci set pracownik=1 WHERE ID_klienta=:id');
$sth->bindValue(':id', $id, PDO::PARAM_STR);
$sth->execute();
header("Location: users.php");
 ?>
