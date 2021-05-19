<?php 

	session_start();
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	$cf = mysqli_escape_string($conn, $_SESSION['utente']);
	$img = mysqli_escape_string($conn, $_POST['rimuovi']);
	
	$query = 'delete from preferiti where cf = "'.$cf.'" and immagine = "'.$img.'";';
	//delete from preferiti where cf = 'CFRR55' and immagine = 'http://localhost/Sogno_Italiano/Immagini/maglietta';

	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo "Preferito rimosso dal database";
	mysqli_close($conn);
	exit;
?>



