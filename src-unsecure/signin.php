<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SIGNIN myForum</title>
   <link rel="stylesheet" href="style.css">
   <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>

<body class="darkback">
   <form class="formbox" action="signin.php" method="post">
      <h1>Sign In</h1>
      <input type="text" id="elements" name="username" placeholder="Create your username" maxlenght="20" required>
      <input type="password" id="elements" name="password" placeholder="Create your password" maxlenght="16" required>
      <div>
         <?php
				if(isset($_POST['signin'])) {
					$db = "forumdb";
					$username = "root";
					$password = "";
					$servername = "Localhost";
					$conn = new mysqli ($servername, $username, $password, $db);
					$user = $_POST ['username'];
					$password = $_POST ['password'];
					$usercheck = $conn -> query("SELECT username FROM user WHERE (username = '$user')");

					if(!empty($usercheck) && $usercheck->num_rows > 0) {
						$add = "INSERT INTO user (username, password) VALUES ('$user', '$password')";
						if($conn->query($add = "INSERT INTO user (username, password) VALUES ('$user', '$password')") === TRUE) {
							echo "Your registration has been succesfull! <a href = login.php><br>LOGIN</a> to continue";
						} else {
							echo "Try again in a few minutes";
						}
					} else {
						echo "This username is already in use, go to <a href = login.php><br>LOGIN</a>";
					}
				}
			?>
      </div>
      <input type="submit" id="check" name="signin" value="Sign In">
   </form>
</body>

</html>