<?php
  require("start.php");
  if (empty($_SESSION['user'])) {
    header("Location: login.php");
    exit;
  }

  $user = $service->loadUser($_SESSION['user']);
  if(!$user){
    die;
  }
  //var_dump($user);

  if(isset($_POST["save"])){
    //if(empty($_POST["firstName"])){
    //  echo "<p>The First Name can't be empty!</p>";
    //  exit;
    //}

    //$user->setUsername($_POST["firstName"]);
    $user->setLastname($_POST["lastName"]);
    $user->setCoffeeOrTea($_POST["coffeeOrTea"]);
    $user->setAboutYou($_POST["aboutYou"]);
    $user->setChatLayout($_POST["chatLayout"]);

    $history = $user->getHistory();
    $history[] = date('Y-m-d H:i:s');
    $user->setHistory($history);

    if($service->saveUser($user)){
      $message = "<p>User data saved successfully!</p>";
    } else {
      $message = "<p>Could not save user data!</p>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Settings</title>
    <!-- link rel="stylesheet" href="stylesheet.css" /-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

  </head>

  <body>
    <div class="container bg-light py-3 px-5">
      <h1>Profile Settings</h1>
      <hr>
      <form action="settings.php" method="POST">
        <h4>Base Data</h4>
        <div class="my-3">
          <input
            type="text"
            id="firstName"
            name="firstName"
            class="form-control"
            disabled
            value="<?= $user->getUsername() ?>"
            placeholder="Your name"
          />
        </div>

        <div class="my-3">
          <input
            type="text"
            id="lastName"
            name="lastName"
            class="form-control"
            value="<?= $user->getLastname() ?>"
            placeholder="Your surname"
          />
        </div>

        <div class="form-floating my-3">
          <select name="coffeeOrTea" id="coffeeOrTea" class="form-select">
            <option value="neither"
            <?php
              if($user->getCoffeeOrTea() === "neither" || $user->getCoffeeOrTea() === null){
                echo "selected";
              }
            ?>
            >Neither nor</option>
            <option value="coffee" <?= $user->getCoffeeOrTea() === "coffee" ? "selected" : "" ?>>Coffee</option>
            <option value="tea" <?= $user->getCoffeeOrTea() === "tea" ? "selected" : "" ?>>Tea</option>
          </select>
          <label for="coffeeOrTea">Coffee or Tea?</label>
        </div>

        <hr>

        <h4>Tell Something About You</h4>
        <div class="my-3">
          <textarea name="aboutYou" class="form-control" style="height: 100px" placeholder="Leave a comment here"><?= $user->getAboutYou() ?></textarea>
        </div>

        <hr>

        <h4>Preferred Chat Layout</h4>
        <div class="form-check">
          <input
            type="radio"
            class="form-check-input"
            id="chatLayoutCombined"
            name="chatLayout"
            value="combined"
            <?= $user->getChatLayout() === "combined" ? "checked" : "" ?>
          />
          <label for="chatLayoutCombined" class="form-check-label"
            >Username and message in one line</label
          >
        </div>
        <div class="form-check">
          <input
            type="radio"
            class="form-check-input"
            id="chatLayoutSeparate"
            name="chatLayout"
            value="separate"
            <?= $user->getChatLayout() === "separate" ? "checked" : "" ?>
          />
          <label for="chatLayoutSeparate" class="form-check-label"
            >Username and message in separated lines</label
          >
        </div>

        <hr>

        <div class="row my-3">
          <div class="btn-group">
            <a href="friends.php" class="btn btn-secondary w-100">Cancel</a>
            <button class="btn btn-primary w-100" name="save" type="submit">Save</button>
          </div>
        </div>
        <?php
          if (!empty($message)) {
            echo $message;
          }
        ?>
      </form>
    </div>
    <div class="container bg-secondary py-3 px-5">
      <h2 >Change History</h2>
      <?php
        foreach ($user->getHistory() as $entry) {
          echo $entry . "<br>";
        }
      ?>
    </div>

    <!-- Bootstrap Bundle inkl. Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>  
  </body>
</html>