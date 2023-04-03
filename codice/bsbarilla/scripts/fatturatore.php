<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$mysqli = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());

    $query = "SELECT * FROM venditori;";
    $result = mysqli_query($mysqli, $query) or 
    	die("<center> Errore nella query countVenditori </center>");
    while($riga=mysqli_fetch_array($result)){
    	$venditoreID = $riga['ID'];
    	$query1 = "SELECT * FROM venditore$venditoreID"."_prenotazione WHERE Eseguita=0";
        $result1 = mysqli_query($mysqli, $query1) or 
    		die("<center> Errore nella query countVenditori </center>");
        //per ogni prenotazione non eseguita
        while($riga1=mysqli_fetch_array($result1)){
        	$idPren = $riga1["ID"];
        	echo "Prenotazione $idPren <br>";
        	
            $sommaTotale = 0; 
        	$query2 = "SELECT * FROM archivio";
        	$result2 = mysqli_query($mysqli, $query2) or 
    			die("<center> Errore nella query archivio </center>");
        	while($riga2=mysqli_fetch_array($result2)){ 
            	if($riga2['SommaTotale']>$sommaTotale) $sommaTotale = $riga2['SommaTotale'];
            }
        	$prezzo = $riga1["PrezzoTotale"];
            $sommaTotale = $sommaTotale + $prezzo;
            $user = $riga1["Utente"];
            $data = date('Y-m-d H:i:s'); 
        	//Transazione per ogni prenotazione
            mysqli_begin_transaction($mysqli);
            $r = true;
            try{
            	mysqli_query($mysqli, "UPDATE venditori SET Soldi=Soldi+$prezzo WHERE ID=$venditoreID;");
                mysqli_query($mysqli, "UPDATE venditore$venditoreID"."_utente SET Soldi=Soldi-$prezzo WHERE ID LIKE '$user';");
                mysqli_query($mysqli, "UPDATE venditore$venditoreID"."_prenotazione SET Eseguita=1 WHERE ID = $idPren;");
            	mysqli_commit($mysqli);
            }catch(mysqli_sql_exception $exception) {
              mysqli_rollback($mysqli);
              $r = false;
          	}
            if(!$r){
            	$query3 = "INSERT INTO archivio VALUES(null,$idPren,$venditoreID,$prezzo,false,$sommaTotale,'$data')";
        	  	$result3 = mysqli_query($mysqli, $query3) or 
    				die("<center> Errore nella query3 <br> $query3 </center>"); 
            } else {
            	$query3 = "INSERT INTO archivio VALUES(null,$idPren,$venditoreID,$prezzo,true,$sommaTotale,'$data')";
        	  	$result3 = mysqli_query($mysqli, $query3) or 
    				die("<center> Errore nella query3 <br> $query3 </center>");
            }
        }
    }
?>
