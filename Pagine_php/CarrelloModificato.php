
<?php 

	session_start();
	//Specifico che la pagina deve restituire un json
	header('Content-Type: application/json');
	
	//Mi connetto al database
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die("Errore : ".mysqli_error());
	
	$stringa1 = '0';								//Metto 0 per fare quadrare i conti, di fatto nessun prodotto avrà mai quel codice nel database
	$arr = json_decode($_POST['codici_prodotto']);	//Soluzione proposta da stack overflow
	if(count($arr)>1){
		foreach($arr as &$codice){
		$stringa1 = $stringa1.', '.$codice;
		}
	}else{
		$stringa1 = $arr[0];
	}
	$cod = mysqli_real_escape_string($conn, $stringa1);
	
	$query = "select p.codice as Codice, d.id_prodotto as ID_Copia, p.nome as Nome, d.sezione as Cod_Sezione, s.nome as Sezione,r.nome as Reparto, u.prezzo as Prezzo, p.immagine as Immagine 
			from prodotto p,  deposito d , sezione s, pezzi u, reparto r
			where p.codice = d.prodotto and d.filiale= s.filiale 
							and d.reparto=s.reparto 
							and d.sezione = s.codice 
							and u.id = d.id_prodotto 
							and u.codice_prodotto = p.codice
							and p.codice in (".$cod.")
							and r.codice = d.reparto group by p.codice;";
	
	$res = mysqli_query($conn, $query) or die (mysqli_error($conn));
	
	//Array in cui memorizzare i prodotti in galleria
	$depositoArray= array();
	while($entry = mysqli_fetch_assoc($res)){
		
		$depositoArray[] = array(
								'Codice' => $entry['Codice'],
								'ID_Copia' => $entry['ID_Copia'],
								'Nome' => $entry['Nome'],
								'Cod_sezione' => $entry['Cod_Sezione'],
								'Sezione' => $entry['Sezione'],
								'Reparto' => $entry['Reparto'],
								'Prezzo' => $entry['Prezzo'],
								'Immagine' => $entry['Immagine']
		);
		//Aprofitto di questi valori della entry per fare le query di inserimento
		//$query1 = "insert into acquisto values('".$entry['Codice']."','".$entry['ID_Copia']."','".$_SESSION["utente"]."',current_date(),current_time(),'".$entry['Prezzo']."');";
		//Questa query appena vista non va bene perchè non tiene conto della politica aziendale sull'età e sugli abbonamenti, la procedure acquisto invece la considera
		$query1 = "call acquisto('".$entry['Codice']."', '".$entry['ID_Copia']."', '".$_SESSION["utente"]."');";
		//call acquisto('1', '3', 'CTFR55');
		$res1 = mysqli_query($conn, $query1) or die (mysqli_error($conn));
	}
	
	//Restituzione lato client di tutti i dati ottenuti finora
	echo json_encode($depositoArray);
	mysqli_close($conn);
	exit;
?>