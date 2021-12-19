<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>LOGIN Page</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <form class="box" action="signup.php" method="post">
      <h1>Registrati</h1>
      <input type="text" name="Nome" placeholder="Nome" maxlenght="30" required>
      <input type="text" name="Cognome" placeholder="Cognome" maxlenght="50" required>
      <input type="email" name="Email" placeholder="Email" maxlenght="250" required>
      <input type="text" name="Username" placeholder="Username" maxlenght="20" required>
      <input type="password" name="Password" placeholder="Password" maxlenght="16" required>
      <div>
         <?php
		if(isset($_POST['Registrati'])){
			$quarantena = "quarantena";
			$username = "root";
			$password = "";
			$servername = "Localhost";
			$conn = new mysqli ($servername, $username, $password, $quarantena);
			$nome = $_POST ['Nome'];
			$nome = addslashes ($nome);
			mysqli_real_escape_string($conn,$nome);
			$cognome = $_POST ['Cognome'];
			$cognome = addslashes ($cognome);
			mysqli_real_escape_string($conn,$cognome);
			$email = $_POST ['Email'];
			$email = addslashes ($email);
			mysqli_real_escape_string($conn,$email);
			$username = $_POST ['Username'];
			$username = addslashes ($username);
			mysqli_real_escape_string($conn,$username);
			$password = $_POST ['Password'];
			$password = addslashes ($password);
			mysqli_real_escape_string($conn,$password);
			
			$controlloemail = $conn -> query("SELECT email FROM credenziali WHERE (email = '$email')");
			if ($controlloemail -> num_rows == 0){
				$add = "INSERT INTO credenziali (nome, cognome, email, nickname, password) VALUES ('$nome', '$cognome', '$email', '$username', '$password')";
				if ($conn->query($add) === TRUE) {
					echo "La tua registrazione è stata eseguita con successo! Vai a fare il <a href = login.php style = text-align : center;><br>LOGIN</a>";
				}
				else {
					echo "Errore, riprova fra qualche minuto";
				}
		   }
		else {
			echo "Questa email è già in uso, vuoi fare il <a href = login.php style = text-align : center;><br>LOGIN</a>";
		}
	}
    ?>
      </div>
      <a href=""><input type="submit" name="Registrati" value="Registrati"></a>
   </form>
</body>

</html>