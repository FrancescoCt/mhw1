function validazione(event){
	console.log('validazione');
	//Leggo input
	const nome = event.currentTarget.cf_utente.value;
	const pswd = event.currentTarget.pswd_utente.value;
	console.log(nome);
	console.log(pswd);
	//Verifica input non vuoto
	if(nome == '' || pswd == ''){
		console.log('Errore');
		const errore = document.querySelector('.hidden');
		errore.classList.remove('hidden');
		event.preventDefault();
	}
	if(/[A-Za-z]+/.test(pswd) && /[0-9]+/.test(pswd) && /[^a-z0-9]+/i.test(pswd)){
				console.log("La password è alfanumerica con caratteri speciali");
				
	}else{
		const errore = document.querySelector('.hidden');
		console.log(errore);
		errore.classList.remove('hidden');
		event.preventDefault();
	}
}

const form = document.querySelector('form');
console.log(form);
form.addEventListener('submit', validazione);