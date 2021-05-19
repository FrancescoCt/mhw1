<?php 
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	$query = "select p.codice as Codice, p.nome as Nome, d.sezione as Cod_Sezione, s.nome as Sezione,r.nome as Reparto, u.prezzo as Prezzo, p.immagine as Immagine 
			from prodotto p,  deposito d , sezione s, pezzi u, reparto r
			where p.codice = d.prodotto and d.filiale= s.filiale 
							and d.reparto=s.reparto 
							and d.sezione = s.codice 
							and u.id = d.id_prodotto 
							and u.codice_prodotto = p.codice
							and r.codice = d.reparto group by p.codice;";
	
	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	//Array in cui memorizzare i prodotti in galleria
	$depositoArray= array();
	while($entry = mysqli_fetch_assoc($res)){
		
		$depositoArray[] = array(
								'Codice' => $entry['Codice'],
								'Nome' => $entry['Nome'],
								'Cod_sezione' => $entry['Cod_Sezione'],
								'Sezione' => $entry['Sezione'],
								'Reparto' => $entry['Reparto'],
								'Prezzo' => $entry['Prezzo'],
								'Immagine' => $entry['Immagine']
		);
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($depositoArray);
	mysqli_close($conn);
	exit;
?>



