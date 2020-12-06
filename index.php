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


    <?php
    require_once "conf.php";
	
    try{
        $db=new mysqli($host,$db_user, $db_password,$db_name);
        if($db->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }else
        {
            $sql= $db->query ("SELECT nazwa,cena,nazwakat FROM produkty p RIGHT JOIN kategorie k ON p.ID_kategoria=k.ID_kategoria ORDER BY nazwa");
    $result = $sql->num_rows;
    if($result>0){

        for($b=0;$b<$result;$b++)
        {

            $row=$sql->fetch_assoc();
						echo "<div class='srodek'>";
            echo "<div class='item4 produkty'>";
            echo "<b>".$row["nazwa"]."</b>";
            echo "<br>";
						echo "Kategoria: ".$row["nazwakat"]."";
						echo "<br>";
            echo "Cena: ".$row["cena"]." zł";
            echo "<br>";
            echo "<img src='foto/$row[nazwa].jpg' align='right' style='width:auto;height:150px'>";
            echo "<br><br><br>";
						echo "<button type='button'>Dodaj do koszyka</button>";
            echo "</div>";
            echo "</div>";

					
        }
    }else{
            echo "brak produktów";
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
