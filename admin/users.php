<?php
include_once("admin_menu.php");
echo "<link rel=\"stylesheet\" href=\"a_style.css\">";
$sth = $db->prepare('SELECT * FROM klienci');
$sth->execute();
echo "<h1>Użytkownicy<h1>";
echo "<table>";
while($user = $sth->fetch(PDO::FETCH_ASSOC)){
  echo "<tr><td>".$user["imie"]."</td><td>".$user["nazwisko"]."</td><td>"
  .$user["email"]."</td><td>";
  if($user["pracownik"]==1){
    echo "<form action=\"adm_u.php\" method=\"post\" ><button name=\"id\" type=\"submit\"value=\""
  .$user["ID_klienta"]."\">Usuń uprawnienia</buttom></form>";
  }else{
    echo "<form action=\"adm_n.php\" method=\"post\" ><button name=\"id\" type=\"submit\"value=\""
  .$user["ID_klienta"]."\">Nadaj uprawnienia</buttom></form>";
  }
  echo "</td><td>
  <form action=\"user_edycja.php\" method=\"post\"><input type=\"hidden\" name=\"id\" value=\""
.$user["ID_klienta"]."\">
  <button type=\"submit\" name=\"edytuj\">Edytuj</button>
  </form></td><td>
  <form action=\"user_usun.php\" method=\"post\"><input type=\"hidden\" name=\"id\" value=\""
.$user["ID_klienta"]."\">
  <button type=\"submit\" name=\"edytuj\">Usuń</button>
  </form></td></tr>";
}
echo "</table>";
?>
