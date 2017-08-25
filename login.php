<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	//dołanczamy plik z danymi do połączenia z bazą danych
	require_once "connection.php";

	//Jeżeli połącznei zgłosi błąd to wyświetl numer błedu a nie opis
	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}
	//Jeżeli połączenie nie zgłosi błędu to skrypt działa dalej
	else
	{
		$login = $_POST['login'];
		$password = md5($_POST['password']);

		//$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		//$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

	  $sql = 'SELECT * FROM user_account WHERE email = "'.$login.'" AND password = "'.$password.'"';

		//Zwraca wynik zapytania z bazy danych
		if ($result = mysqli_query($connect, $sql))

		//if ($rezultat = @$polaczenie->query(
		//sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
		//mysqli_real_escape_string($polaczenie,$login),
		//mysqli_real_escape_string($polaczenie,$haslo))))
		{
			//sprawdzamy za pomocą num_rows ilość zwróconych wyników zapytania czyli rekordów
			$user_ammount = $result->num_rows;
			if($user_ammount>0){
				$_SESSION['logged'] = true;

				//Tworzymy teraz tablicę asocjacyjną ze zwróconego wyniku zapytania sql
				$user_table = $result->fetch_assoc();

				//Dzieki fetch_assoc możemy się teraz odwołać do nazw kolumn jakie ma tabela w naszej bazie danych
				$_SESSION['id'] = $user_table['id'];
				$_SESSION['name'] = $user_table['name'];
				$_SESSION['surname'] = $user_table['surname'];
				$_SESSION['email'] = $user_table['email'];

				unset($_SESSION['error']);

				//Czyścimy nasz wynik zapytania i zwalniamy pamięć
				$result->free_result();
				header('Location: index.php');
			} else {
				$_SESSION['error'] = '<span style="color:red">Wrong login or password!</span>';
				header('Location: index.php');
			}
		}
		$connect->close();
	}
?>
