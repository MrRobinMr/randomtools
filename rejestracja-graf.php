<?php
require_once "conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
if(isset($_POST['rejstracja']))
{
 $email = $_POST['email'];
 $password = $_POST['haslo1'];
 $chpass = $_POST['haslo2'];
 $imie = $_POST['imie'];
 $nazwisko = $_POST['nazwisko'];
 if($password==$chpass){
 $hashPassword = password_hash($password,PASSWORD_BCRYPT);
 $sth = $db->prepare('INSERT INTO klienci (imie,nazwisko,haslo,email) VALUE
(:imie,:nazwisko,:password,:email)');
$sth->bindValue(':imie', $imie, PDO::PARAM_STR);
$sth->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
 $sth->bindValue(':email', $email, PDO::PARAM_STR);
 $sth->bindValue(':password', $hashPassword, PDO::PARAM_STR);
 $sth->execute();
 unset($_POST);
}else{
	echo "Podaj poprawne dane";
}
}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=opera,chrome=1" />
	<title>Random tools</title>
	<link rel="stylesheet" href="st.css">
</head>
<body>
	<div class="baner">
		<h1>Rejestracja</h1>
	</div>
	<div class="srodek">
	<form name="rejstracja" method="post" action="rejestracja-graf.php">
		Imie <br /><br /> <input type="text" name="imie" placeholder="Imie" /><br /><br /><br />
		Nazwisko <br /><br /> <input type="text" name="nazwisko" placeholder="Nazwisko" /><br /><br /><br />
		E-mail <br /><br /> <input type="text" name="email" placeholder="E-mail" /><br /><br /><br />
		Twoje hasło <br /><br /> <input type="password" name="haslo1" placeholder="Hasło" /><br /><br /><br />
		Powtórz hasło <br /><br /> <input type="password" name="haslo2" placeholder="Powtórz Hasło" /><br />
		<br /><br />
		<label>
			<input type="checkbox" name="regulamin" />     Akceptuję regulamin
		</label>
		<br /><br /><br />
		<input type="submit" value="Zarejestruj się" />
	</form>
	</div>
	<footer>
		Opracowali:
    Jakub Nowak, Grzegorz Skiermunt, Maciej Grzegorczyk
  </footer>
</body>
</html>
