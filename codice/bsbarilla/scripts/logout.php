<?php
	session_start();
    if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $venditore = $_SESSION['venditore'];
    $venditoreID = $_SESSION['venditoreID'];
    unset($_COOKIE["user$venditoreID"]); 
    unset($_COOKIE["pass$venditoreID"]); 
    setcookie("user$venditoreID", null, -1, '/'); 
    setcookie("pass$venditoreID", null, -1, '/'); 
    header("Location: ../profilo.php");
?>