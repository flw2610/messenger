<?php require("start.php");
//prüft ob $_SESSION['user'] schon gesetzt ist
if (isset($_SESSION['user'])) {
  header("Location: friends.php");
  exit;
}

if (!empty($_POST["action"])&& $_POST["action"] === "login") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($service->login($username, $password)) {
    $_SESSION['user'] = $username;
    header("Location: friends.php");
    exit;
  } else {
    echo "<p style='color:red;'>Login failed. Please check your username and password.</p>";
  }


}

?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="stylesheet.css" />
</head>

<body class="inOut">
  <img src="images/chat.png" alt="SprechblasenLogo" />
  <h1><b>Please sign in</b></h1>
  <form class="login_register" method="post">
    <fieldset class="frame">
      <legend>Login</legend>
      <div class="mediaBreak">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" /><br />
      </div>

      <div class="mediaBreak">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" />
      </div>
    </fieldset>
    <div class="mediaBreak">
      <a href="./register.php"><button type="button">Register</button></a>

      <button class="enterButton" type="submit" name="action" value="login">Login</button>

    </div>
  </form>
</body>

</html>