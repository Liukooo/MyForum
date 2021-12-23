<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    $expire_time = 5*60;
    if($_SESSION['last_activity'] < time()-$expire_time ) {
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
      <form action="forum.php" method="post">
         <h1>Forum</h1>
         <div class="questionbox">
            <p>Question</p>
            <textarea name="inputquestion" placeholder="Write and submit a question"></textarea>
            <input type="submit" id="submit" name="submit" value="Submit">
            <?php
               if(isset($_POST['submit'])) {
                  $text = $_POST['inputquestion'];
                  $text = addslashes ($text);
                  mysqli_real_escape_string($conn,$text);
                  $sanitizedText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                  $sql = "INSERT INTO questions (username, text) VALUES ('$user','$sanitizedText')";
                  if(!strlen(trim($_POST['inputquestion']))) {
                        echo "Please enter a question";
                  } else {
                     if($conn->query($sql) === TRUE) {
                        echo "<script>alert('New record created successfully')</script>";
                     } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                     }
                  }
               }
            ?>
         </div>
      </form>
      <div>
         <?php
            $result = $conn->query("SELECT * FROM questions ORDER BY id DESC");

            while($row = mysqli_fetch_array($result)) {
               $url = "answers.php?id=" . $row['id'];
               echo "<div class='displayinput'><p id='user'>" . $row['username'] . "</p><p id='txt'>" . htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8') . "</p>";
               echo "<form action=" . $url . " method=post><input type='submit' id='submit' name='addanswer' value='Add answer'></form></div>";
            }
         ?>
      </div>
   </main>
</body>

</html>