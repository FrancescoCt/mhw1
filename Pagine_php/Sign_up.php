<!DOCTYPE.html>
<pre>
<?php
	//Controllo che prima sia stata mandata la richiesta POST
	if(isset($_POST["cf_utente"]) && isset($_POST["pswd_utente"]) && strlen($_POST["cf_utente"])>0 && strlen($_POST["pswd_utente"])>5){
		if(strlen($_POST["nome_utente"])>0 && strlen($_POST["cognome_utente"])>0 && strlen($_POST["tel_utente"])>0 && strlen($_POST["nascita_utente"])>0){
			//Mi connetto al database 'magazzino'
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die ("Errore: ".mysqli_connect_error());

	//Escape del codice fiscale
	$cf = mysqli_real_escape_string($conn, $_POST['cf_utente']);

	//Preparazione Query
	$query = "SELECT cf, userPswd from cliente where cf = '".$cf."'";

	//Eseguo query
	$res = mysqli_query($conn, $query) or die ("Errore 1 : ".mysqli_connect_error());
	
	//Controllo il database: se non esiste una riga contenente il codice fiscale immesso allora posso aggiungere il nuovo cliente altrimenti da errore
	if($row = mysqli_num_rows($res) > 0 ){
			$errore = true;
		}
	//GESTISCO L'ELSE CON UN'ALTRA QUERY: inserisco il nuovo utente nel database
	else{
		$nome = mysqli_real_escape_string($conn, $_POST['nome_utente']);
		$cognome = mysqli_real_escape_string($conn, $_POST['cognome_utente']);
		$tel = mysqli_real_escape_string($conn, $_POST['tel_utente']);
		$nascita = mysqli_real_escape_string($conn, $_POST['nascita_utente']);
		$abbonamento = mysqli_real_escape_string($conn, $_POST['abbonamento_utente']);
		$password = mysqli_real_escape_string($conn, $_POST['pswd_utente']);
		
		//Gestisco la password: controllo che sia almeno di 5 caratteri e pongo il suo hash nella query d'inserimento
		
		$hashPassword = md5($password);
		
		$query1 = "insert into cliente values ('".$cf."','".$nome."', '".$cognome."','".$tel."','".$nascita."',(datediff(current_timestamp(),nascita )/365),'".$abbonamento."','".$hashPassword."')";
		$res1 = mysqli_query($conn, $query1) or die ("Errore 2 : ".mysqli_connect_error());
		
		header("Location: Login.php");
		}
		mysqli_close($conn);
	}
			
		}

	
	
	
	
?>
</pre>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sogno Italiano - Sign Up</title>
		<link rel="stylesheet" href= "../Fogli_di_stile/Login.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../Script_javascript/scriptLogin.js" defer> </script>
		<script src="../Script_javascript/validationSignup.js" defer> </script>
	</head>
	<body>
		<header>
			<h1>Sign Up</h1>
		</header>
		
		<nav>
			<a href="Home.php">Home</a>
			<a href="Login.php">Login</a>			
		</nav>
		
			<div id='credenziali'>
			<form action='Sign_up.php' method='post'>
				<label>Nome<input type='text' placeholder = 'Nome' name='nome_utente' ></label>
			<label>Cognome<input type='text' placeholder = 'Cognome' name='cognome_utente' ></label>
			<label>Codice fiscale <input type='text' placeholder = 'Codice Fiscale' name='cf_utente' ></label>
			<label>Telefono <input type='text' placeholder = '095 913215' name='tel_utente' ></label>
			<label>Data di nascita <input type='text' placeholder = '1980-01-01' name='nascita_utente'></label>
			<label>Password<input type='password' name='pswd_utente' ></label>
			<!-- La pagina del sign in deve valere solo per i clienti, gli impiegati vengono gestiti da un altro sistema, per semplicità facciamo finta che sono già stati inseriti-->
			<label>Abbonamento<select name='abbonamento_utente'>
						<option value='settimanale'>Settimanale</option>
						<option value='mensile'>Mensile</option>
						<option value='annuale'>Annuale</option>
					</select>
			
			</label>
			<label><input type='submit' name='invio' value='SignUp' ></label>
			
			</form>
			
		</div>
		
		<div class = "hidden">
			<p>Errore: uno dei requisiti non è stato soddisfatto</p>
		</div>
		
		<?php
		//Verifica la presenza di errori
			if(isset($errore)){
				echo "<p class='errore'>";
				echo "Credenziali non valide.\n";
				echo "Il codice fiscale è già registrato nel database ";
				echo "</p>";
			}
		?>
		<h2>Regole per la registrazione</h2>
		<p>
			<li>Tutti i campi devono essere riempiti affinchè il form sia compilato correttamente</li>
			<li>La password deve prevedere almeno 6 caratteri perchè il form sia compilato</li>
			<li>La password deve essere alfanumerica e contenere almeno un carattere speciale</li>
			<li>Se non ci sono errori verrai riportato alla pagina di login</li>
		</p>
		<p>Sei già registrato? <a href="Login.php">Clicca qui</a> per accedere.</p>
		
		<footer>
			<a href= "http://www.dieei.unict.it/corsi/l-8-inf"><img src="../Immagini/logoUNICT.jpg"/></a>
			<p>Francesco Catania O46002194, Corso di Web Programming, Ingegneria Informatica</p>
			<a href= "https://github.com/FrancescoCt"><img id='accountGithub' src="../Immagini/Github-Mark-32px.png"/></a>
		</footer>
	</body>
</html>