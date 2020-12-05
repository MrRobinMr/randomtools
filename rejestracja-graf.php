<?php
require_once "conf.php";
try{
 $db = new PDO("mysql:host=".$host.";dbname=".$db_name, $db_user, $db_password);
}
catch (PDOException $e){
 die ("Error connecting to database!");
}
if(isset($_POST['imie']))
{
 $email = trim($_POST['email']);
 $password = trim($_POST['haslo1']);
 $chpass = trim($_POST['haslo2']);
 $imie = trim($_POST['imie']);
 $nazwisko = trim($_POST['nazwisko']);
 if($password==$chpass){
 $hashPassword = password_hash($password, PASSWORD_BCRYPT);
 $sth = $db->prepare('SELECT * FROM klienci WHERE email=:email');
$sth->bindValue(':email', $email, PDO::PARAM_STR);
$sth->execute();
$user = $sth->fetch(PDO::FETCH_ASSOC);
$count = $sth->rowCount();
if ($count<1) {
 $sth = $db->prepare('INSERT INTO klienci (imie,nazwisko,haslo,email,pracownik) VALUE
(:imie,:nazwisko,:password,:email,:pracownik)');
$sth->bindValue(':imie', $imie, PDO::PARAM_STR);
$sth->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
 $sth->bindValue(':email', $email, PDO::PARAM_STR);
 $sth->bindValue(':password', $hashPassword, PDO::PARAM_STR);
 $sth->bindValue(':pracownik', False, PDO::PARAM_STR);
 $sth->execute();
 header("Location:logowanie-graf.php");
 unset($_POST);
}else{
  echo "Podany email jest już wykorzystany";
}
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
  <?php
		include_once('header1.php');
	?>
	<div class="srodek">
    <div class="item2 srodek-obiekt">
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
</div>
  <?php
    include_once('footer.php');
  ?>
</body>
</html>
