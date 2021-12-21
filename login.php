<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>LOGIN My Forum</title>
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <form class="box" action="login.php" method="post">
      <h1>Login</h1>
      <input type="text" name="username" placeholder="Username" maxlenght="250" required>
      <input type="password" name="password" placeholder="Password" maxlenght="16" required>
      <div>
         <?php
            if(isset($_POST['Login'])) {
               $db = "db";
               $username = "root";
               $password = "";
               $servername = "Localhost";
               $conn = new mysqli ($servername, $username, $password, $db);
               session_start();
               $nick = $_POST['username'];
               $_SESSION['username'] = $nick;
               $user = $_POST['username'];
               $user = addslashes ($user);
               mysqli_real_escape_string($conn,$user);
               $password = $_POST['password'];
               $password = addslashes ($password);
               mysqli_real_escape_string($conn,$password);
               $queryuser = $conn->query("SELECT username FROM user WHERE (username = '$user')");
               $querypass = $conn->query("SELECT password FROM user WHERE (password = '$password')");

               if ($queryuser->num_rows==1 && $querypass->num_rows==1) {
                  echo "<script>location.href='forum.php'</script>";
               }
               else if ($queryuser->num_rows==1 && $querypass->num_rows==0) {
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
</body>

</html>