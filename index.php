
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <style>
    td {
        border: solid #000 1px;
        padding: 5px;
    }
    </style>
	<meta http-equiv="X-UA-Compatible" content="IE=opera,chrome=1" />
	<title>Random tools</title>
	<link rel="stylesheet" href="st.css">
</head>
<body>
 




	<div class="baner">
        <h1>Sklep</h1>
        </div>
      
      <div class="menuu" >  
      <nav>   
   <a class="menu " href="#">Kontakt</a>
   <a class="menu " href="#">Regulamin</a>
   <a class="menu " href="#">Rejestracja</a>
   </nav>
	</div>
	<div class="srodek">
   
    <?php
    require_once "conf.php";
    try{
        $db=new mysqli($host,$db_user, $db_password,$db_name);
        if($db->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }else
        {
            $sql= $db->query ("SELECT nazwa,cena,ID_kategoria from produkty");
    $result = $sql->num_rows;
    if($result>0){
        echo "<table>";
        for($b=0;$b<$result;$b++)
        {

            $row=$sql->fetch_assoc();
            echo "<tr>";
            echo "<td>";
            echo  $row["nazwa"]."";
            echo "cena"." ".$row["cena"]."zł";
            echo "<br>";
            echo "kategoria"." ".$row["ID_kategoria"]."";
            echo "</td>";
            echo "</tr>";
            
        } 
    }else{
            echo "0 produktów";
        }
        echo "</table>";
        $db->close();
        }
     

    }catch(Exception $e )
    {
        echo "o kurwa";
    }
  
    ?>
	
	</div>
	<footer>
		Opracowali:
    Jakub Nowak, Grzegorz Skiermunt, Maciej Grzegorczyk
  </footer>
</body>
</html>
