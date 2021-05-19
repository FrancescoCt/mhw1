function raccogli(event){
	console.log('Attivato');
	const tasto = event.currentTarget;
	const formData = new FormData(formElement);
	
	const codici = document.querySelectorAll('.elemento h3');
	//Creo un array di stringhe contenente i codici dei prodotti
	let N = 10;						//Questo N deve essere per forza uguale al numero di elementi nella nodelist di codici altrimenti c'è errore
									//Per questo motivo uso l'if in modo da prevenire questo errore e poter mettere un numero N arbitrario maggiore
									//in base al numero di elementi massimo che mi aspetto di avere tra i preferiti
	let arrayCodici = [];
	for(let i=0; i < N; i++){
		if(codici[i]){
			arrayCodici.push(codici[i].innerText);
			console.log(codici[i].innerText);
		}else break;
		
	}
	//Faccio la append di questo array di stringhe al form
	//Il json che mi viene restituito sarà la query contenente tutte le righe con i codici presenti nell'array di stringhe
	
	formData.append('codici_prodotto', JSON.stringify(arrayCodici));
	console.log(formData);
	
	//Mando il codice alla pagina PHP tramite fetch
	fetch("../Pagine_php/CarrelloModificato.php", {method: 'post', body: formData}).then(onResponse).then(onJson);
	//event.preventDefault();
}

function onResponse(response){
	console.log(response);
	return response.json();
}
function onJson(json){
	console.log(json);
}

const form = document.querySelector('form');
console.log(form);
form.addEventListener('submit', raccogli);