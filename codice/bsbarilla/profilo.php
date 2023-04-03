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

    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());

    $accessoAdmin = false; 
    $accessoEseguito = false; 
    
    if(isset($_COOKIE["user$venditoreID"]) && isset($_COOKIE["pass$venditoreID"])){
    	$user = $_COOKIE["user$venditoreID"];
        $pass = $_COOKIE["pass$venditoreID"];
        $accessoEseguito = true;
        $soldi = 0; 
        $query = "SELECT * FROM venditore$venditoreID"."_utente WHERE ID LIKE '$user'";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query soldi. </center>");
        while($riga=mysqli_fetch_array($result)){
        	$soldi = $riga['Soldi'];
        }
        
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
?>
<head>
	<title> Profilo </title>
    <link rel="stylesheet" type= "text/css" href= "style.css">
</head>
<body>
	<div class="topnav">
		<form action="index.php" method="post"> 
			<button type="submit" style="margin-left: 10px; padding: 10px;" id="home-button">  </button>
		</form>
		<form action="venditore.php" method="post"> 
        	<input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
            <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
			<button type="submit" style="margin-left: 10px; padding: 10px;"> Venditore <?php echo $venditore ?> </button>
		</form>
        <form action="profilo.php" method="post">
			<button type="submit" class="active" style="margin-left: 10px; padding: 10px;"> Profilo </button>
		</form>
        <form action="carrello.php" method="post">
        	<input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $venditoreID ?>">
            <input type="hidden" id="venditore" name="venditore" value="<?php echo $venditore ?>">
			<button type="submit" style="margin-left: 10px; padding: 10px;" <?php if(!$accessoEseguito) echo "disabled"; ?>> Carrello di <?php if($accessoEseguito) echo $user; ?> </button>
		</form>
	</div> <br>
<?php 
	if(!$accessoEseguito){
    	?>
        	<form action="scripts/login.php" method="post">
            	<label for="username"> Username: </label>
           		<input type="text" name="username" id="username" required>
                <label for="password"> Password: </label>
           		<input type="password" name="password" id="password" required>
                <button type="submit"> Login </button>
                <label for="email"> Registrati inserendo anche l'email: </label>
                <input type="email" name="email" id="email">
                <button type="submit"> Register </button>
            </form>
            <br>
        <?php
    }
    else {
        ?>
        Soldi = <?php echo $soldi; ?> Euro
        <p class="clear"> </p>
        <table border="1">
        	<tr> <td> Costo </td> <td> Data </td> <td> Evasa </td> <td> Prodotti </td> </tr>
            <?php
                $query = "SELECT * FROM venditore$venditoreID"."_prenotazione WHERE Utente LIKE '$user'";
                $result = mysqli_query($connection, $query) or 
                    die("<center> Errore nella query prenotazione. </center>");
                while($riga=mysqli_fetch_array($result)){
                	$pren = $riga['ID'];
                    ?>
                    <tr>
                    	<td> <?php echo $riga['PrezzoTotale']; ?> </td>
                        <td> <?php echo $riga['Data']; ?> </td>
                        <td> <?php echo $riga['Eseguita']; ?> </td>
                        <td> <?php
                        	$query1 = "SELECT * FROM venditore$venditoreID"."_prodottiPrenotati WHERE Prenotazione = $pren";
                            $result1 = mysqli_query($connection, $query1) or 
                                die("<center> Errore nella query prodottiPrenotati. </center>");
                            while($riga1=mysqli_fetch_array($result1)){
                            	$product = $riga1['Prodotto'];
                                $query2 = "SELECT * FROM venditore$venditoreID"."_prodotto WHERE ID = $product";
                                $result2 = mysqli_query($connection, $query2) or 
                                    die("<center> Errore nella query prodotto. </center>");
                                while($riga2=mysqli_fetch_array($result2)){
                                    echo $riga2['Nome'] . ";";
                            	}
                            }
                        ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        <p class="clear"> </p> <br>
        <form action="scripts/logout.php" method="post">
       		<button type="submit"> Logout </button>
        </form>
    	<?php
    }
?>
</body>
</html>
