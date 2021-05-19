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
		<title>Sogno Italiano - Home page</title>
		<link rel="stylesheet" href= "../Fogli_di_stile/Home.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../Script_javascript/contenutiHome.js" defer></script>
		<script src="../Script_javascript/scriptHome.js" defer> </script>
		
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
						<label><a href="#"><img src= "../Immagini/home.png" /></a></label> <!-- primo list-item, prima voce del menu -->
					<ul> <!-- Lista annidata: voci del sotto-menu -->
						<li><a href="#barra">Idee regalo</a></li>
						<li><a href="#annuncio">Offerte</a></li>
						<li><a href="#main">Chi siamo</a></li>
						<li><a href="#recapiti">Info e recapiti</a></li>
						<li><a href="#barraDatabase">I nostri fornitori</a></li>
					</ul> <!-- Fine del sotto-menu -->
					</li> <!-- Chiudo il list-item -->
					<!--qui altri list-item -->
					</div>
				<!--Fine menù a tendina-->
				<!--<a href="Home.php">Home</a>-->
				<a href="Concept.php">Concept</a>
				<a href="Login.php">Login</a>
				<a href="Logout.php">Logout</a>
			</nav>
			
		</header>
		<div id = "profile">
		<a href="Profilo.php"><img src= "../Immagini/account.jfif" /></a>
		<p>Benvenuto <?php echo /*$_COOKIE["nome"]*/$_SESSION["nome"]?> !</p>
		<p><?php echo date("d-m-Y"); ?></p>
		</div>
		
		
		<div id="preferiti">
				<h1 class = "hidden">I tuoi preferiti</h1>
				<div class = "wrapper"></div>
				<div class = "wrapper"></div><!---->
		</div>
		
		<div id="barra">
			<h1>Cerchi una idea regalo?</h1>
			Cerca prodotto o reparto in pagina : <input type="text" placeholder = 'Cerca'/>
		</div>
		<!--<div id="filtrati"></div>-->
		
		<section>
			 <a class= "button" href="Galleria.php">Galleria</a>
			
			<div class="divisore">
				<div class='overlay'></div>
			</div>
		
			<div class="riga" >
				<div id="annuncio">
					<h2>Occasioni!</h2>
					<img src= "../Immagini/fumettoDonna.jpg" /><!---->
					<h3>I 5 prodotti più richiesti della settimana!</h3>
					<p>
						<ol>
							<li><a href="Galleria.php">T-shirt rosso ragazzo</a></li>
							<li><a href="Galleria.php">Felpa verde col cappuccio</a></li>
							<li><a href="Galleria.php">Pigiama bambino</a></li>
							<li><a href="Galleria.php">Camicia uomo a quadri</a></li>
							<li><a href="Galleria.php">Giubbotto da neve</a></li>
						</ol>
					</p>
					
				</div>
				
				<div id="main">
					<h1>Chi siamo </h1>
					<p>
						Nata nel 1998, <em>Sogno Italiano</em> è divenuta nel tempo un solido punto di riferimento del <em>fashion retail</em>. 
						L'approccio estremamente dinamico al business e il design innovativo 
						hanno permesso di conquistare la <strong>fiducia</strong> dei consumatori, ottenendo sviluppi importanti 
						sia a livello di fatturato, sia in termini di store aperti.
						Grazie a questa formula <em>Sogno Italiano</em> ha incrementato la sua presenza 
						sul territorio nazionale, sia diretto sia tramite franchising, per poi estendere lo sviluppo 
						anche ai mercati internazionali.
						La <a href="../mhw3.html">mission aziendale</a> si fonda sull'<strong>affermazione dello stile italiano</strong> 
						e su di una nuova interpretazione dello shopping incentrata sul rinnovo costante, 
						puntando su collezioni di qualità a prezzi competitivi. 
						Per saperne di più sulle nostre <strong>scontistiche</strong> clicca sul link:
						<a href="Scontistiche.html">leggi di più</a>.
					</p>
					<img src= "../Immagini/design.jpg" />
				</div>
				
				<div id= "recapiti">
					<img src= "../Immagini/cataniaPanoramica.jfif" />
					<h2>Dove trovarci </h2>
					<ul>
						<li><a href="https://www.google.com/maps/d/viewer?mid=1OlTya0Ua_PwYoaKAVLXY8GK4V2s&ie=UTF8&hl=it&msa=0&z=12&ll=45.4724327890074%2C9.227562282485987">Milano</a>: CAP 90459</li>
						<li><a href="https://www.google.com/maps/place/Catania+CT/@37.5154183,15.075472,13.35z/data=!4m5!3m4!1s0x1313e2dd761525b5:0x58fe876151c83cf0!8m2!3d37.5078772!4d15.0830304">Firenze</a>: CAP 27384</li>
						<li><a href="https://www.google.com/maps/d/viewer?mid=1OlTya0Ua_PwYoaKAVLXY8GK4V2s&ie=UTF8&hl=it&msa=0&z=12&ll=45.4724327890074%2C9.227562282485987">Roma</a>: CAP 61479</li>
						<li><a href="https://www.google.com/maps/place/Catania+CT/@37.5154183,15.075472,13.35z/data=!4m5!3m4!1s0x1313e2dd761525b5:0x58fe876151c83cf0!8m2!3d37.5078772!4d15.0830304">Catania</a>: CAP 91748</li>
					</ul>
					
					<h2>Come Contattarci </h2>
					<ul>
						<li>Sede Milano: 244534554</li>
						<li>Sede Roma: 327469993</li>
						<li>Sede Firenze: 277734554</li>
						<li>Sede Catania: 367466556</li>
					</ul>
					
					<h2>Seguici sui social </h2>
					<ul>
						<li><a href="https://www.instagram.com/">Instagram </a> </li>
						<li><a href="https://it-it.facebook.com/">Facebook</a> </li>
					</ul>
					
				</div>
				
			</div>
			<a class= "button" href="Reparti.php">Vai ai reparti</a>
			<div class="divisore">
				<div class='overlay'></div>
				
			</div>
			
			
			<div class="riga">
				<div class="lista">
					<img src= "../Immagini/grucce1.jfif" />
					<h3>I nostri reparti </h3>
					<ul>
						<li>Uomo</li>
						<li>Donna</li>
						<li>Bambino</li>
						<li>Ragazzi</li>
						<li><a href="Reparti.php">Vedi di più</a></li>
					</ul>
					
				</div>
				
				<div class="lista">
					<img src= "../Immagini/shopping.jpg" />
					<h3>I nostri prodotti </h3>
					<ul>
						<li>Maglietta</li>
						<li>Felpa</li>
						<li>Pigiama</li>
						<li>Giubotto</li>
						<li><a href="Galleria.php">Vedi di più</a></li>
					</ul>
					
				</div>
				
				<div class="lista">
					<img src= "../Immagini/grucce.jpg" />
					<h3>Le nostre marche </h3>	<!-- Sezione lista-->
					<ul>
						<li>Vero Style s.r.l</li>
						<li>Double A</li>
						<li>Tech by Tex</li>
						<li><a href="Galleria.php">Vedi di più</a></li>
					</ul>
					
				</div>
			</div>
			
		</section>
		
		<!--Se non funziona intervieni qui-->
		
		<div id="barraDatabase">
			<h1>Cerchi una marca particolare?</h1>
			<form method = 'post'>
				
				<label>Dai un'occhiata ad alcuni dei nostri fornitori:  <input type="text" placeholder = 'Cerca' name = 'stringa'/></label>
				
			</form>
			
		</div>
			
			
		
		
		<footer>
			<a href= "http://www.dieei.unict.it/corsi/l-8-inf"><img src="../Immagini/logoUNICT.jpg"/></a>
			<p>Francesco Catania O46002194, Corso di Web Programming, Ingegneria Informatica</p>
			<!---->
				<a href= "https://github.com/FrancescoCt"><img id='accountGithub' src="../Immagini/Github-Mark-32px.png"/></a>
			<!---->
		</footer>
	</body>
</html>