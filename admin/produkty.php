<?php
include_once("admin_menu.php");
echo "<link rel=\"stylesheet\" href=\"a_style.css\">";
$sth = $db->prepare('SELECT ID_produkty,nazwa,nazwakat,cena,na_stanie,VAT,nazwapro FROM produkty natural join kategorie natural join producent');
$sth->execute();
echo "<h1>Produkty<h1>";
echo "<table>";
while($user = $sth->fetch(PDO::FETCH_ASSOC)){
  $vat = (double) $user["VAT"]*100;
  echo "<tr><td>".$user["nazwapro"]."</td><td>".$user["nazwa"]."</td><td>"
  .$user["nazwakat"]."</td><td>".$user["cena"]." ZŁ</td><td>".$vat." %</td><td>
  <form action=\"user_edycja.php\" method=\"post\"><input type=\"hidden\" name=\"id\" value=\""
.$user["ID_produkty"]."\">
  <button type=\"submit\" name=\"edytuj\">Edytuj</button>
  </form></td><td>
  <form action=\"pro_usun.php\" method=\"post\"><input type=\"hidden\" name=\"id\" value=\""
.$user["ID_produkty"]."\">
  <button type=\"submit\" name=\"edytuj\">Usuń</button>
  </form></td></tr>";
}
echo "</table>";
?>
