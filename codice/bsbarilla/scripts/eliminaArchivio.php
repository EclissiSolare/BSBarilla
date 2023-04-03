<?php
	$HOST = "localhost"; $USER = "bsbarilla"; $PSW = ""; $DB_NAME = "my_bsbarilla";
	$connection = mysqli_connect($HOST,$USER,$PSW,$DB_NAME) or die ('impossibile connettersi'.mysqli_error());
	$query = "DELETE FROM archivio";
    $result = mysqli_query($connection, $query) or 
    		die("<center> Errore nella query deleteArchivio </center>");
    header("Location: ../index.php");
?>
