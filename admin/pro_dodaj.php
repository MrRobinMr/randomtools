<?php
session_start();
require_once "../conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
if(isset($_POST["sub"])){
  $nazwa = $_POST["nazwa"];
  $kat = $_POST["kat"];
  $pro = $_POST["pro"];
  $cena = $_POST["cena"];
  $stan = $_POST["stan"];
  $vat = $_POST["vat"];
  $sth = $db->prepare('INSERT INTO produkty (nazwa, ID_kategoria, cena, na_stanie, VAT, ID_producent)
  VALUES (:nazwa, :idk, :cena, :nas, :vat, :idp)');
  $sth->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
  $sth->bindValue(':idk', $kat, PDO::PARAM_STR);
  $sth->bindValue(':cena', $cena, PDO::PARAM_STR);
  $sth->bindValue(':nas', $stan, PDO::PARAM_STR);
  $sth->bindValue(':vat', $vat, PDO::PARAM_STR);
  $sth->bindValue(':idp', $pro, PDO::PARAM_STR);
  $sth->execute();
  $sth = $db->prepare('SELECT ID_produkty from produkty where nazwa=:nazwa');
  $sth->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
  $sth->execute();
  $naz = $sth->fetch();
  $namee = $naz["ID_produkty"];
  $foto = "../foto/".basename($_FILES["zdj"]["name"]).".jpg";
  if (move_uploaded_file($_FILES["zdj"]["name"], $foto)) {
      $sth = $db->prepare('INSERT INTO foto (ID_produkty, foto) VALUES(:id, :fo)');
      $sth->bindValue(':id', $naz["ID_produkty"], PDO::PARAM_STR);
      $sth->bindValue(':fo', $foto, PDO::PARAM_STR);
      $sth->execute();
      header("Location: produkty.php");
   } else {
     echo "Sorry, there was an error uploading your file.";
   }
}
?>
<html>
<head lang="pl">
  <title>Dodawanie produktu</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../st.css">
</head>
<body>
  <div>
<form method="post" action="pro_dodaj.php" name="dod" enctype="multipart/form-data">
  Nazwa: <input type="text" name="nazwa"><br>
  Kategoria: <select name="kat">
<?php
$sth = $db->prepare('SELECT * FROM kategorie');
$sth->execute();
while($user = $sth->fetch(PDO::FETCH_ASSOC)){
  echo "<option value=\"".$user["ID_kategoria"]."\">".$user["nazwakat"]."</option>";
}
?>
  </select><br>
  Producent: <select name="pro">
    <?php
    $sth = $db->prepare('SELECT * FROM producent');
    $sth->execute();
    while($user = $sth->fetch(PDO::FETCH_ASSOC)){
      echo "<option value=\"".$user["ID_producent"]."\">".$user["nazwapro"]."</option>";
    }
    ?>
  </select><br>
  Cena: <input type="text" name="cena"><br>
  Na stanie: <input type="text" name="stan"><br>
  VAT: <input type="text" name="vat"><br>
  Dodaj zdjęcie: <input type="file" name="zdj" id="zdj" accept="image/jpg">
  <button type="submit" name="sub">Zapisz</button>
</form>
<a href="produkty.php"><button>Anuluj</button></a>
</div>
</body>
</html>
