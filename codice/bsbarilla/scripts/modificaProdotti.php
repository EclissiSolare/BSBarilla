<?php
session_start();
  if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
      die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
  }
  $venditore = $_SESSION['venditore'];
  $venditoreID = $_SESSION['venditoreID'];

	$prodottoI = $_REQUEST['prodottoI'];
    $prodottoN = $_REQUEST['prodottoN'];
    $prezzo = $_REQUEST['prezzo'];
$HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
  
  $query = "UPDATE venditore$venditoreID"."_prodotto SET Nome = '$prodottoN', Prezzo = $prezzo WHERE Nome LIKE '$prodottoI'"; 
  $result = mysqli_query($connection, $query) or 
  	die("<center> Errore nella query modificaProdotti </center>");
  header("Location: ../venditore.php");
?>
