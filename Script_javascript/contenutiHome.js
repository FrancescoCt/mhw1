
fetch("../Pagine_php/fetchVetrina.php").then(onResponse).then(onJson);

function onResponse(response){
	return response.json();
}
function onJson(json){
	
	const divisori = document.querySelectorAll('.overlay'); //Nota: devo tener conto del fatto che gli overlay sono 3 e i divisori sono 2 per cui nella nodelist gli indici sono 1 e 2

	let conta = 0; 	
	
	for(let item of json){
		
        const oggetto=document.createElement('div');
        oggetto.classList.add('oggetto');
		//sezione.appendChild(oggetto);
		
		const stella = document.createElement('div');
		stella.classList.add('hidden');
		oggetto.appendChild(stella);
		
		const titolo = document.createElement('h2');
		titolo.innerText = item.titolo;
		oggetto.appendChild(titolo);
		
		const immagine = document.createElement('img');
		immagine.src = item.immagine;
		immagine.addEventListener('click', dettagli);
		oggetto.appendChild(immagine);
		
        const codice=document.createElement('h3')
        codice.innerText = item.codice;
        oggetto.appendChild(codice);
		
        const didascalia = document.createElement('article');
		didascalia.classList.add('hidden');
		oggetto.appendChild(didascalia);
		
		const nome = document.createElement('span');
		nome.innerText = item.nome;
		didascalia.appendChild(nome);
		
		const genere = document.createElement('span');
		genere.innerText = item.genere;
		didascalia.appendChild(genere);
		
		const tipo = document.createElement('span');
		tipo.innerText = item.titolo;
		didascalia.appendChild(tipo);
		
		//Divisione
		if(conta < 4){										//I prodotti hanno più proprietà rispetto ai reparti, la conta mi serve a capire anche dove mettere le proprietà in più
			const taglia = document.createElement('span');
			taglia.innerText = item.taglia;
			didascalia.appendChild(taglia);
			
			const prezzo = document.createElement('span');
			prezzo.innerText = item.prezzo;
			didascalia.appendChild(prezzo);
		}
		if(conta >= 4){
			const indirizzo = document.createElement('span');
			indirizzo.innerText = item.indirizzo;
			didascalia.appendChild(indirizzo);
		}
		
		const bottoneDettagli = document.createElement('button');
		bottoneDettagli.innerText = ' (Meno dettagli)';
		bottoneDettagli.addEventListener('click', riduciDescrizione);
		didascalia.appendChild(bottoneDettagli);
		
		const bottonePreferiti = document.createElement('button');
		bottonePreferiti.innerText = 'Aggiungi ai preferiti';
		bottonePreferiti.classList.add('bottone');
		bottonePreferiti.addEventListener('click', aggiungi);
		oggetto.appendChild(bottonePreferiti);
		if(conta < 4){										//Dopo che tutti gli elementi sono in posizione li ripartisco sugli overlay dei rispettivi divisori
			divisori[1].appendChild(oggetto);
		}else {divisori[2].appendChild(oggetto);}
		
		conta++;  
    }
}


