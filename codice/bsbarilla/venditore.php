<html>
<?php
	session_start();
    if(isset($_SESSION['down']) && $_SESSION['down'] == 1){
    	die("<center> SISTEMA DOWN - Riprovare tra qualche minuto </center>");
    }
	$venditore ="";
    $venditoreID = 0;
    if(isset($_REQUEST["venditore"]) && isset($_REQUEST["venditoreID"])){
    	$venditore = $_REQUEST['venditore'];
        $venditoreID = $_REQUEST['venditoreID'];
        unset($_SESSION["venditore"]); 
        unset($_SESSION["venditoreID"]);
        $_SESSION['venditore'] = $venditore;
        $_SESSION['venditoreID'] = $venditoreID;
    }
	else if(isset($_SESSION['venditore']) && isset($_SESSION['venditoreID'])){
    	$venditore = $_SESSION['venditore'];
        $venditoreID = $_SESSION['venditoreID'];
    }
    else {
    	die("<center> Errore Venditore <br> <a href='index.php'> Home Page </a></center>");
    }
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
    
    $accessoAdmin = false; 
    $accessoEseguito = false; 
    
    if(isset($_COOKIE["user$venditoreID"])&& isset($_COOKIE["pass$venditoreID"])){
    	$user = $_COOKIE["user$venditoreID"];
        $pass = $_COOKIE["pass$venditoreID"];
        $accessoEseguito = true;
        
        $query = "SELECT * FROM venditori WHERE ID = $venditoreID";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query adminVenditore. </center>");
        $adminPass = ""; $find = false;
        while($riga=mysqli_fetch_array($result)){
        	$adminPass = $riga['PassAdmin'];
            $find = true;
        }
        if($find){ 
        	if($user == "admin" && $pass == $adminPass) $accessoAdmin = true; 
        }
    }
?>
<head>
	<title> Venditore <?php echo $venditore ?> </title>
	<link rel="stylesheet" type= "text/css" href= "style.css">
</head>
<body>
	<div class="topnav">
		<form action="index.php" method="post"> 
			<button type="submit" style="margin-left: 10px; padding: 10px;" id="home-button"> </button>
		</form>
		<form action="venditore.php" method="post"> 
			<button type="submit" class="active" style="margin-left: 10px; padding: 10px;"> Venditore <?php echo $venditore ?> </button>
		</form>
        <form action="profilo.php" method="post">
        	<input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
            <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
			<button type="submit" style="margin-left: 10px; padding: 10px;"> Profilo <?php if($accessoEseguito) echo $user; ?> </button>
		</form>
        <form action="carrello.php" method="post">
        	<input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
            <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
			<button type="submit" style="margin-left: 10px; padding: 10px;" <?php if(!$accessoEseguito) echo "disabled"; ?>> Carrello di <?php if($accessoEseguito) echo $user; ?> </button>
		</form>
	</div> 
	
  	<?php
		$query = "SELECT * FROM venditore$venditoreID" . "_prodotto";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query venditoreProdotto. </center>");
        while($riga=mysqli_fetch_array($result)){
          ?>
          <form action="scripts/compra_prodotto.php" method="post">
          	  <input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
              <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
              <input type="hidden" id="prodottoID" name="prodottoID" value="<?php echo $riga['ID'] ?>">
              <button class="venditore" type="submit" <?php if(!$accessoEseguito) echo "disabled"; ?>> 
              	<?php echo $riga['Nome'] ?> <br>
                Prezzo: <?php echo $riga['Prezzo'] ?> euro
              </button>
          </form>
          <?php
        }
        if($accessoAdmin){
        	//azzeraPrenotazioni & modificaProdotti
            ?>
            	<p class="clear"> </p> <br>
            	<form action="scripts/azzerarePrenotazioni.php" method="post">
                	<button type="submit"> Azzera Prenotazioni </button>
                </form>
                <p class="clear"> </p> <br>
                <form action="scripts/modificaProdotti.php" method="post">
                	<label for="prodottoI"> Prodotto da modificare: </label>
                	<input type="text" name="prodottoI" id="prodottoI" required>
                    <label for="prodottoN"> Nuovo prodotto: </label>
                	<input type="text" name="prodottoN" id="prodottoN" required>
                    <label for="prezzo"> Nuovo prezzo: </label>
                	<input type="text" name="prezzo" id="prezzo" required>
                	<button type="submit"> Modifica </button>
                </form>
                <p class="clear"> </p> <br>
                <form action="scripts/aggiungiProdotti.php" method="post">
                    <label for="prodottoN"> Nuovo prodotto: </label>
                	<input type="text" name="prodottoN" id="prodottoN" required>
                    <label for="prezzo"> Nuovo prezzo: </label>
                	<input type="text" name="prezzo" id="prezzo" required>
                	<button type="submit"> Aggiungi </button>
                </form>
            <?php
        }
    ?>
	
</body>
</html>
