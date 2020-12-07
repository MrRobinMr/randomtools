<header>
  <div class="item baner-l"><a href="index.php"><img src="logo1.png" alt="RandomTools" style="width:100px;height:100px;"></a></div>
  <div class="item baner-s">
    <form action="index.php" method="post">
      <input type="search" name="szukaj" placeholder="Szukaj">
      <input type="submit" name="szukanie" value="Szukaj">
    </form>
  </div>
  <div class="item baner-r">

    <a href="mojekonto.php"><button type="button">Moje Konto</button></a><br /><br />
    <a href="wyloguj.php"><button type="button">Wyloguj się</button></a><br /><br />

    <?php
        if(!$_SESSION['admin']){
          echo '<a href="koszyk.php"><button type="button">Koszyk</button></a> ';
        }else{
          echo '<a href="admin/admin.php"><button type="button">Admin room</button></a>';
        }
    ?>

  </div>
</header>
