<?php require("start.php"); 
session_unset();
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
    
    <img src="images/logout.png" alt="Logging-Out-Logo" />
    <div class="mb-5"></div>
    <div class="login_register p-5">
      <h1><b>Logged out...</b></h1>
    <p>See u!</p>
    <a  href="./login.php"><button class="btn btn-secondary">Login again</button></a>
    </div>
    <!-- Notwendige JavaScript-Abhängigkeiten -->
  <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js'
    crossorigin='anonymous'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' crossorigin='anonymous'></script>
  </body>
</html>
