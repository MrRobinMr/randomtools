<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=opera,chrome=1" />
	<title>Moje konto</title>
	<link rel="stylesheet" href="st.css">
	<link rel="icon" href="logo1-ConvertImage.ico" type="image"/>
</head>
<body>
	<?php
		include_once('header1.php');
		require_once "conf.php";
		try{
		 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
		}
		catch (PDOException $e){
		 die ("Error connecting to database!");
		}
		$sth = $db->prepare('SELECT ID_klienta,imie,nazwisko,email FROM klienci where ID_klienta=:id');
		$sth->bindValue(':id',$_SESSION["user"],PDO::PARAM_STR);
		$sth->execute();
		$user = $sth->fetch();
		?>
		<br>
		<div class="srodek">
			<div class="item3 srodek-obiekt">
			<form method="post" action="konto_edycja.php">
				<table>
				<tr>
					<td>
						Imie <br />
						<?php echo "<input type=\"text\" name=\"imie\" placeholder=\"".$user["imie"]."\" value=\"".$user["imie"]."\" style=width:100%>";?>
						<br /><br />
					</td>
				</tr>
				<tr>
					<td>
						Nazwisko <br />
						<?php echo "<input type=\"text\" name=\"nazwisko\" placeholder=\"".$user["nazwisko"]."\"value=\"".$user["nazwisko"]."\" style=width:100%>";?>
						<br /><br />
					</td>
				</tr>
				<tr>
					<td>
						E-mail <br />
						<?php echo "<input type=\"text\" name=\"email\" placeholder=\"".$user["email"]."\"value=\"".$user["email"]."\" style=width:100%>";?>
						<br /><br />
					</td>
				</tr>
			</table>
			<button type="submit" name="id" value="<?php echo $user["ID_klienta"];?>">Zapisz</button>
		</form>
	</div>
		</div>
		<br>
<?php
		include_once('footer.php');
	?>

</body>
</html>
