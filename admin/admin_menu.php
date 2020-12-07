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
<head>
<link rel="stylesheet" href="../st.css">
</head>
<div>
<a href="../index.php"><button type="button">Powrót</button></a>
<a href="admin.php"><button type="button">Strona główna</button></a>
<a href="users.php"><button type="button">Użytkownicy</button></a>
<a href="produkty.php"><button type="button">Produkty</button></a>
<a href="zamowienia.php"><button type="button">Zamówienia</button></a>
</div>
