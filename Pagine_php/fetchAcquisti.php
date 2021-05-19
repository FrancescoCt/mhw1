<?php 

	session_start();
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	//$codice = mysqli_real_escape_string($conn, $_POST['valore']);
	
	$query = 'select a.codice_prodotto as Codice, p.nome as Nome, a.id_prodotto as ID_Prodotto,"Acquistato" as Reparto, a.ricavo as Prezzo, p.immagine as Immagine, a.giorno as Giorno, a.ora as Ora
			from prodotto p, acquisto a , pezzi u
			where 			p.codice = a.codice_prodotto 
							and a.id_prodotto = u.id
							and u.codice_prodotto = p.codice
							and a.cliente = "'.$_SESSION['utente'].'";';
	//and a.cliente = "GIUBEL62";
	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	//Array in cui memorizzare i prodotti in galleria
	$acquistoArray= array();
	while($entry = mysqli_fetch_assoc($res)){
		$acquistoArray[] = array(
								'Codice' => $entry['Codice'],
								'Nome' => $entry['Nome'],
								'ID_Prodotto' => $entry['ID_Prodotto'],
								'Reparto' => $entry['Reparto'],
								'Prezzo' => $entry['Prezzo'],
								'Immagine' => $entry['Immagine'],
								'Giorno' => $entry['Giorno'],
								'Ora' => $entry['Ora']
		);
		//Devi mettere anche l'immagine nel database
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($acquistoArray);
	mysqli_close($conn);
	exit;
?>



