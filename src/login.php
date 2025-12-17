<?php require("start.php");
//prüft ob $_SESSION['user'] schon gesetzt ist
if (isset($_SESSION['user'])) {
  header("Location: friends.php");
  exit;
}

if (!empty($_POST["action"]) && $_POST["action"] === "login") {
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
  <!-- CSS-Framework von Bootstrap -->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'
    crossorigin='anonymous'>

</head>

<body class="inOut">
  <img src="images/chat.png" alt="SprechblasenLogo" />
  <div class="mb-5"></div>
  <br />
  <div class='container container-style'>
    <form class="login_register p-5" method="post">

      <h2>Please sign in</h2>
      <div class='form-group mb-3'>
        <input type="text" id="username" name="username" placeholder="Username"/><br />
      </div>

      <div class='form-group mb-3'>
        <input  type="password" id="password" name="password" placeholder="Password" />
      </div>

      <div class='form-group mb-3'>
       <a href="./register.php"><button class="btn btn-secondary" type="button">Register</button></a> 

        <button class="btn btn-primary block" type="submit" name="action" value="login">Login</button>

      </div>


    </form>
  </div>
  <!-- Notwendige JavaScript-Abhängigkeiten -->
  <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js'
    crossorigin='anonymous'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' crossorigin='anonymous'></script>
</body>

</html>