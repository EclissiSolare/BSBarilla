<?php
	session_start();
    $_SESSION['down'] = 1;
    sleep(180);
    $_SESSION['down'] = 0; 
?>