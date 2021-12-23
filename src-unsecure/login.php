<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>LOGIN myForum</title>
   <link rel="stylesheet" href="style.css">
   <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>

<body class="darkback">
   <form class="formbox" action="login.php" method="post">
      <h1>Login</h1>
      <input type="text" id="elements" name="username" placeholder="Enter your username" maxlenght="250" required>
      <input type="password" id="elements" name="password" placeholder="Enter your password" maxlenght="16" required>
      <div>
         <?php
            if(isset($_POST['login'])) {
               $db = "forumdb";
               $username = "root";
               $password = "";
               $servername = "Localhost";
               $conn = new mysqli ($servername, $username, $password, $db);
               session_start();
               $nick = $_POST['username'];
               $_SESSION['username'] = $nick;
               $user = $_POST['username'];
               $password = $_POST['password'];
               $queryuser = $conn->query("SELECT username FROM user WHERE (username = '$user')");
               $querypass = $conn->query("SELECT password FROM user WHERE (password = '$password')");

               if ($queryuser->num_rows==1 && $querypass->num_rows==1) {
                  $_SESSION['last_activity'] = time();
                  echo "<script>location.href='forum.php'</script>";
               }
               else if ($queryuser->num_rows==1 && $querypass->num_rows==0) {
                  echo "Wrong Password!";
               }
               else {
                  echo "Wrong user or password!";
               }
            }
         ?>
      </div>
      <input type="submit" id="check" name="login" value="Log In">
   </form>
</body>

</html>