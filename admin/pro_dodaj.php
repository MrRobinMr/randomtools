<?php
session_start();
require_once "../conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
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
<form method="post" action="pro_dodaj.php" name="dod">
  Nazwa: <input type="text" name="nazwa"><br>
  Kategoria: <select name="kat">
<?php
$sth = $db->prepare('SELECT * FROM kategorie');
$sth->execute();
while($user = $sth->fetch(PDO::FETCH_ASSOC)){
  echo "<option>".$user["nazwakat"]."</option>";
}
?>
  </select><br>
  Producent: <select name="pro">
    <?php
    $sth = $db->prepare('SELECT * FROM producent');
    $sth->execute();
    while($user = $sth->fetch(PDO::FETCH_ASSOC)){
      echo "<option>".$user["nazwapro"]."</option>";
    }
    ?>
  </select><br>
  Cena: <input type="text" name="cena"><br>
  Na stanie: <input type="text" name="stan"><br>
  VAT: <input type="text" name="vat"><br>
  <button type="submit">Zapisz</button>
</form>
<a href="produkty.php"><button>Anuluj</button></a>
</div>
</body>
</html>
