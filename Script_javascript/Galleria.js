//let N = 10;
//Funzione per rendere visibile la descrizione dell'immagine al click
function dettagli(event){
	const articles = document.querySelectorAll('.oggetto article');
	const images = document.querySelectorAll('.oggetto img')
	const image = event.currentTarget;
	
	//conta
	let N = 0;
	for(let item in images){
		N++;
	}
	//fine conta
	
	for(let i = 0; i<N; i++){
		if(image == images[i]){ 											//trovo l'indice dell'immagine che mi interessa
			//console.log(articles[i]);
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
	const immagini = document.querySelectorAll('.oggetto img');
	const codiciProd = document.querySelectorAll('.oggetto h3');
	const articles = document.querySelectorAll('.oggetto article');
	
	tasto.removeEventListener('click', aggiungi);
	
	const titoloPreferiti = document.querySelector('#preferiti h1');
	titoloPreferiti.classList.remove('hidden');							//Rendo visibile il titolo della sezione preferiti
	
	const preferiti = document.querySelector('#separatore');
	const preferenze = document.querySelectorAll('.oggetto div');
	
	//conta
	let N = 0;
	for(let item in immagini){
		N++;
	}
	//fine conta
	
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
			immagine.src = immagini[i].src;
			oggetto.appendChild(immagine);
				
			const codice=document.createElement('h3');
			codice.textContent = codiciProd[i].textContent;
			oggetto.appendChild(codice);
		
			const didascalia = document.createElement('article');
			
			//Metto nella didascalia tutti gli span tranne il bottone "Meno dettagli" sennò compare la scritta
			let stringa = '';
			
			if(event.currentTarget.parentNode.childNodes[4].childNodes[4] != undefined){//Script home js calibrato per i reparti
				for(let i = 0; i<4;i++){
					stringa = stringa+ " "+event.currentTarget.parentNode.childNodes[4].childNodes[i].textContent;
				}
				
			}
			didascalia.textContent = stringa;
			//Fine modifica
			
			oggetto.appendChild(didascalia);
	
			const rimuovi = document.createElement('button');
			rimuovi.textContent = 'Rimuovi dal carrello';
			rimuovi.addEventListener('click', rimozione);
			oggetto.appendChild(rimuovi);
			break;
			
			} 
		}
}
//Funzione per rimuovere i preferiti da apposito pulsante
function riduciDescrizione(event){
	console.log("Toccato1");
	const tasto = event.currentTarget;
	const articles = document.querySelectorAll('.oggetto article');
	const riduci = document.querySelectorAll('article button');
	console.log(riduci);
	
	//conta
	let N = 0;
	for(let item in riduci){
		N++;
	}
	//fine conta
													//la lista dei tasti che ci interessa è 'riduci', mi serve l'indice del tasto per poter mettere hidden alla classe
	for(let i = 0; i<N; i++){						//ricordo che N è il numero di immagini preso dalla nodelist images;
		if(tasto == riduci[i]){
			articles[i].classList.add('hidden');	//ricordo che articles è la nodelist degli articoli presenti nei divisori;
		}
	}
}
function rimozione(event){
	
	const tasto = event.currentTarget;
	const tasti = document.querySelectorAll('.elemento button');
	const elementi = document.querySelectorAll('.elemento');
	const titoloPreferiti = document.querySelector('#preferiti h1');
	const preferenze = document.querySelectorAll('.oggetto div');
	
	const pulsante = document.querySelectorAll('.bottone');
	
	
	const codPref = document.querySelectorAll('.elemento h3');
	
	let cod = 0;
	
	//conta
	let N = 0;
	for(let item in tasti){
		N++;
	}
	//fine conta
	
	for(let i =0; i<N; i++){
		if(tasto == tasti[i]){							//trovo l'indice appartenente al tasto (so che corrisponde a quello dell'elemento)
			console.log('codPref[i] ',codPref[i]);		//verifica
			elementi[i].remove();						//rimuovo dalla sezione preferiti
			cod = codPref[i].textContent;				//leggo il codice che mi serve per oscurare la stellina nel divisore
			preferenze[cod-1].classList.add('hidden');	//quando cerco l'elemento mi ricordo che il codice assegnato è l'indice array + 1
			pulsante[cod-1].addEventListener('click', aggiungi);
			
			break;
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


//BARRA DI RICERCA
const oggetti = document.querySelectorAll('.oggetto');
const search=document.querySelector('input');
search.addEventListener('keyup', filtra);
