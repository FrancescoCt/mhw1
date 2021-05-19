<!DOCTYPE.html>

<?php
	//Avvia la sessione
	session_start();
	//Verifico l'accesso
	if(isset($_SESSION["utente"])){
		//Vai alla home
		header("Location: Home.php");
		exit;
	}

	//Verifico l'esistenza di dati Post
	if(isset($_POST["cf_utente"]) && isset($_POST["pswd_utente"]))
	{
		//Verifico correttezza credenziali da database 
		//Mi connetto al database 'magazzino'
		$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die ("Errore: ".mysqli_connect_error());

		//Escape del codice fiscale
		$cf = mysqli_real_escape_string($conn, $_POST['cf_utente']);
		$password = mysqli_real_escape_string($conn, $_POST['pswd_utente']);
		
		//FACCIO UNA QUERY AL DATABASE PER AVERE L'HASH E CONFERMARE LA VALIDITà DELLA Password parte nuova
		$query1 = "SELECT userPswd as Password, nome as Nome from cliente where cf = '".$cf."';";
		$res1 = mysqli_query($conn, $query1) or die ("Errore 1.0 : ".mysqli_connect_error());
		$entry = mysqli_fetch_object($res1);
		
		if(mysqli_num_rows($res1) > 0 && md5($password) == $entry->Password){
			//Imposta le variabile di sessione
			$_SESSION["utente"] = $cf;
			$_SESSION["nome"] = $entry->Nome;
			//Vai alla pagina home.php
			header("Location: Home.php");
			mysqli_close($conn);//Parte aggiunta nuova
			exit;
		}else{
		//Flag di errore
		$errore = true;
		}
		mysqli_close($conn);
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sogno Italiano - Login</title>
		<link rel="stylesheet" href= "../Fogli_di_stile/Login.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../Script_javascript/scriptLogin.js" defer> </script>
		<script src="../Script_javascript/validation.js" defer> </script>
	</head>
	<body>
		<header>
			<h1>Login</h1>
		</header>
		
		<nav>
			<a href="Home.php">Home</a>
			<a href="Sign_up.php">Sign Up</a>			
		</nav>
		<div id = 'credenziali'>
		
		
		<form name='accesso' action='Login.php' method='post'>
			<label>Codice Fiscale   <input type='text' placeholder = 'Codice Fiscale' name='cf_utente' ></label>
			<label>Password   <input type='password' name='pswd_utente' ></label>
			<label><input type='submit' name='invio' value='Login' ></label>
			
		</form>
		<?php
		//Verifica la presenza di errori
			if(isset($errore)){
				echo "<p class='errore'>";
				echo "Credenziali non valide.";
				echo "</p>";
			}
		?>
		
		
		</div>
		<div class = "hidden">
		<p>Errore: I campi non sono compilati o la password non rispetta le specifiche</p>
		</div>
		
		<p>Non sei registrato? <a href="Sign_up.php">Clicca qui</a> per iscriverti!</p>
		<footer>
			<a href= "http://www.dieei.unict.it/corsi/l-8-inf"><img src="../Immagini/logoUNICT.jpg"/></a>
			<p>Francesco Catania O46002194, Corso di Web Programming, Ingegneria Informatica</p>
			<a href= "https://github.com/FrancescoCt"><img id='accountGithub' src="../Immagini/Github-Mark-32px.png"/></a>
		</footer>
	</body>
</html>