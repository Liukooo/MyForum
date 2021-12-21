<?php
session_start();
$db = "forumdb";
$username = "root";
$password = "";
$servername = "Localhost";
$conn = new mysqli ($servername, $username, $password, $db);
if( !isset($_SESSION['username']) )
    die( "<script>location.href='login_quarantena.php'</script>" );
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> My Forum </title>
   <link rel="stylesheet" href="forum.css?v=<?php echo time(); ?>">
</head>

<body>
   <form class="box" action="forum.php" method="post">
      <div id="gigabox">
         <h1>Forum</h1>
         <div id="question">
            <p> question </p>
            <textarea id="questions" name="questions" placeholder="write and submit a question"> </textarea>
            <a href=""><input type="submit" name="submit" value="submit"></a>
            <?php
			if(isset($_POST['submit'])) {
					$user = $_SESSION['username'];
					$user = addslashes ($user);
					mysqli_real_escape_string($conn,$user);
                    $text = $_POST['questions'];
                    $text = addslashes ($text);
                    mysqli_real_escape_string($conn,$text);
                    $sql = "INSERT INTO questions (username, text) VALUES ('$user','$text')";

                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                        echo "<meta http-equiv='refresh' content='0'>";
                    }

                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
		?>
         </div>
   </form>
   <?php
            $result = $conn->query("SELECT * FROM questions ORDER BY id DESC");
            
            while($row = mysqli_fetch_array($result)) {
                $url = "answers.php?id=" . $row['id'];
                echo "<div class='q'><p class='user'>" . $row['username'] . "</p><p class='txt'>" . $row['text'] . "</p>";
                echo "<form action=" . $url . " method=post><input type='submit' name='comment' value='Add comment'></form></div>";
            }
        ?>
   </div>
</body>

</html>