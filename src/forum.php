<?php
    session_start();
    $expire_time = 5*60; //expire time
    if($_SESSION['last_activity'] < time()-$expire_time ) {
        echo "<script>location.href='logout.php'</script>";
        die();
    } else {
        $_SESSION['last_activity'] = time(); // you have to add this line when logged in also;
        echo 'you are uptodate';
    }
    $db = "forumdb";
    $username = "root";
    $password = "";
    $servername = "Localhost";
    $conn = new mysqli ($servername, $username, $password, $db);
    //if( !isset($_SESSION['username']) )
    //    die( "<script>location.href='login.php'</script>" );
    //parentesi forse?
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Forum</title>
   <link rel="stylesheet" href="forum.css?v=<?php echo time(); ?>">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>
   <div class="container">
      <ul id="menu">
         <li>
            <a>
               <?php 
                  $user=$_SESSION['username'];
                  if(($user=='')||(!isset($user))) {
                     echo "<a href='login.php'>Log in</a>";
                  } else {
                     $queryuser = $conn->query("SELECT username FROM user WHERE (username = '$user')");

                     if ($queryuser->num_rows > 0) {
                        while($row = $queryuser->fetch_assoc()) {
                           echo "Hi " . $row["username"] . "";
                        }
                     }
                  }
               ?>
            </a>
         </li>
         <li><a href="forum.php">Home</a></li>
         <li><a href="signin.php">Sign in</a></li>
         <li><a href="logout.php">Log out</a></li>
      </ul>
      <form class="box" action="forum.php" method="post">
         <div id="gigabox">
            <h1>Forum</h1>
            <div id="question">
               <p>Question</p>
               <textarea id="questions" name="questions" placeholder="Write and submit a question"></textarea>
               <input type="submit" name="submit" value="Submit">
               <?php
                    if(isset($_POST['submit'])) {
                        //$user = $_SESSION['username'];
                        $text = $_POST['questions'];
                        $text = addslashes ($text);
                        mysqli_real_escape_string($conn,$text);
                        $sql = "INSERT INTO questions (username, text) VALUES ('$user','$text')";
                        if(!strlen(trim($_POST['questions']))) {
                            echo "Please enter a question";
                        } else {
                            if($conn->query($sql) === TRUE) {
                                echo "New record created successfully";
                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        }
                    }
                ?>
            </div>
      </form>
      <?php
            $result = $conn->query("SELECT * FROM questions ORDER BY id DESC");
            
            while($row = mysqli_fetch_array($result)){
                $url = "answers.php?id=" . $row['id'];
                echo "<div id='q'><p class='user'>" . $row['username'] . "</p><p class='txt'>" . $row['text'] . "</p>";
                echo "<form action=" . $url . " method=post><input type='submit' name='answer' value='Add answer'></form></div>";
            }
        ?>
   </div>
</body>

</html>