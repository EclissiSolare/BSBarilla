<?php
session_start();
  if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
      die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
  }
  $venditore = $_SESSION['venditore'];
  $venditoreID = $_SESSION['venditoreID'];

    $prodottoN = $_REQUEST['prodottoN'];
    $prezzo = $_REQUEST['prezzo'];
  $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
  $connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
  
  $query = "INSERT INTO venditore$venditoreID"."_prodotto VALUES(null,'$prodottoN',$prezzo)";
  $result = mysqli_query($connection, $query) or 
  	die("<center> Errore nella query aggiungiProdotti </center>");
  header("Location: ../venditore.php");
?>
