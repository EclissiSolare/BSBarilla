<?php
	$nome = $_REQUEST['nomeFatt'];
    $pass = $_REQUEST['passFatt'];
    if($nome == "admin" && $pass == "bsbarilla"){
    	header("Location: ../index.php?isFatturatore=1");
    }
    else header("Location: ../index.php?isFatturatore=0");
?>
