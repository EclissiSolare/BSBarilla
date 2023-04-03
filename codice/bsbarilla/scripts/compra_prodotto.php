<?php
	session_start();
    if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $venditore = $_SESSION['venditore'];
    $venditoreID = $_SESSION['venditoreID'];
    
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
    
    if(isset($_COOKIE["user$venditoreID"]) && isset($_COOKIE["pass$venditoreID"])){
    	$user = $_COOKIE["user$venditoreID"];
        $pass = $_COOKIE["pass$venditoreID"];
        $accessoEseguito = true;
        
        $query = "SELECT * FROM venditori WHERE ID = $venditoreID";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query adminVenditore. </center>");
        $adminPass = ""; $find = false;
        while($riga=mysqli_fetch_array($result)){
        	$adminPass = $riga['passAdmin'];
            $find = true;
        }
        if($find){ 
        	if($user == "admin" && $pass == $adminPass) $accessoAdmin = true; 
        }
    }
    
    $prodottoID = $_REQUEST['prodottoID'];
    
    $query = "INSERT INTO venditore" . $venditoreID . "_carrello VALUES(null,'$user',$prodottoID)";
    $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query aggiungiAlCarrello. <br> $query </center>");
    header("Location: ../venditore.php");
?>
