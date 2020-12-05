<?php
include_once('header1.php');
if(isset($_POST['email'])){
require_once "conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
  $email=trim($_POST['email']);
  $haslo=trim($_POST['haslo']);

  $sth = $db->prepare('SELECT * FROM klienci WHERE email=:email');
 $sth->bindValue(':email', $email, PDO::PARAM_STR);
 $sth->execute();
 $user = $sth->fetch();
 if($user)
{
 if(password_verify($haslo, $user['haslo']))
{
  $_SESSION["log"] = "tak";
  $_SESSION["user"] = $user["ID_klienta"];
  $_SESSION["admin"] = $user["pracownik"];
  header("Location: index.php");
 }else{
 echo "<h3>Nieprawidlowe haslo</h3>";
 }
 }else{
 echo "<h3>Nie znaleziono uzytkownika</h3>";
}
}
 ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=opera,chrome=1" />
  <title>Random tools</title>
  <link rel="stylesheet" href="st.css">
</head>
<body>
  <?php

	?>
<div class="srodekpl">
 <div class="item3 lewy">
  <form action="logowanie-graf.php" method="post" name="log">
    E-mail<br /><br /><input type="text" name="email" placeholder="E-mail" /><br /><br /><br />
    Hasło<br /><br /><input type="password" name="haslo" placeholder="Hasło" /><br /><br /><br />
    <input type="submit" value="Zaloguj się" />
  </form>
 </div>
 <div class="item3 prawy">
 <form action="rejestracja-graf.php" method="post">
     <b>Zarejestruj się już dziś!</b><br /><br /><br />
     Otrzymasz dodatkowe liczne korzyści<br /><br />
     - możliwość dokonywania zakupów<br /><br />
     - informacje o najświeższych promocjach<br /><br />
     - możliwość otrzymania rabatów i kuponów promocyjnych<br /><br /><br />
   <input type="submit" value="Zarejestruj się" />
 </form>
 </div>
</div>
 <?php
   include_once('footer.php');
 ?>
</body>
</html>
