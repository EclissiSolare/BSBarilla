<html>
<?php
	session_start();
	if(isset($_SESSION['down']) && $_SESSION['down'] == 1){
    	die("<center> SISTEMA DOWN - Riprovare tra qualche minuto </center>");
    }
?>
<head>
	<title> BSBarilla! </title>
	<link rel="stylesheet" type= "text/css" href= "style.css">
    <script>
        function Export()
        {
            var conf = confirm("Esporta archio come CSV?");
            if(conf == true)
            {
                window.open("scripts/export.php", '_blank');
            }
        }
    </script>
</head>
<body>
	<div class="topnav">
		<form action="index.php" method="post"> 
			<button type="submit" class="active" id="home-button">  </button>
		</form>
		<form action="index.php" method="post"> 
        	<input type="hidden" id="isFatturatore" name="isFatturatore" value="0">
			<button type="submit" style="margin-left: 10px; padding: 10px;" > Fatturatore </button>
		</form>
	</div> 
	
	<?php
    	$HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";// si connette al database
$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
		$query = "SELECT * FROM venditori";
        $result = mysqli_query($connection, $query) or 
        	die("<center> Errore nella query venditori. </center>");
        while($riga=mysqli_fetch_array($result)){
          ?>
          <form action="venditore.php" method="post">
          	  <input type="hidden" id="venditoreID" name="venditoreID" value="<?php echo $riga['ID'] ?>">
              <input type="hidden" id="venditore" name="venditore" value="<?php echo $riga['Nome'] ?>">
              <button class="venditore" type="submit"> <?php echo $riga['Nome'] ?> </button>
          </form>
          <?php
        }
    ?>
    <p class="clear"> </p>
    <?php
    	if(isset($_REQUEST["isFatturatore"])){
        	if($_REQUEST["isFatturatore"] == 1){
              ?>
              <center> <h1> Fatturatore </h1> </center>
              <p class="clear"> </p>
                <form action="scripts/aggiungiVenditore.php" method="post">
                      <label for="nome"> Nome Venditore: </label>
                      <input type="text" name="nome" id="nome" required>
                      <label for="nome"> Password Admin: </label>
                      <input type="password" name="password" id="password" required>
                      <button type="submit"> Aggiungi un nuovo venditore </button>
                </form> <p class="clear"> </p>
                <form action="scripts/eliminaVenditore.php" method="post">
                      <label for="nome"> Nome Venditore: </label>
                      <input type="text" name="nome" id="nome" required>
                      <button type="submit"> Elimina  venditore </button>
                </form>
                <p class="clear"> </p> <br>
                <form action="scripts/fatturatore.php" method="post">
                    <button type="submit"> Esegui Transizioni </button>
                </form>
                <p class="clear"> </p> 
                <button onclick="Export()"> Esporta archivio come CSV </button>
                <p class="clear"> </p>
                <form action="scripts/eliminaArchivio.php" method="post">
                	<button type="submit"> Elimina Archivio </button>
                </form> <br>
                <h1> Ultime 10 transazioni </h1> 
                <table border="1">
                	<tr> <td> ID </td> <td> TransazioneID </td> <td> VenditoreID </td> <td> Costo </td>
                    	<td> Riuscita </td> <td> SommaTotale </td> <td> TIMESTAMP </td> </tr>
                <?php
                	$HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
                    $connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
                    $query = "SELECT * FROM archivio ORDER BY ID DESC limit 10";
                    $result = mysqli_query($connection, $query) or 
                        die("<center> Errore nella query selectTrasferimenti. </center>");
                    while($riga=mysqli_fetch_array($result)){
                    	echo "<tr>";
                        echo "<td>" . $riga['ID'] . "</td>";
                        echo "<td>" . $riga['TransazioneID'] . "</td>";
                        echo "<td>" . $riga['VenditoreID'] . "</td>";
                        echo "<td>" . $riga['Costo'] . "</td>";
                        echo "<td>" . $riga['Riuscita'] . "</td>";
                        echo "<td>" . $riga['SommaTotale'] . "</td>";
                        echo "<td>" . $riga['TIMESTAMP'] . "</td>";
                        echo "</tr>";
                    }
                ?>
                </table>
                Rapporto trasferimenti riusciti/falliti: 
                <?php
                	$query = "SELECT * FROM archivio";
                    $riusciti = 0; $falliti = 0; 
                    $result = mysqli_query($connection, $query) or 
                        die("<center> Errore nella query rapportoTransizioni. </center>");
                    while($riga=mysqli_fetch_array($result)){
                    	if($riga['Riuscita']==0) $falliti++;
                        else $riusciti++;
                    }
                    echo "$riusciti/$falliti";
                ?>
              <?php
        	} else {
            	?>
            	<form action="scripts/diventaFatturatore.php" method="post">
                  <label for="nomeFatt"> Nome Fatturatore: </label>
                  <input type="text" name="nomeFatt" id="nomeFatt"> 
                  <label for="passFatt"> Password Fatturatore: </label>
                  <input type="password" name="passFatt" id="passFatt"> 
                  <button type="submit"> Diventa Fatturatore </button>
                </form>
                <?php
            }
		}
    ?>
</body>
</html>
