<?php 
	//Avvia la sessione
	session_start();
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	//$codice = mysqli_real_escape_string($conn, $_POST['valore']);
	
	$query = 'select nome as Nome, cognome as Cognome,cf as Codice_Fiscale, telefono as Telefono, nascita as Nascita, abbonamento as Abbonamento, sum(ricavo) as Spesa  
			from cliente, acquisto
			where cf = "'.$_SESSION['utente'].'" 
			and cliente = "'.$_SESSION['utente'].'";';
	
	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	//Array in cui memorizzare i prodotti in galleria
	$credenzialiArray= array();
	while($entry = mysqli_fetch_assoc($res)){
		
		$credenzialiArray[] = array(
								'Nome' => $entry['Nome'],
								'Cognome' => $entry['Cognome'],
								'Codice_Fiscale' => $entry['Codice_Fiscale'],
								'Telefono' => $entry['Telefono'],
								'Nascita' => $entry['Nascita'],
								'Abbonamento' => $entry['Abbonamento'],
								'Spesa' => $entry['Spesa']
		);
		//Devi mettere anche l'immagine nel database
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($credenzialiArray);
	mysqli_close($conn);
	exit;
?>



