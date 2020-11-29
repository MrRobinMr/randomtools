<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>Logowanie</title>

	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
			background-color: white;
			background-size: cover;
		}
		p{
			color: black;
			font-size: 15px;
			margin: 10px;
			position: absolute;
			top: 34%;
			left: 39%;
		}
		.logowaniea{
			width: 300px;
			position: absolute;
			top: 40%;
			left: 50%;
			transform: translate(-50%, -50%);
			color: black;
		}
		.logowaniea h1{
			float: center;
			text-align: center;
			font-size: 35px;
			margin-bottom: 40px;
			padding: 13px 0;
			cursor: default;
		}
		.kratka{
			width: 100%;
			overflow: hidden;

			font-size: 20px;
			padding: 8px 0;
			margin: 8px 0;
			border-bottom: 1px solid blue;
		}
		.kratka input{
			border: none;
			outline: none;
			background: none;
			color: black;
			font-size: 20px;
			width: 100%;
			float: left;
			margin: 0 10px;
		}
		.zaloguj{
			width: 60%;
			background: none;
			font-size: 15px;
			font-weight: bold;
			border: 2px solid blue;
			padding: 4px;
			cursor: pointer;
			margin: 10px 0;
		}
		.zaloguj:hover{
			background-color: blue;
			color: white;
		}

	</style>
</head>
<body>
<div class="logowaniea">
<form action="logowanie.php" method="post">
	<h1>Logowanie</h1>
	<div class="kratka">
		<input type="email" placeholder="E mail" name="email" value="">
	</div>
	<div class="kratka">
		<input type="password" placeholder="Hasło" name="haslo" value="">
	</div>
	<center>
		<input class="zaloguj"  type="submit" value="Zaloguj">
	</center>
</form>
</div>

</body>
</html>
