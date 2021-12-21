<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SIGNUP My Forum</title>
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <form class="box" action="signup.php" method="post">
      <h1>Sign Up</h1>
      <input type="text" name="username" placeholder="Username" maxlenght="20" required>
      <input type="password" name="password" placeholder="Password" maxlenght="16" required>
      <div>
         <?php
				if(isset($_POST['signup'])) {
					$db = "db";
					$username = "root";
					$password = "";
					$servername = "Localhost";
					$conn = new mysqli ($servername, $username, $password, $db);
					$user = $_POST ['username'];
					$user = addslashes ($user);
					mysqli_real_escape_string($conn,$user);
					$password = $_POST ['password'];
					$password = addslashes ($password);
					mysqli_real_escape_string($conn,$password);
					$usercheck = $conn -> query("SELECT username FROM user WHERE (username = '$user')");

					if ($usercheck -> num_rows == 0) {
						$add = "INSERT INTO user (username, password) VALUES ('$user', '$password')";

						if ($conn->query($add) === TRUE) {
							echo "La tua registrazione è stata eseguita con successo! Vai a fare il <a href = login.php style = text-align : center;><br>LOGIN</a>";
						} else {
							echo "Errore, riprova fra qualche minuto";
						}
					} else {
						echo "Questa email è già in uso, vuoi fare il <a href = login.php style = text-align : center;><br>LOGIN</a>";
					}
				}
			?>
      </div>
      <a href=""><input type="submit" name="signup" value="Sign Up"></a>
   </form>
</body>

</html>