<?php
require_once "../conf.php";
include_once("admin_menu.php");
echo "<link rel=\"stylesheet\" href=\"a_style.css\">";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
$sth = $db->prepare('SELECT * FROM produkty where ID_produkty=:id');
$sth->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
$sth->execute();
$pro = $sth->fetch();
?>
<br>
<div>
  <form method="post" action="pro_dod.php" enctype="multipart/form-data">
  <table>
    <tr>
      <td>
        nazwa: <?php echo "<input type=\"text\" name=\"nazwa\" placeholder=\"".$pro["nazwa"]."\" value=\"".$pro["nazwa"]."\" >";?>
      </td>
    </tr>
    <tr>
      <td>
        cena: <?php echo "<input type=\"text\" name=\"cena\" placeholder=\"".$pro["cena"]."\"value=\"".$pro["cena"]."\">";?>
      </td>
    </tr>
    <tr>
      <td>
        na stanie: <?php echo "<input type=\"text\" name=\"stan\" placeholder=\"".$pro["na_stanie"]."\"value=\"".$pro["na_stanie"]."\">";?>
      </td>
    </tr>
    <tr>
      <td>
        VAT: <?php echo "<input type=\"text\" name=\"vat\" placeholder=\"".$pro["VAT"]."\"value=\"".$pro["VAT"]."\">";?>
      </td>
    </tr>
    <tr>
      <td>
        producent:
         <?php
         echo "<select name=\"pro\">";
         $sth = $db->prepare('SELECT * FROM producent');
         $sth->execute();
         while($producent = $sth->fetch(PDO::FETCH_ASSOC)){
           echo "<option value=\"".$producent["ID_producent"]."\"";
          if($producent["ID_producent"]==$pro["ID_producent"]){
            echo "selected";
          }
           echo ">".$producent["nazwapro"]."</option>";
         }
         echo "</select>";
         ?>
      </td>
    </tr>
    <tr>
      <td>
        kategoria:
         <?php
         echo "<select name=\"kat\">";
         $sth = $db->prepare('SELECT * FROM kategorie');
         $sth->execute();
         while($kat = $sth->fetch(PDO::FETCH_ASSOC)){
           echo "<option value=\"".$kat["ID_kategoria"]."\"";
          if($kat["ID_kategoria"]==$pro["ID_kategoria"]){
            echo "selected";
          }
           echo ">".$kat["nazwakat"]."</option>";
         }
         echo "</select>";
         ?>
      </td>
    </tr>
    <tr>
  <td>
    Edytuj zdjęcie: <input type="file" name="zdj" accept="image/jpg">
</td>
</tr>
  </table>
  <button type="submit" name="id" value="<?php echo $_POST['id'];?>">Zapisz</button>
</form>
</div>
<br>
