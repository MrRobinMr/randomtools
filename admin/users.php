<?php
include_once("admin_menu.php");
echo "<link rel=\"stylesheet\" href=\"a_style.css\">";
$sth = $db->prepare('SELECT * FROM klienci');
$sth->execute();
echo "<h1>Użytkownicy<h1>";
echo "<table>";
while($user = $sth->fetch(PDO::FETCH_ASSOC)){
  echo "<tr><td>".$user["imie"]."</td><td>".$user["nazwisko"]."</td><td>"
  .$user["email"]."</td><td>".$user["pracownik"]."</td></tr>";
}
echo "</table>";
