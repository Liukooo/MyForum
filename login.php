<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>LOGIN Page</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <form class="box" action="login.php" method="post">
      <h1 style="color: #A50F00;">Login</h1>
      <input type="email" name="email" placeholder="Email" maxlenght="250" required>
      <input type="password" name="Password" placeholder="Password" maxlenght="16" required>
      <div>
         <?php
			if(isset($_POST['Login']))
				{
					$quarantena = "quarantena";
					$username = "root";
					$password = "";
					$servername = "Localhost";
					$conn = new mysqli ($servername, $username, $password, $quarantena);
					session_start();
					$nick=$_POST['email'];
					$_SESSION['email']=$nick;
					$email = $_POST['email'];
					$email = addslashes ($email);
					mysqli_real_escape_string($conn,$email);
					$password = $_POST['Password'];
					$password = addslashes ($password);
					mysqli_real_escape_string($conn,$password);
					$querymail = $conn->query("SELECT email FROM credenziali WHERE (email = '$email')");
					$querypass = $conn->query("SELECT password FROM credenziali WHERE (password = '$password')");
				if ($querymail->num_rows==1 && $querypass->num_rows==1) {
					
					
					echo "<script>location.href='torte.php'</script>";
				}
				else if ($querymail->num_rows==1 && $querypass->num_rows==0){
					echo "Password errata!";
				}
				else {
					echo "Mail e/o password errata!";
				}
			}
		?>
      </div>
      <a href=""><input type="submit" name="Login" value="Login"></a>
   </form>