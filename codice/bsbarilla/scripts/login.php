<?php
	session_start();
    if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $venditore = $_SESSION['venditore'];
    $venditoreID = $_SESSION['venditoreID'];
    
	$username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";// si connette al database
    $connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
    $find = false;
    if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])){
    	$email = $_REQUEST['email'];
		$query = "INSERT INTO venditore" . $venditoreID . "_utente VALUES('$username','$email','$password',100)";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query registerUser </center>");
        $find = true;
    }
    $query = "SELECT * FROM venditore" . $venditoreID . "_utente WHERE ID LIKE '$username' AND Password LIKE '$password'";
    $result = mysqli_query($connection, $query) or 
    	die("<center> Errore nella query loginUser </center>");
    while($riga=mysqli_fetch_array($result)){
    	$find = true;
    }
    if($find){
      setcookie("user$venditoreID",$username, time() + 3600, '/');
      setcookie("pass$venditoreID",$password, time() + 3600, '/');
    }
    header("Location: ../profilo.php");
?>
