
//Immagine per l'header: API senza autenticazione: picsum.photos
const header = document.querySelector('header');

fetch("https://picsum.photos/2000/400").then(onResponse1, onError1);// /2000 indica la larghezza immagine, 400 l'altezza, rappresentano un buon compromesso

function onResponse1(response){
    console.log(response);
    header.style.backgroundImage = "url("+response.url+")";
}
function onError1(error){
    console.log(error);
    header.style.backgroundImage = "url(img.jpg)";
	header.style.backgroundSize = "cover";
}

 
//Funzione per aggiornare il div con id = 'carrello' caricando i contenuti json degli acquisti effettuati

fetch("../Pagine_php/fetchAcquisti.php").then(onResponse).then(onJson);

function onResponse(response){
	console.log(response);
	return response.json();
}
function onJson(json){
    console.log(json);
	const sezione = document.querySelector('#carrello');	
	
	for(let item of json){
		
        const oggetto=document.createElement('div');
        oggetto.classList.add('oggetto');
		sezione.appendChild(oggetto);
		
		const titolo = document.createElement('h2');
		titolo.innerText = item.Reparto;
		oggetto.appendChild(titolo);
		
		const immagine = document.createElement('img');
		immagine.src = item.Immagine;
		oggetto.appendChild(immagine);
		
        const codice=document.createElement('h3')
        codice.innerText = item.Codice;
        oggetto.appendChild(codice);
		
        const didascalia = document.createElement('article');
		oggetto.appendChild(didascalia);
		
		const nome = document.createElement('span');
		nome.innerText = item.Nome;
		didascalia.appendChild(nome);
		
		const tipo = document.createElement('span');
		tipo.innerText = item.Reparto;
		didascalia.appendChild(tipo);
													
		const prezzo = document.createElement('span');
		prezzo.innerText = item.Prezzo+"$";
		didascalia.appendChild(prezzo);
		
		const giorno = document.createElement('span');
		giorno.innerText = item.Giorno;
		didascalia.appendChild(giorno);
		
		const ora = document.createElement('span');
		ora.innerText = item.Ora;
		didascalia.appendChild(ora);

    }
}
//RECUPERO CREDENZIALI UTENTE DAL DATABASE

fetch("../Pagine_php/fetchCredenziali.php").then(onResponseCr).then(onJsonCr);
function onResponseCr(response){
	console.log(response);
	return response.json();
}
function onJsonCr(json){
console.log(json);
const credenziali = document.querySelectorAll('#modifiche span');
console.log(credenziali);
credenziali[0].innerText = json[0].Nome;
credenziali[1].innerText = json[0].Cognome;
credenziali[2].innerText = json[0].Codice_Fiscale;
credenziali[3].innerText = json[0].Telefono;
credenziali[4].innerText = json[0].Nascita;
credenziali[5].innerText = json[0].Abbonamento;
credenziali[6].innerText = json[0].Spesa;
}

//Implementare il bottone che cancella le credenziali utente dal database e reindirizza al signup
//Nel signup serve il password hash o password verify



function modifica(event){
	const pulsante = event.currentTarget;
	
	//event.preventDefault();
	const data = {method: 'post', body: new FormData(form)};
	
	fetch("../Pagine_php/verificaPassword.php", data).then(onRes).then(onText);//
	//Questa fetch restituisce la password dell'utente, se corrisponde a quella immessa allora si procede all'eliminazione
}

function onRes(response){
	console.log(response);
	return response.text();
}
function onText(json){
	console.log(json);
}/**/
const form = document.querySelector('form');
form.addEventListener('submit', modifica);
