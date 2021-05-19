
//Immagine per l'header: API senza autenticazione: picsum.photos
const header = document.querySelector('header');

fetch("https://picsum.photos/2000/400").then(onResponse, onError);// /2000 indica la larghezza immagine, 400 l'altezza, rappresentano un buon compromesso

function onResponse(response){
    /*console.log(response);*/
    header.style.backgroundImage = "url("+response.url+")";
}
function onError(error){
    console.log(error);
    header.style.backgroundImage = "url(img.jpg)";
	header.style.backgroundSize = "cover";
}

//Immagini per le section: picsum.photos
const sections = document.querySelectorAll('section');

function ackImg(response){
	for(let i= 0; i<sections.length; i++){
		if(sections[i].style.backgroundImage == ''){
			sections[i].style.backgroundImage = "url("+response.url+")";
			sections[i].style.backgroundSize = "cover";
			break;
		}
	}
}
function nackImg(error){
	 console.log(error);
}

for(let i = 0; i< sections.length; i++){
	fetch("https://picsum.photos/800/400").then(ackImg, nackImg);
 }

//API senza autenticazione : Citazioni per gli articles: Personality -> Quotable Quotes
const quotes = document.querySelectorAll("blockquote p");
const cites = document.querySelectorAll("blockquote h3");

function ackQuote(response){
	return response.json();
}
function onQuote(json){
	 for(let i= 0; i<quotes.length; i++){
		if(quotes[i].textContent == ''){
			quotes[i].textContent = json.content;
			cites[i].textContent = json.author;
			break;
		}
	}
}

for(let i = 0; i< quotes.length; i++){
	fetch("https://api.quotable.io/random").then(ackQuote).then(onQuote);
 }
 