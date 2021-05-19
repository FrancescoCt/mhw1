<?php 

	session_start();
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	$cf = mysqli_escape_string($conn, $_SESSION['utente']);
	
	$query = 'select cf as Utente, immagine as Immagine, ora as Ora, giorno as Giorno from preferiti where cf = "'.$cf.'";';

	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	
	//Array in cui memorizzare i prodotti in galleria
	$preferitiArray= array();
	while($entry = mysqli_fetch_assoc($res)){
		
		$preferitiArray[] = array(
								'Utente' => $entry['Utente'],
								'Immagine' => $entry['Immagine'],
								'Ora' => $entry['Ora'],
								'Giorno' => $entry['Giorno']
		);
		//Devi mettere anche l'immagine nel database
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($preferitiArray);
	mysqli_close($conn);
	exit;
?>



