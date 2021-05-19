function validazione(event){
	console.log('validazione');
	
	//Leggo input
	/*Creo una lista dei valori di campi*/
	let lista = [];
	
	const nome = event.currentTarget.nome_utente.value;
	lista.push(nome);
	
	const cognome = event.currentTarget.cognome_utente.value;
	lista.push(cognome);
	
	const cf = event.currentTarget.cf_utente.value;
	lista.push(cf);
	
	const abbonamento = event.currentTarget.abbonamento_utente.value;
	lista.push(abbonamento);
	
	const tel = event.currentTarget.tel_utente.value;
	lista.push(tel);
	
	const nascita = event.currentTarget.nascita_utente.value;
	lista.push(nascita);
	
	const pswd = event.currentTarget.pswd_utente.value;
	//Verifica input non vuoto: se ne trova almeno uno non compilato ferma l'invio
	for(let i = 0; i<lista.length; i++){
			if(/[A-Za-z]+/.test(pswd) && /[0-9]+/.test(pswd) && /[^a-z0-9]+/i.test(pswd)){
				console.log("La password è alfanumerica con caratteri speciali");
				
			}else{
				const errore = document.querySelector('.hidden');
				console.log(errore);
				errore.classList.remove('hidden');
				event.preventDefault();
				break;
			}
			if(!lista[i]){
			console.log('Errore ',lista[i]);
			const errore = document.querySelector('.hidden');
			errore.classList.remove('hidden');
			event.preventDefault();
			
			break;
		}
	}
}

const form = document.querySelector('form');
form.addEventListener('submit', validazione);