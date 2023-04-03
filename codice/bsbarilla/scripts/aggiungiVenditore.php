<?php
	$nome = $_REQUEST['nome'];
    $password = $_REQUEST['password'];
    
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
    
    $query = "SELECT * FROM venditori"; 
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query countVenditori </center>");
    $count = 0; 
    while($riga=mysqli_fetch_array($result)) $count++; 
    $count++; 
    $query = "INSERT INTO venditori VALUES($count,'$nome','$password',0)";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query insertVenditore <br> $query </center>");
    $query = "CREATE TABLE IF NOT EXISTS venditore$count"."_utente (
    ID VARCHAR(20) PRIMARY KEY,
    Email VARCHAR(30) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    Soldi FLOAT NOT NULL
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query createVenditore <br> $query </center>");
    $query = "CREATE TABLE IF NOT EXISTS venditore$count"."_prodotto (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(20) NOT NULL,
    Prezzo FLOAT NOT NULL
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query createVenditore <br> $query </center>");
    //PRENOTAZIONE
	$query = "CREATE TABLE IF NOT EXISTS venditore$count"."_prenotazione (
      ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Utente VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      Data timestamp NOT NULL,
      PrezzoTotale FLOAT NOT NULL,
      Eseguita tinyint(1) NOT NULL,
      KEY Utente (Utente),
      FOREIGN KEY (Utente) REFERENCES venditore$count"."_utente (ID)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query createVenditore <br> $query </center>");
    //CARRELLO
	$query = "CREATE TABLE IF NOT EXISTS venditore$count"."_carrello (
      ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Utente VARCHAR(20) NOT NULL,
      Prodotto INT NOT NULL,
      KEY Prodotto (Prodotto),
      KEY Utente (Utente),
      FOREIGN KEY (Prodotto) REFERENCES venditore$count"."_prodotto (ID),
      FOREIGN KEY (Utente) REFERENCES venditore$count"."_utente (ID)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query createVenditore <br> $query </center>");
    //PRODOTTI PRENOTATI
    $query = "CREATE TABLE IF NOT EXISTS venditore$count"."_prodottiPrenotati (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Prodotto INT NOT NULL,
    Prenotazione INT NOT NULL,
    KEY Prodotto (Prodotto),
    KEY Prenotazione (Prenotazione),
    FOREIGN KEY (Prodotto) REFERENCES venditore$count"."_prodotto(ID),
    FOREIGN KEY (Prenotazione) REFERENCES venditore$count"."_prenotazione(ID)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query createVenditore <br> $query </center>");    
    $query = "INSERT INTO venditore$count"."_utente VALUES('admin','email@gmail.com','$password',100)";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query insertVenditore <br> $query </center>");
    header("Location: ../index.php");
?>
