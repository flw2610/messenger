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
    if(empty($_POST["firstName"])){
      echo "<p>The First Name can't be empty!</p>";
      exit;
    }

    $user->setUsername($_POST["firstName"]);
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
    <link rel="stylesheet" href="stylesheet.css" />
  </head>

  <body class="inOut">
    <h1>Profile Settings</h1>
    <form action="settings.php" method="POST">
      <fieldset class="frame">
        <legend>Base Data</legend>
        <div class="mediaBreak">
          <label for="firstName">First Name</label>
          <input
            type="text"
            id="firstName"
            name="firstName"
            value="<?= $user->getUsername() ?>"
            placeholder="Your name"
          />
        </div>

        <div class="mediaBreak">
          <label for="lastName">Last Name</label>
          <input
            type="text"
            id="lastName"
            name="lastName"
            value="<?= $user->getLastname() ?>"
            placeholder="Your surname"
          />
        </div>

        <div class="mediaBreak">
          <label>Coffee or Tea?</label>
          <select name="coffeeOrTea">
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
        </div>
      </fieldset>

      <fieldset class="frame">
        <legend>Tell Something About You</legend>
        <textarea name="aboutYou" placeholder="Leave a comment here"><?= $user->getAboutYou() ?></textarea>
      </fieldset>

      <fieldset class="frame radioButtons">
        <legend>Preferred Chat Layout</legend>
        <div>
          <input
            type="radio"
            id="chatLayoutCombined"
            name="chatLayout"
            value="combined"
            <?= $user->getChatLayout() === "combined" ? "checked" : "" ?>
          />
          <label for="chatLayoutCombined"
            >Username and message in one line</label
          >
        </div>
        <div>
          <input
            type="radio"
            id="chatLayoutSeparate"
            name="chatLayout"
            value="separate"
            <?= $user->getChatLayout() === "separate" ? "checked" : "" ?>
          />
          <label for="chatLayoutSeparate"
            >Username and message in separated lines</label
          >
        </div>
      </fieldset>
      <div class="mediaBreak">
        <a href="friends.php"><button type="button">Cancel</button></a>
        <button class="enterButton" name="save" type="submit">Save</button>
      </div>
      <?php
        if (!empty($message)) {
          echo $message;
        }
      ?>
    </form>
    <h2 >Change History</h2>
    <?php
      foreach ($user->getHistory() as $entry) {
        echo $entry . "<br>";
      }
    ?>
  </body>
</html>