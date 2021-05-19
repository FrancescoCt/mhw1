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
?>
<html>
	<head>
		<title>Sogno Italiano - Galleria</title>
		<link rel="stylesheet" href= "../Fogli_di_stile/Galleria.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../Script_javascript/contenutiGalleria.js" defer> </script>
		<script src="../Script_javascript/Galleria.js" defer> </script>
		<script src="../Script_javascript/Carrello.js" defer> </script>
		
	</head>
	<body>
		<header>
			<div class='overlay'>
				<div id="titolo">Sogno Italiano</div>
			</div>
			
			<nav>
				<!--Menù a tendina per gli elementi in pagina-->
				<div id="hormenu"><!-- div che contiene il menu -->
					<ul> <!-- lista principale: definisce il menu nella sua interezza -->
					<li>
						<a href="#"><img src= "../Immagini/shop.png" /></a> <!-- primo list-item, prima voce del menu -->
					<ul> <!-- Lista annidata: voci del sotto-menu -->
						<li><a href="#barra">Idee regalo</a></li>
						<li><a href="#preferiti">Il tuo carrello</a></li>
						<li><a href="#formElement">Procedi all'acquisto</a></li>
						
					</ul> <!-- Fine del sotto-menu -->
					</li> <!-- Chiudo il list-item -->
					<!--qui altri list-item -->
					</div>
				<!--Fine menù a tendina-->
				<a href="Home.php">Home</a>
				<a href="Login.php">Login</a>
				<a href="Logout.php">Logout</a>
			</nav>
		</header>

			<p>Ciao <?php echo $_SESSION["nome"]?>, ti presentiamo la nostra collezione!</p>
			<p><?php echo date("d-m-Y"); ?></p>
		
			<div id="preferiti">
				<h1 class = "hidden">Il tuo carrello</h1>
				<div id = "separatore"></div>
			</div>
			
			<div id="barra">
			<h1>Cerchi una idea regalo?</h1>
			Cerca prodotto in galleria : <input type="text" placeholder = 'Cerca'/>
			</div>
		<!--<div id="filtrati"></div>-->
		
		
		<section>
			
		</section>	
		
		<h1>Procedere all'acquisto?</h1>
				<form id='formElement' action='Profilo.php' method = 'post' >
				<label>Confermo le scelte fatte, procedi con l'acquisto</label>
				<label><input type='submit' name='invio' value='Vai' ></label>
				</form>
		
		<footer>
			<a href= "http://www.dieei.unict.it/corsi/l-8-inf"><img src="../Immagini/logoUNICT.jpg"/></a>
			<p>Francesco Catania O46002194, Corso di Web Programming, Ingegneria Informatica</p>
			<!---->
				<a href= "https://github.com/FrancescoCt"><img id='accountGithub' src="../Immagini/Github-Mark-32px.png"/></a>
			<!---->
		</footer>
		
	</body>
</html>