
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
            $sql= $db->query ("SELECT nazwa,cena,ID_kategoria from produkty");
    $result = $sql->num_rows;
    if($result>0){
        
        for($b=0;$b<$result;$b++)
        {

            $row=$sql->fetch_assoc();
            echo "<div class='produkty'>";
            echo  $row["nazwa"]."";
            echo "<br>";
            echo "cena"." ".$row["cena"]."zł";
    
            echo "<br>";
            echo "kategoria"." ".$row["ID_kategoria"]."";
            echo "<br>";
            echo "<div class='zakup'>";
            echo "<br>";
            

            echo "<button type='button' class='przycisk'>Dodaj do koszyka</button>";
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
