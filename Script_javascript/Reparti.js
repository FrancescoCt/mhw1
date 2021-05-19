let N = 100;

//Funzione per rendere visibile la descrizione dell'immagine al click
function dettagli(event){
	const articles = document.querySelectorAll('.oggetto article');
	const image = event.currentTarget;
	const images = document.querySelectorAll('.oggetto img');
	 
	for(let i = 0; i<N; i++){
		if(image == images[i]){ 											//trovo l'indice dell'immagine che mi interessa
			articles[i].classList.remove('hidden');							//articles prende tutti gli articoli ma devo concentrarmi su quelli all'interno del divisore
			break;
		} 
	}
}

//Funzione per aggiungere l'oggetto nella sezione Preferiti

function aggiungi(event){
	const tasto = event.currentTarget;
	const tasti = document.querySelectorAll('.bottone');
	const titoli = document.querySelectorAll('.oggetto h2');
	const articles = document.querySelectorAll('.oggetto article');
	const codici = document.querySelectorAll('.oggetto h3');
	const images = document.querySelectorAll('.oggetto img');
	tasto.removeEventListener('click', aggiungi);
	
	const titoloPreferiti = document.querySelector('#preferiti h1');
	titoloPreferiti.classList.remove('hidden');							//Rendo visibile il titolo della sezione preferiti
	
	const preferiti = document.querySelector('#separatore');
	const preferenze = document.querySelectorAll('.oggetto div');

		
	for(let i = 0; i<N; i++){
		
		if(tasto == tasti[i]){ 
				
			preferenze[i].classList.remove('hidden');
			const oggetto = document.createElement('div'); 
			
			oggetto.classList.add('elemento');
			preferiti.appendChild(oggetto);
			
			const titolo = document.createElement('h2');
			titolo.innerText = titoli[i].innerText;
			oggetto.appendChild(titolo);
			
			const immagine=document.createElement('img');
			immagine.src = images[i].src;
			oggetto.appendChild(immagine);
				
			const codice=document.createElement('h3');
			codice.textContent = codici[i].textContent;
			oggetto.appendChild(codice);
		
			const didascalia = document.createElement('article');
			//Metto nella didascalia tutti gli span tranne il bottone "Meno dettagli" sennò compare la scritta
			let stringa = '';
			
			if(event.currentTarget.parentNode.childNodes[4].childNodes[2] != undefined){//Script home js calibrato per i reparti
				for(let i = 0; i<2;i++){
					stringa = stringa+ " "+event.currentTarget.parentNode.childNodes[4].childNodes[i].textContent;
				}
				
			}
			didascalia.textContent = stringa;
			//Fine modifica
			oggetto.appendChild(didascalia);
	
			const rimuovi = document.createElement('button');
			rimuovi.textContent = 'Rimuovi dai preferiti';
			rimuovi.addEventListener('click', rimozione);
			oggetto.appendChild(rimuovi);
			
			
			//Parte nuova: aggiungo al database i preferiti
			const dati = new FormData();
			dati.append('immagine', immagine.src);
			fetch("../Pagine_php/aggiungiPreferiti.php", {method: 'post', body: dati}).then(onInvio).then(onConferma);
			//Fine parte nuova
			break;
			
			} 
		}
}

//Funzioni per conferma aggiunta al database
function onInvio(response){
	return response.text();
}
function onConferma(json){
	console.log(json);
}
///

function riduciDescrizione(event){
	const tasto = event.currentTarget;
	const articles = document.querySelectorAll('.oggetto article');
	const riduci = document.querySelectorAll('article button');
	
													//la lista dei tasti che ci interessa è 'riduci', mi serve l'indice del tasto per poter mettere hidden alla classe
	for(let i = 0; i<N; i++){						//ricordo che N è il numero di immagini preso dalla nodelist images;
		if(tasto == riduci[i]){
			articles[i].classList.add('hidden');	//ricordo che articles è la nodelist degli articoli presenti nei divisori;
		}
	}
}


function rimozione(event){
	
	const titoloPreferiti = document.querySelector('#preferiti h1');
	
	const immaginiDiv = document.querySelectorAll('.oggetto img');
	console.log(event.currentTarget.parentNode.childNodes[1].src);//immagine elemento
	console.log(event.currentTarget.parentNode); //elemento
	console.log(event.currentTarget.parentNode.childNodes[2]);
	
	const elemento = event.currentTarget.parentNode;
	const imgSrc = event.currentTarget.parentNode.childNodes[1].src;

	for(let i = 0; i<N; i++){
		if(immaginiDiv[i] != undefined && immaginiDiv[i].src == imgSrc){
			console.log("entrato nell'if");
			immaginiDiv[i].parentNode.childNodes[0].classList.add('hidden');
			console.log(immaginiDiv[i].parentNode.childNodes[0]);
			
			immaginiDiv[i].parentNode.childNodes[5].addEventListener('click', aggiungi);
			console.log(immaginiDiv[i].parentNode.childNodes[5]);
			elemento.remove();
			const dati = new FormData();
			dati.append('rimuovi', imgSrc);
			fetch("../Pagine_php/rimuoviPreferiti.php", {method: 'post', body: dati}).then(onRimuovi).then(onConferma1);
		}else {
			console.log("entrato nell'else");
			elemento.remove();
			const dati = new FormData();
			dati.append('rimuovi', imgSrc);
			fetch("../Pagine_php/rimuoviPreferiti.php", {method: 'post', body: dati}).then(onRimuovi).then(onConferma1);
		}
	}
	//Ad ogni rimozione eseguo una conta degli elementi presenti nella sezione preferiti
	//se la conta è uguale a 0 la sezione è vuota e posso oscurare il titolo
	const verificaElementi = document.querySelectorAll('.elemento');
	let contaElementi = 0;
	for(let item of verificaElementi){
		contaElementi++;
	}
	if(contaElementi == 0){
		titoloPreferiti.classList.add('hidden');
	}
}

//Funzioni controllo riuscita cancellazione
function onRimuovi(response){
	return response.text();
}
function onConferma1(json){
	console.log(json);
}
//////////////////////////////////////////////////////////////////
//Funzione caricamento dei contenuti dei preferiti (richiesta al database per i preferiti)

function caricaPreferiti(){
	//Chiedo il json su cui lavorare al database
	fetch("../Pagine_php/caricaPreferiti.php").then(onLoadPref).then(onConferma2);
			
}

//Funzioni gestione caricamento
function onLoadPref(response){
	return response.json();
}
function onConferma2(json){
	console.log(json);
	for(let item of json){
		const preferiti = document.querySelector('#preferiti');
		const oggetto = document.createElement('div'); 
				
		oggetto.classList.add('elemento');
		preferiti.appendChild(oggetto);
		
		//Mi assicuro che compaia il titolo al caricamento dei preferiti;
		const titoloPreferiti = document.querySelector('#preferiti h1');
		titoloPreferiti.classList.remove('hidden');
		
		//Dichiarazione variabili
		const titolo = document.createElement('h2');
		const immagine = document.createElement('img');
		const didascalia = document.createElement('article');
		const rimuovi = document.createElement('button');
			
			
			
		
		//Contenuti
		immagine.src = item['Immagine'];
		titolo.textContent = 'Preferito';	//Ci devo mettere la parte di stringa della source immagine
		didascalia.textContent = item['Giorno']+', '+item['Ora'];
		rimuovi.textContent = 'Rimuovi dai preferiti';
		rimuovi.addEventListener('click', rimozione);
		//Append
		oggetto.appendChild(titolo);
		oggetto.appendChild(immagine);
		oggetto.appendChild(didascalia);
		oggetto.appendChild(rimuovi);
		
		//Controllo che siano bloccati i pulsanti di aggiungi ai preferiti e gli elementi abbiano le stelle sopra
		const imgDiv = document.querySelectorAll('.oggetto img');
		
		
		for(let i = 0; i<N; i++){
			if(imgDiv[i] != undefined && imgDiv[i].src == immagine.src){
				imgDiv[i].parentNode.childNodes[0].classList.remove('hidden');
				imgDiv[i].parentNode.childNodes[5].removeEventListener('click', aggiungi);
			}
		}
	}
}

caricaPreferiti();
//////////////////////////////////////////////////////////////////

//FUNZIONE BARRA DI RICERCA
function filtra(event){
	const oggetti = document.querySelectorAll('.oggetto');
	
	const searchString=event.currentTarget.value.toLowerCase();
	const trovati = document.querySelectorAll('.cercato');
	const corpo = document.querySelector('body');
	const primaSezione = document.querySelector('section');
	
	//La sezione filtrati di mio interesse viene creata in maniera dinamica ogni volta che si interagisce con la barra di ricerca
	const sezFiltrati = document.createElement('div');
	sezFiltrati.classList.add('filtrati');
	corpo.insertBefore(sezFiltrati, primaSezione);
    	
		for(let obj of oggetti){
			
			//Ricerca degli elementi: appena si trova un abbinamento con un oggetto del divisore viene creato un div di classe 'cercato' che viene posizionato nella sezione filtrati tramite appendChild
			
			if(obj.childNodes[4].innerText.toLowerCase().includes(searchString)){

				
				const oggetto1 = document.createElement('div'); 
				oggetto1.classList.add('cercato');
				sezFiltrati.appendChild(oggetto1);
				
				const titolo = document.createElement('h2'); 
				titolo.innerText = obj.childNodes[1].innerText;
				oggetto1.appendChild(titolo);
			
				const immagine1 = document.createElement('img');
				immagine1.src = obj.childNodes[2].src;
				oggetto1.appendChild(immagine1);
				
				const codice1 = document.createElement('h3');
				codice1.textContent = obj.childNodes[3].textContent;
				oggetto1.appendChild(codice1);
		
				const didascalia1 = document.createElement('article');
				
				didascalia1.textContent = obj.childNodes[4].textContent;
				oggetto1.appendChild(didascalia1);
				
				//In pratica ad ogni lettera aggiunta nella barra di ricerca si crea un nuovo div classe filtrati,
				//l'idea è quello di rimuovere simultaneamente il primo div alla battitura della seconda lettera
				//in quanto produrrebbe nuovi risultati più specifici
				const filtraggio = document.querySelectorAll('.filtrati');	//seleziono tutti i div filtrati
				console.log(filtraggio);
				let conta = 0;												//con questa variabile conto il numero di elmenti
				for(let item of filtraggio){								
					conta++;
					console.log(conta);
				}
				if(conta > 1){												//se la conta è maggiore di uno elmina il primo elemento della nodelist, in questo modo sembrerà un aggiornamento istantaneo (il for fa il break appena arriva al primo termine infatti)
					for(let item of filtraggio){
						item.remove();
						conta--;
						break;
					}
				}
			}

		}
		if(searchString == ''){
			const filtraggio = document.querySelectorAll('.filtrati');
			console.log('Stringa vuota');
			for(let item of filtraggio){
				
						item.remove();
			}
		}
}

const search=document.querySelector('input');
search.addEventListener('keyup', filtra);