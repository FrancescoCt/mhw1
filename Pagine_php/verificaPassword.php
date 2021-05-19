<?php
	session_start();
	//header('Content-Type: application/json');
	//Controllo che prima sia stata mandata la richiesta POST
	if(isset($_POST['pswd']) && isset($_SESSION['utente'])){
	
	//Mi connetto al database 'magazzino'
	$conn = mysqli_connect('localhost', 'root', '', 'magazzino') or die ("Errore: ".mysqli_connect_error());

	//Escape del codice fiscale e della password
	$cf = mysqli_real_escape_string($conn, $_SESSION['utente']);
	$pswd = mysqli_real_escape_string($conn, $_POST['pswd']);

	//Preparazione Query
	$query = "SELECT userPswd as Password from cliente where cf = '".$cf."'";
	//SELECT user_Pswd as Password from cliente where cf = 'CTFR55'
	//Eseguo query
	$res = mysqli_query($conn, $query) or die ("Errore 1 : ".mysqli_connect_error());
	
	//Controllo il database: se la password è uguale a quella fornita posso fare la query di eliminazione
	$row = mysqli_fetch_assoc($res);
	
	if($row['Password'] == md5($pswd) ){
			
			//Comincio la query di cancellazione
			
			$query1 = "delete from cliente where cf = '".$cf."'";
			$res1 = mysqli_query($conn, $query1) or die ("Errore 2 : ".mysqli_connect_error());
			//Il valore sarà anche cancellato dal database ma il cookie di sessione è ancora attivo, bisogna rimuoverlo
			//session_destroy();
			mysqli_close($conn);
			//echo "Password verificata, cancellazione avvenuta";
			//header("Location: Logout.php");
			//exit;
			session_destroy();
			
			
			//header("Location: Sign_up.php");
			//exit;
		}
	//GESTISCO L'ELSE CON UN'ALTRA QUERY: inserisco il nuovo utente nel database
	else{
		echo "Password non coincidente";
		}/**/
		mysqli_close($conn);
	}//else echo "Qualcosa è andato storto";
	
	
	
?>