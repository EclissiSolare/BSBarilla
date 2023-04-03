<?php
	session_start();
    if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $venditore = $_SESSION['venditore'];
    $venditoreID = $_SESSION['venditoreID'];
    $user = $_COOKIE["user$venditoreID"];
    $prezzo = $_REQUEST['prezzo'];
    $data = date('Y-m-d H:i:s'); 
    
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());

	$query = "INSERT INTO venditore$venditoreID" . "_prenotazione VALUES(null,'$user','$data',$prezzo,false)";
    $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query aggiungiPrenotazione <br> $query </center>");
    $lastid = mysqli_insert_id($connection);
    
    $query = "SELECT * FROM venditore$venditoreID" . "_carrello WHERE Utente LIKE '$user'";
    $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query aggiungiPrenotazione <br> $query </center>");
    while($riga=mysqli_fetch_array($result)){
    	$pr = $riga['Prodotto'];
    	$query = "INSERT INTO venditore$venditoreID" . "_prodottiPrenotati VALUES(null,$pr,$lastid)";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query aggiungiPrenotazione <br> $query </center>");
    }
    
    $query = "DELETE FROM venditore$venditoreID" . "_carrello WHERE Utente LIKE '$user'";
    $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query aggiungiPrenotazione <br> $query </center>");
    header("Location: ../profilo.php");
?>
