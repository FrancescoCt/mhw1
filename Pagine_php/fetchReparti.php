<?php 
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	//$codice = mysqli_real_escape_string($conn, $_POST['valore']);
	
	$query = "select f.citta as Citta, f.via as Via, r.nome as Nome, r.immagine as Immagine
			from filiale f, reparto r
			where f.codice = r.filiale;";
	
	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	//Array in cui memorizzare i prodotti in galleria
	$repartiArray= array();
	$i = 1;
	while($entry = mysqli_fetch_assoc($res)){
		$repartiArray[] = array(
								'Citta' => $entry['Citta'],
								'Nome' => $entry['Nome'],
								'Via' => $entry['Via'],
								'Immagine' => $entry['Immagine'],
								'Codice' => $i
		);
		$i++;
		//Devi mettere anche l'immagine nel database
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($repartiArray);
	mysqli_close($conn);
	exit;
?>



