<?php
require_once "../conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
$sth = $db->prepare('UPDATE produkty set nazwa=:nazwa,ID_kategoria=:kat,cena=:cena,na_stanie=:stan,VAT=:vat,ID_producent=:pro where ID_produkty=:id');
$sth->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
$sth->bindValue(':nazwa', $_POST["nazwa"], PDO::PARAM_STR);
$sth->bindValue(':kat', $_POST["kat"], PDO::PARAM_STR);
$sth->bindValue(':cena', $_POST["cena"], PDO::PARAM_STR);
$sth->bindValue(':stan', $_POST["stan"], PDO::PARAM_STR);
$sth->bindValue(':vat', $_POST["vat"], PDO::PARAM_STR);
$sth->bindValue(':pro', $_POST["pro"], PDO::PARAM_STR);
$sth->execute();
if(isset($_FILES['zdj'])){
  $sth = $db->prepare('SELECT * from foto where ID_produkty=:id');
  $sth->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
  $sth->execute();
  $count = $sth->rowCount();
  if($count>0){
    unlink($lokalizacja);
    $zap_lok = "foto/".$_POST['id'].".jpg";
    $lokalizacja = "../foto/".$_POST['id'].".jpg";
    if(is_uploaded_file($_FILES['zdj']['tmp_name']))
    {
      if(!move_uploaded_file($_FILES['zdj']['tmp_name'], $lokalizacja))
      {
        echo 'problem: Nie udało się skopiować pliku do katalogu.';
      }
    }
    else
    {
      echo 'problem: Możliwy atak podczas przesyłania pliku.';
  	  echo 'Plik nie został zapisany.';

    }
    $sth = $db->prepare('INSERT INTO foto (ID_produkty, foto, opis) VALUES(:id, :fo, :opis)');
    $sth->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
    $sth->bindValue(':fo', $zap_lok, PDO::PARAM_STR);
    $sth->bindValue(':opis', $nazwa, PDO::PARAM_STR);
    $sth->execute();
    header("Location: produkty.php");
  }else{
    $zap_lok = "foto/".$_POST['id'].".jpg";
    $lokalizacja = "../foto/".$_POST['id'].".jpg";
    if(is_uploaded_file($_FILES['zdj']['tmp_name']))
    {
      if(!move_uploaded_file($_FILES['zdj']['tmp_name'], $lokalizacja))
      {
        echo 'problem: Nie udało się skopiować pliku do katalogu.';
      }
    }
    else
    {
      echo 'problem: Możliwy atak podczas przesyłania pliku.';
  	  echo 'Plik nie został zapisany.';

    }
    $sth = $db->prepare('INSERT INTO foto (ID_produkty, foto, opis) VALUES(:id, :fo, :opis)');
    $sth->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
    $sth->bindValue(':fo', $zap_lok, PDO::PARAM_STR);
    $sth->bindValue(':opis', $nazwa, PDO::PARAM_STR);
    $sth->execute();
    header("Location: produkty.php");
  }
}
header("Location: produkty.php");
?>
