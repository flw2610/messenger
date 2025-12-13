<?php require("start.php");
if (!empty($_POST["action"]) && $_POST["action"] === "register") {
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="stylesheet.css" /> -->
  <script src="main.js"></script>
  <script src="register.js" defer></script>
</head>

<body class="inOut">
  <div class="container">
    <img class="rounded mx-auto d-block" src="images/user.png" alt="profile" />
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card mt-3">
          <div class="card-header">
            <h1>Register yourself</h1>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">

                <div class="mb-3">
                  <input class="form-control" type="text" id="username" name="username" placeholder="Username" />
                  <div class="invalid-feedback">Username schon vorhanden</div>
                </div>

                <div class="mb-3">
                  <input class="form-control" type="password" id="password" name="password" placeholder="Password" />
                  <div class="invalid-feedback">Passwort ist zu kurz</div>
                </div>

                <div class="mb-3">
                  <input class="form-control" type="password" id="password_repetition" name="password_repetition" placeholder="Confirm Password" />
                  <div class="invalid-feedback">Passwörter stimmen nicht überein</div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                  <a href="login.php">
                    <button class="btn btn-secondary" type="button">Cancel</button>
                  </a>
                  <button id="registerButton" class="enterButton btn btn-primary" name="action" value="register" type="submit">
                    Create Account
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>