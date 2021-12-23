<!DOCTYPE html>
<html lang="en">

<?php
   session_start();
   $expire_time = 5*60;
   if( $_SESSION['last_activity'] < time()-$expire_time ) {
      echo "<script>location.href='logout.php'</script>";
      die();
   } else {
      $_SESSION['last_activity'] = time();
   }
   $db = "forumdb";
   $username = "root";
   $password = "";
   $servername = "Localhost";
   $conn = new mysqli ($servername, $username, $password, $db);
?>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>myForum</title>
   <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
   <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>

<body class="lightback">
   <nav class="menu">
      <ul>
         <li><a>
               <?php
               $user = $_SESSION['username'];
               if(($user=='')||(!isset($user))) {
                  echo "<a href='login.php'>Log in</a>";
               } else {
                  $queryuser = $conn->query("SELECT username FROM user WHERE (username = '$user')");

                  if ($queryuser->num_rows > 0) {
                     while($row = $queryuser->fetch_assoc()) {
                        echo "Hi " . $row["username"];
                     }
                  }
               }
            ?>
            </a></li>
         <li><a href="forum.php">Home</a></li>
         <li><a href="signin.php">Sign in</a></li>
         <li><a href="logout.php">Log out</a></li>
      </ul>
   </nav>
   <main class="forumbox">
      <header>
         <h1>Forum</h1>
         <div class="questionbox">
            <p>Question by
               <?php
                  $val = $conn->query("SELECT username FROM questions WHERE id = " . $_GET['id']);
                  $row = mysqli_fetch_row($val);
                  echo $row[0];
               ?>
            </p>
            <p>
               <?php
                  $val = $conn->query("SELECT text FROM questions WHERE id = " . $_GET['id']);
                  $row = mysqli_fetch_row($val);
                  echo $row[0];
               ?>
            </p>
         </div>
      </header>
      <form action="answers.php?id=<?php echo $_GET['id']; ?>" method="post">
         <div class='displayinput'>
            <textarea name="inputquestion" placeholder="Write and submit an answer"></textarea>
            <a><input type="submit" id="submit" name="submit" value="Submit"></a>
            <?php
               if(isset($_POST['submit'])) {
                  $user = $_SESSION['username'];
                  $user = addslashes ($user);
                  mysqli_real_escape_string($conn,$user);
                  $id = $_GET['id'];
                  $id = addslashes ($id);
                  $text = $_POST['inputquestion'];
                  $text = addslashes ($text);
                  mysqli_real_escape_string($conn,$text);
                  $sql = "INSERT INTO answers (username, text, id_questions) VALUES ('$user','$text', '$id')";

                  if($conn->query($sql) === TRUE) {
                     echo "New record created successfully";
                     echo "<meta http-equiv='refresh' content='0'>";
                  } else {
                     echo "Error: " . $sql . "<br>" . $conn->error;
                  }
               }
            ?>
         </div>
      </form>
      <div>
         <?php
            $result = $conn->query("SELECT * FROM answers WHERE id_questions=" . $_GET['id']);

            while($row = mysqli_fetch_array($result)) {
               echo "<div class='displayinput'><p id='user'>" . $row['username'] . "</p><p id='txt'>" . $row['text'] . "</p></div>";
            }
         ?>
      </div>
   </main>
</body>

</html>