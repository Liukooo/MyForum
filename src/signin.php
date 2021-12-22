<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SIGNIN My Forum</title>
   <link rel="stylesheet" href="style.css">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>
   <form class="box" action="signin.php" method="post">
      <h1>Sign In</h1>
      <input type="text" name="username" placeholder="Username" maxlenght="20" required>
      <input type="password" name="password" placeholder="Password" maxlenght="16" required>
      <div>
         <?php
				if(isset($_POST['signin'])) {
					$db = "forumdb";
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
					$uppercase = preg_match('@[A-Z]@', $password);
					$lowercase = preg_match('@[a-z]@', $password);
					$number    = preg_match('@[0-9]@', $password);
				 	$specialChars = preg_match('@[^\w]@', $password);
					$usercheck = $conn -> query("SELECT username FROM user WHERE (username = '$user')");

					if($usercheck -> num_rows == 0) {
						if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
							echo "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
						} else {
							$add = "INSERT INTO user (username, password) VALUES ('$user', '$password')";
							if($conn->query($add = "INSERT INTO user (username, password) VALUES ('$user', '$password')") === TRUE) {
								echo "Your registration has been succesfull! <a href = login.php style = text-align : center;><br>Log in</a> to continue";
							} else {
								echo "Try again in a few minutes";
							}
						}	
					} else {
						echo "This username is already in use, go to <a href = login.php style = text-align : center;><br>LOGIN</a>";
					}
				}
			?>
      </div>
      <input type="submit" name="signin" value="Sign In">
   </form>
</body>

</html>