<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <meta charset="utf-8" />
	   <meta http-equiv="X-UA-Compatible" content="IE=opera,chrome=1" />
	   <title>Random tools</title>
     <style>
       table, th, td {
         border: 1px solid black;
       }
     </style>
	   <link rel="stylesheet" href="st.css">
	   <link rel="icon" href="logo1-ConvertImage.ico" type="image"/>
  </head>
<body>
<?php

include_once('header1.php');

require_once "conf.php";
if(isset($_SESSION["koszyk"])){
$_SESSION["koszyk"] = array_unique($_SESSION["koszyk"]);
foreach ($_SESSION["koszyk"] as $key => $value) {
  try{
      $db=new mysqli($host,$db_user, $db_password,$db_name);
      if($db->connect_errno!=0)
      {
          throw new Exception(mysqli_connect_errno());
      }else
      {

        $sql=$db->query("SELECT ID_produkty,nazwa,cena,na_stanie FROM produkty where ID_produkty='".$value."'");
          @$result = $sql->num_rows;
  if($result>0){
    //echo "<form method=\"post\" action=\"#\">";

      for($b=0;$b<$result;$b++)
      {
          $row=$sql->fetch_assoc();
          echo "<table align='center' style='width:80%;margin:20px'>";
          echo "<tr>";
          echo "<td style='width:70%'>".$row["nazwa"]."</td>";
          echo "<td style='width:10%'>".$row["cena"]." zł</td>";
          echo "<td style='width:10%'><label for='quantity'>Ilość:</label><input type='number' id='quantity' name='quantity' value='1' min='1' max='".$row["na_stanie"]."'></td>";
          echo "<td style='width:10%'><form method=\"post\" action=\"czy_kosz.php\">
          <input type='hidden' name=\"id_p\" value=\"".$row["ID_produkty"]."\">
          <input type='submit' name='usun' value='Usuń'></form></td>";
          echo "</tr>";
          echo "</table>";
      }
  //  echo "</form>";
  }else{
          echo "Brak produktów";
      }
      $db->close();
      }


  }catch(Exception $e )
  {
      echo "Błąd serwera";
  }
}
echo '<a href="ukoszyk.php"><button type="button" style="height:60px;margin:20px">Usuń zawartość koszyka</button></a>';
}else {
  echo "Brak produktów w koszyku";

}

include_once('footer.php');
?>
</body>
</html>
