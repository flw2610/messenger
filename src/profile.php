<?php
require("start.php");
if (empty($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}
if (empty($_GET['user'])) {
  header("Location: friends.php");
  exit;
}
$user = $service->loadUser($_GET['user']);
//var_dump($user);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Profile</title>

</head>

<body class="inOut">
  <div class="container">
    <div class="row">
      <h1>Profile of <?= $user->getUsername() ?></h1>
    </div>
    <div class="row mx-auto mb-3">
      <div class="btn-group col-4">
        <a class="nav btn btn-secondary" href="./chat.php?friend=<?= $user->getUsername() ?>"> &lt; Back to Chat</a>
        <a class="rmFriend btn btn-danger" href="./friends.php?remove=<?= $user->getUsername() ?>">Remove Friend</a>
      </div>
    </div>
    <div class="row profile-content mediaBreak">
      <div class="col-3">
        <img
          class="rounded mx-auto d-block mb-3"
          id="profilpic"
          src="images/profile.png"
          width="250"
          alt="Profile Picture" />

      </div>
      <div class="profile-infos col-9">
        <p><?= $user->getAboutYou() ?></p>

        <dl>
          <dt>Coffee or Tea?</dt>
          <dd>Tea</dd>
          <dt>Full Name</dt>
          <dd><?= $user->getUsername() . " " . $user->getLastname() ?></dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="row">
    <h2>Change History</h2>
    <?php
    foreach ($user->getHistory() as $entry) {
      echo $entry . "<br>";
    }
    ?>

  </div>
  </div>
</body>

</html>