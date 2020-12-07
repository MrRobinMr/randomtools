<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=opera,chrome=1" />
	<title>Random tools</title>
	<link rel="stylesheet" href="st.css">
	<link rel="icon" href="logo1-ConvertImage.ico" type="image"/>
</head>
<body>
	<?php
		include_once('header1.php');
	?>

	<div class="kategoria">
		<div class="item5 srodek-obiekt">
		<form action="index.php" method="post">
			<select name="lista">
				<option value="%">Wszystkie produkty</option>
				<option value="wiertarki">wiertarki</option>
				<option value="pilarki">pilarki</option>
				<option value="szlifierki">szlifierki</option>
				<option value="wiertła">wiertła</option>
				<option value="agregaty">agregaty</option>
				<option value="tarcze do cięcia drewna z gwoździami">tarcze do cięcia drewna z gwoździami</option>
				<option value="wkrętarki">wkrętarki</option>
			</select>
			<input type="submit" name="filtr" value="Filtruj">
		</form>
	</div>
</div>

    <?php
    require_once "conf.php";
		if(isset($_POST["ko"])){
			if(isset($_SESSION["koszyk"])){
			array_push($_SESSION["koszyk"], $_POST["ko"]);
			unset($_POST["ko"]);
		}else {
				$_SESSION["koszyk"]=[];
				array_push($_SESSION["koszyk"], $_POST["ko"]);
				unset($_POST["ko"]);
		}
		}
    try{
        $db=new mysqli($host,$db_user, $db_password,$db_name);
        if($db->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }else
        {
					if(isset($_POST['szukanie'])) {
						$szukaj=$_POST['szukaj'];
						$sql= $db->query ("SELECT ID_produkty,nazwa,cena,nazwakat,nazwapro,na_stanie FROM produkty NATURAL JOIN kategorie NATURAL JOIN producent where nazwa like '%".$szukaj."%' ORDER BY nazwa");
					}else if(isset($_POST['filtr'])) {
						$opcja=$_POST['lista'];
						$sql= $db->query ("SELECT ID_produkty,nazwa,cena,nazwakat,nazwapro,na_stanie FROM produkty NATURAL JOIN kategorie NATURAL JOIN producent where nazwakat like '".$opcja."' ORDER BY nazwa");
					}else {
						$sql= $db->query ("SELECT ID_produkty,nazwa,cena,nazwakat,nazwapro,na_stanie FROM produkty NATURAL JOIN kategorie NATURAL JOIN producent ORDER BY nazwa");
					}

    				@$result = $sql->num_rows;
    if($result>0){

        for($b=0;$b<$result;$b++)
        {
            $row=$sql->fetch_assoc();
						echo "<div class='srodek'>";
            echo "<div class='item4 produkty'>";
            echo "<b>".$row["nazwa"]."</b>";
            echo "<br>";
						echo "Producent: ".$row["nazwapro"]."";
						echo "<br>";
						echo "Kategoria: ".$row["nazwakat"]."";
						echo "<br>";
            echo "Cena: ".$row["cena"]." zł";
            echo "<br>";
						echo "W magazynie ".$row["na_stanie"]." sztuk";
						echo "<br>";
            echo "<img src='foto/$row[nazwa].jpg' align='right' style='width:auto;height:130px'>";
            echo "<br><br><br>";
						echo "<form method=\"post\" action=\"index.php\"><button name=\"ko\" type='submit' value=\"".$row["ID_produkty"]."\" >Dodaj do koszyka</button></form>";
            echo "</div>";
            echo "</div>";
        }

    }else{
						echo "<div class='srodek'>";
						echo "<div class='item4 produkty'>";
            echo "Brak produktów";
						echo "</div>";
						echo "</div>";
        }

        $db->close();
        }


    }catch(Exception $e )
    {
        echo "bład";
    }

    ?>


	<?php
		include_once('footer.php');
	?>

</body>
</html>
