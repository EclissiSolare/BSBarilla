<html>
<?php
	session_start();
    if(isset($_SESSION['down']) && $_SESSION['down'] == 1){
    	die("<center> SISTEMA DOWN - Riprovare tra qualche minuto </center>");
    }
    if(!isset($_SESSION['venditore']) || !isset($_SESSION['venditoreID'])){
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $venditore = $_SESSION['venditore'];
    $venditoreID = $_SESSION['venditoreID'];
    $user = $_COOKIE["user$venditoreID"];
    $prezzo = 0; 
    
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
?>
<head>
	<title> Carrello di </title>
    <link rel="stylesheet" type= "text/css" href= "style.css">
</head>
<body>
	<div class="topnav">
		<form action="index.php" method="post"> 
			<button type="submit" style="margin-right: 10px; padding: 10px;" id="home-button"> </button>
		</form>
		<form action="venditore.php" method="post"> 
			<button type="submit" style="margin-right: 10px; padding: 10px;"> Venditore <?php echo $venditore ?> </button>
		</form>
        <form action="profilo.php" method="post">
        	<input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
            <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
			<button type="submit" style="margin-right: 10px;"> Profilo <?php if($accessoEseguito) echo $user; ?> </button>
		</form>
        <form action="carrello.php" method="post">
        	<input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
            <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
			<button type="submit" class="active" disabled > Carrello di <?php echo $user; ?> </button>
		</form>
	</div> 
    <br>
    <table border="1">
                	<tr>
                    	<td> Prodotto </td>
                        <td> Prezzo (EUR) </td>
                        <td> Rimuovi </td>
                    <tr>
    <?php
    	$query = "SELECT * FROM venditore$venditoreID" . "_carrello INNER JOIN venditore$venditoreID" . "_prodotto ON 
        	venditore$venditoreID" . "_carrello.Prodotto=venditore$venditoreID" . "_prodotto.ID WHERE Utente LIKE '$user'";
    	$result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query getProdottiCarrello </center>");
    	while($riga=mysqli_fetch_array($result)){
        	$prezzo = $prezzo + $riga['Prezzo'];
    		?>
            <tr>
                <td> <center> <?php echo $riga['Nome']; ?> </center> </td>
            	<td> <center> <?php echo $riga['Prezzo']; ?> </center> </td>
                <td> 
                	<div class="vertical-center">
                      <form action="scripts/rimuoviProdotto.php" method="post">
                        <input type="hidden" name="prodotto" id="prodotto" value="<?php echo $riga['ID']; ?>">
                        <center> <button type="submit"> X </button> </center>
                      </form>
                    </div>
                </td>
            </tr>
            <?php
    	}
    ?>
    </table> 
    <p class="clear"> </p> <br>
    <form action="scripts/prenota.php" method="get">
    	<input type="hidden" name="prezzo" id="prezzo" value="<?php echo $prezzo; ?>">
    	<button type="submit"> Prenota - <?php echo $prezzo; ?></button> 
    </form>
</body>
</html>
