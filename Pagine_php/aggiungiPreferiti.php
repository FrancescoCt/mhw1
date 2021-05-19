<?php 

	session_start();
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	$cf = mysqli_escape_string($conn, $_SESSION['utente']);
	$img = mysqli_escape_string($conn, $_POST['immagine']);
	
	$query = 'insert into preferiti values ("'.$cf.'","'.$img.'",current_time(), current_date());';

	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo "Preferito inserito nel database";
	mysqli_close($conn);
	exit;
?>



