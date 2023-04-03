<?php 
    $HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
	$query = "SELECT * FROM archivio";
    $result = mysqli_query($connection, $query) or 
        die("<center> Errore nella query </center>");
    header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=Archivio.csv');
	$output = fopen('php://output', 'w');
	fputcsv($output, array('ID', 'TransazioneID', 'VenditoreID', 'Costo', 'Riuscita','SommaTotale','TIMESTAMP'));
    if (mysqli_num_rows($result) > 0) {
    	while($row=mysqli_fetch_array($result)){
        	$archivio = array($row['ID'], $row['TransazioneID'], $row['VenditoreID'], $row['Costo'], 
            	$row['Riuscita'], $row['SommaTotale'], $row['TIMESTAMP']);
            fputcsv($output, $archivio, ",");
    	}
    }
    
?>
