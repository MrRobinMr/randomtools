<?php
require_once "../conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
$sth = $db->prepare('DELETE FROM klienci where ID_klienta=:id');
$sth->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
$sth->execute();
header("Location: users.php");
?>
