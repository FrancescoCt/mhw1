<?php 
	header('Content-Type: application/json');
	$vetrinaArray = array(
		array(
			
			'titolo' => ' Casual',
			'codice' => '1',
			'immagine' => "../Immagini/magliettaRagazzo.jfif",
			'nome' => 'Maglietta',
			'genere' => ' ragazzo',
			'taglia' => ' L ',
			'prezzo' => '20€'
			
		),
		array(
			
			'titolo' => ' Estivo',
			'codice' => '2',
			'immagine' => "../Immagini/magliettaRagazzo1.jfif",
			'nome' => 'Maglietta',
			'genere' => ' ragazzo',
			'taglia' => ' S ',
			'prezzo' => '15€'
			
		),
		array(
			
			'titolo' => ' Street',
			'codice' => '3',
			'immagine' => "../Immagini/felpa.jfif",
			'nome' => 'Felpa',
			'genere' => ' ragazzo',
			'taglia' => ' L ',
			'prezzo' => '25€'
			
		),
		array(
			
			'titolo' => ' Casual',
			'codice' => '4',
			'immagine' => "../Immagini/magliettaRagazza.jfif",
			'nome' => 'Maglietta',
			'genere' => ' ragazza',
			'taglia' => ' M ',
			'prezzo' => '18€'
			
		),
		array(
			
			'titolo' => ' Classico',
			'codice' => '5',
			'immagine' => "../Immagini/repartoUomo.jpeg",
			'nome' => 'Reparto',
			'genere' => ' Uomo',
			'indirizzo' => ' Via Filo 48- Catania'
		),
		array(
			
			'titolo' => ' Casual',
			'codice' => '6',
			'immagine' => "../Immagini/repartoDonna.jpg",
			'nome' => 'Reparto',
			'genere' => ' Donna',
			'indirizzo' => ' Via Filo 48 - Catania'
		),
		array(
			'titolo' => ' Classico',
			'codice' => '7',
			'immagine' => "../Immagini/repartoRagazzo.jpg",
			'nome' => 'Reparto',
			'genere' => ' Ragazzo',
			'indirizzo' => ' Via Neri 17-Milano'
		)
		
	)
	///////////////////////////////////////////////
;
	echo json_encode($vetrinaArray);
	exit;
?>