<?php
	$nome = $_REQUEST['nome'];
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
    
	$query = "SELECT * FROM venditori WHERE Nome LIKE '$nome'";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query countVenditori </center>");
    $id = 0; 
    while($riga=mysqli_fetch_array($result)) $id = $riga['ID']; 
    $query = "DELETE FROM venditori WHERE ID = $id";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query countVenditori </center>");
    //DELETE TABLES
    $query = "DROP TABLE venditore$id"."_carrello, venditore$id"."_prenotazione,venditore$id"."_utente,
    	venditore$id"."_prodotto,venditore$id"."_prodottiPrenotati";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query countVenditori </center>");
    header("Location: ../index.php");
?>
