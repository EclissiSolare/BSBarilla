<?php
	session_start();
    if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $venditore = $_SESSION['venditore'];
    $venditoreID = $_SESSION['venditoreID'];
    $user = $_COOKIE["user$venditoreID"];
    $prodotto = $_REQUEST['prodotto'];

$HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());

	$query = "
    	DELETE FROM venditore$venditoreID" . "_carrello 
        WHERE Utente LIKE '$user' AND Prodotto LIKE '$prodotto'
        LIMIT 1";
	
    $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query DeleteProdotto <br> $query </center>");
    header("Location: ../carrello.php");
?>
