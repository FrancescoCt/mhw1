<?php 
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	$input = mysqli_escape_string($conn, $_POST['stringa']);
	
	$query = 'select nome as Nome, sede as Citta, via as Via, immagine as Immagine
			from fornitore
			where 			nome like "%'.$input.'%" 
							or sede like "%'.$input.'%"  
							or via like "%'.$input.'%";';
	//select nome as Nome, sede as Citta, via as Via from fornitore	where nome like '%Ver%' or sede like '%o%' or via like '%as%';
	
	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	//Array in cui memorizzare i prodotti in galleria
	$fornitoriArray= array();
	$index = 0;
	while($entry = mysqli_fetch_assoc($res)){
		
		$fornitoriArray[] = array(
								
								'Nome' => $entry['Nome'],
								'Citta' => $entry['Citta'],
								'Via' => $entry['Via'],
								'Risultato' => $index,
								'Immagine' => $entry['Immagine']
		);
		$index++;
		//Devi mettere anche l'immagine nel database
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($fornitoriArray);
	mysqli_close($conn);
	exit;
?>



