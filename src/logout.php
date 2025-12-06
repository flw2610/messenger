<?php require("start.php"); 
session_unset();
?>
<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="stylesheet.css" />
  </head>

  <body class="inOut">
    <img src="images/logout.png" alt="Logging-Out-Logo" />
    <h1><b>Logged out...</b></h1>
    <p>See u!</p>
    <a class="nav" href="./login.php">Login again</a>
  </body>
</html>
