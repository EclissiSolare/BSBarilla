<?php
  session_start();
  if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
      die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
  }
  $venditore = $_SESSION['venditore'];
  $venditoreID = $_SESSION['venditoreID'];

  $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
  $connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());

  $query = "DELETE FROM venditore$venditoreID"."_prodottiPrenotati"; 
  $result = mysqli_query($connection, $query) or 
  	die("<center> Errore nella query countVenditori </center>");
  $query = "DELETE FROM venditore$venditoreID"."_prenotazione"; 
  $result = mysqli_query($connection, $query) or 
  	die("<center> Errore nella query countVenditori </center>");
    
  header("Location: ../venditore.php");
?>
