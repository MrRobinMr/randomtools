<?php
session_start();
$id = $_POST["id"];
$imie = $_POST["imie"];
$nazwisko = $_POST["nazwisko"];
$email = $_POST["email"];
require_once "conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
$sth = $db->prepare('UPDATE klienci set imie=:imie, nazwisko=:nazwisko, email=:email WHERE ID_klienta=:id');
$sth->bindValue(':id',$id,PDO::PARAM_STR);
$sth->bindValue(':imie',$imie,PDO::PARAM_STR);
$sth->bindValue(':nazwisko',$nazwisko,PDO::PARAM_STR);
$sth->bindValue(':email',$email,PDO::PARAM_STR);
$sth->execute();
  $_SESSION["name"] = $imie;
  header("Location: mojekonto.php");
?>
