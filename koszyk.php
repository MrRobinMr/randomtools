<?php

session_start();

require_once "conf.php";

try{
    $db=new mysqli($host,$db_user,$db_password,$db_name);
    if($db->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }else {

    }
catch(Exception $e ) {
    echo "Błąd serwera";
}

?>
