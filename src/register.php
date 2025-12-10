<?php require("start.php"); 
  if(!empty($_POST["action"]) && $_POST["action"] === "register") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_repetition = $_POST["password_repetition"];

  //der Nutzername nicht leer ist und min. 3 Zeichen hat
  //der Nutzername nicht vergeben ist (siehe BackendService)
  //das Passwort nicht leer ist
  //das Passwort min. 8 Zeichen hat
  //das Passwort mit der Wiederholung übereinstimmt
    if (strlen(trim($username)) < 3) {
      echo "<p style='color:red;'>Username must be at least 3 characters long.</p>";
    } elseif ($service->userExists($username)) {
      echo "<p style='color:red;'>Username is already taken. Please choose another one.</p>";
    } elseif (strlen($password) < 8) {
      echo "<p style='color:red;'>Password must be at least 8 characters long.</p>";
    } elseif ($password !== $password_repetition) {
      echo "<p style='color:red;'>Passwords do not match. Please try again.</p>";
    } else {
      if ($service->register($username, $password)) {
        $_SESSION['user'] = $username;
        header("Location: friends.php");
        exit;
      } else {
        echo "<p style='color:red;'>Registration failed. Please try again later.</p>";
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="stylesheet.css" />
    <script src="main.js"></script>
    <script src="register.js" defer></script>
  </head>

  <body class="inOut">
    <img src="images/user.png" alt="profile" />

    <h1>Register yourself</h1>

    <form method="post">
      <fieldset class="login_register frame">
        <legend>Register</legend>
        <div class="mediaBreak">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Username" />
        </div>
        <div class="mediaBreak">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" />
        </div>
        <div class="mediaBreak">
          <label for="password_repetition">Confirm Password</label>
          <input type="password" id="password_repetition" name="password_repetition" placeholder="Confirm Password" />
        </div>
      </fieldset>
      <div class="mediaBreak">
        <a href="login.php">
          <button type="button">Cancel</button>
        </a>
        <button id="registerButton" class="enterButton" name="action" value="register" type="submit">
          Create Account
        </button>
      </div>
    </form>
  </body>
</html>
