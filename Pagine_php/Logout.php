<?php
	//Avvia la sessione
	session_start();
	//Elimina la sessione
	session_destroy();
	//Vai al login
	header("Location: Login.php");
	exit;
?>