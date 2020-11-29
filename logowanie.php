<?php
require_once "conf.php";

try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
  $email=trim($_POST['email']);
  $haslo=trim($_POST['haslo']);

  $sth = $db->prepare('SELECT * FROM klienci WHERE email=:email limit 1');
 $sth->bindValue(':email', $email, PDO::PARAM_STR);
 $sth->execute();
 $user = $sth->fetch(PDO::FETCH_ASSOC);
 if($user)
{
 //if(password_verify($password,$user['password']))
 if($haslo = $user['haslo'])
{
 die("<h3>Uzytkownik zalogowany pomyslnie</h3>");
 }else{
 echo "<h3>Nieprawidlowe haslo</h3>";
 }
 }else{
 echo "<h3>Nie znaleziono uzytkownika</h3>";
 }
 ?>
