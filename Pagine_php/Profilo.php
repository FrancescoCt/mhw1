<!DOCTYPE.html>
<?php
	//Avvia la sessione
	session_start();
	//Controllo se l'utente è loggato
	if(!isset($_SESSION['utente'])){
		//Vai al login
		header("Location: Login.php");
		exit;
	}
	//Ricevo i dati dalla pagina Galleria.php (elaborati da Carrello.php), devo trattarli qui.
	
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sogno Italiano - Profilo</title>
		<link rel="stylesheet" href= "../Fogli_di_stile/Profilo.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../Script_javascript/Profilo.js" defer> </script>
	</head>
	
	<body>
		<header>
			<h1>Profilo utente</h1>
		</header>
		
		<nav>
			<!--Menù a tendina per gli elementi in pagina-->
				<div id="hormenu"><!-- div che contiene il menu -->
					<ul> <!-- lista principale: definisce il menu nella sua interezza -->
					<li>
						<a href="#"><img src= "../Immagini/home.png" /></a> <!-- primo list-item, prima voce del menu -->
					<ul> <!-- Lista annidata: voci del sotto-menu -->
						<li><a href="#carrello">I miei acquisti</a></li>
						<li><a href="#modifiche">Credenziali</a></li>
						<li><a href="#elimina">Cancella account</a></li>
					</ul> <!-- Fine del sotto-menu -->
					</li> <!-- Chiudo il list-item -->
					<!--qui altri list-item -->
					</div>
				<!--Fine menù a tendina-->
			<a href="Home.php">Home</a>
			<a href="Logout.php">Logout</a><!---->
		</nav>
		
		<div id = "profile">
		<a href="Home.php"><img src= "../Immagini/account.jfif" /></a>
		<p>Benvenuto <?php echo /*$_COOKIE["nome"]*/$_SESSION["nome"]?> !</p>
		<p><?php echo date("d-m-Y"); ?></p>
		</div>
		
		<section class = "hidden">
			<h1>I miei acquisti</h1>
			<div id= "carrello">
				
			</div>
		</section>
		<div id= "modifiche">
			<h2>Ciao utente, i dati inseriti sono corretti?</h2>
			<p>
				<label>Nome: <span></span></label>
				<label>Cognome: <span></span></label>
				<label>Codice Fiscale: <span></span></label>
				<label>Telefono: <span></span></label>
				<label>Data di nascita: <span></span></label>
				<label>Abbonamento: <span></span></label>
				<label>Totale spesa: <span></span></label>
				
			</p>
			
			<h2>Modifica dati utente</h2>
			<form id= 'elimina' method='post' <!--action='Sign_up.php'-->
				<p>
					Se i dati non sono corretti inserisci la password per la rimozione account
					
				
				</p>
				<label><input type='password' name='pswd' value='Password'></label>
				<label><input type='submit' name='invio' value='Cancella' ></label>
			</form>
		</div>
		
		<div><?php
			
		?></div>
		
		<footer>
			<a href= "http://www.dieei.unict.it/corsi/l-8-inf"><img src="../Immagini/logoUNICT.jpg"/></a>
			<p>Francesco Catania O46002194, Corso di Web Programming, Ingegneria Informatica</p>
			<a href= "https://github.com/FrancescoCt"><img id='accountGithub' src="../Immagini/Github-Mark-32px.png"/></a>
		</footer>
	</body>
</html>