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
		<title>Sogno Italiano - Reparti</title>
		<link rel="stylesheet" href= "../Fogli_di_stile/Galleria.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../Script_javascript/contenutiReparti.js" defer></script>
		<script src="../Script_javascript/Reparti.js" defer> </script>
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
						<a href="#"><img src= "../Immagini/white_heart.png" /></a> <!-- primo list-item, prima voce del menu -->
					<ul> <!-- Lista annidata: voci del sotto-menu -->
						<li><a href="#barra">Cerca reparti</a></li>
						<li><a href="#preferiti">I preferiti</a></li>
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

			<p>Ciao <?php echo $_SESSION["nome"]?>, ti presentiamo i nostri reparti!</p>
			<p><?php echo date("d-m-Y"); ?></p>
		
			<div id="preferiti">
				<h1 class = "hidden">I tuoi preferiti</h1>
				<div id = "separatore"></div>
				<!--Il numero di divisori in sezione deve essere uguale al numero di wrapper in #filtrati-->
			</div>
			
			<div id="barra">
			<h1>Cerchi un reparto?</h1>
			Trova reparto in galleria : <input type="text" placeholder = 'Cerca'/>
			</div>
		<!--<div id="filtrati"></div>-->
		
		<section>
		</section>	
		
		
		
		<footer>
			<a href= "http://www.dieei.unict.it/corsi/l-8-inf"><img src="../Immagini/logoUNICT.jpg"/></a>
			<p>Francesco Catania O46002194, Corso di Web Programming, Ingegneria Informatica</p>
			<!---->
				<a href= "https://github.com/FrancescoCt"><img id='accountGithub' src="../Immagini/Github-Mark-32px.png"/></a>
			<!---->
		</footer>
		
	</body>
</html>