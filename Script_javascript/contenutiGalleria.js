
fetch("../Pagine_php/fetchProdotti.php").then(onResponse).then(onJson);

function onResponse(response){
	console.log(response);
	return response.json();
}
function onJson(json){
    console.log(json);
	const sezione = document.querySelector('section');	
	
	for(let item of json){
		
        const oggetto=document.createElement('div');
        oggetto.classList.add('oggetto');
		sezione.appendChild(oggetto);
		
		const stella = document.createElement('div');
		stella.classList.add('hidden');
		oggetto.appendChild(stella);
		
		const titolo = document.createElement('h2');
		titolo.innerText = item.Reparto;
		oggetto.appendChild(titolo);
		
		const immagine = document.createElement('img');
		immagine.src = item.Immagine;
		immagine.addEventListener('click', dettagli);
		oggetto.appendChild(immagine);
		
        const codice=document.createElement('h3')
        codice.innerText = item.Codice;
        oggetto.appendChild(codice);
		
        const didascalia = document.createElement('article');
		didascalia.classList.add('hidden');
		oggetto.appendChild(didascalia);
		
		const nome = document.createElement('span');
		nome.innerText = item.Nome;
		didascalia.appendChild(nome);
		
		const genere = document.createElement('span');
		genere.innerText = item.Sezione;
		didascalia.appendChild(genere);
		
		const tipo = document.createElement('span');
		tipo.innerText = item.Reparto;
		didascalia.appendChild(tipo);
											
		//const taglia = document.createElement('span');
		//taglia.innerText = item.taglia;
		//didascalia.appendChild(taglia);
			
		const prezzo = document.createElement('span');
		prezzo.innerText = item.Prezzo;
		didascalia.appendChild(prezzo);
		
		const bottoneDettagli = document.createElement('button');
		bottoneDettagli.innerText = ' (Meno dettagli)';
		bottoneDettagli.addEventListener('click', riduciDescrizione);
		didascalia.appendChild(bottoneDettagli);
		
		const bottonePreferiti = document.createElement('button');
		bottonePreferiti.innerText = 'Aggiungi al carrello';
		bottonePreferiti.classList.add('bottone');
		bottonePreferiti.addEventListener('click', aggiungi);
		oggetto.appendChild(bottonePreferiti);
    }
}


