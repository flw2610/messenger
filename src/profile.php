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
  <div class="modal" id="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Remove <?= $user->getUsername() ?> as a Friend?</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <p>Do you really want to end your friendship?</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
          <button type="button" class="btn btn-primary" onclick='removeFriend("<?= $user->getUsername() ?>")'>Yes, Please!</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-auto">
        <h1 class="text-center">
          Profile of <?= $user->getUsername() ?>
        </h1>
      </div>
    </div>

    <div class="row justify-content-center mb-4">
      <div class="col-auto">
        <div class="btn-group">
          <a class="btn btn-secondary btn-sm"
            href="./chat.php?friend=<?= $user->getUsername() ?>">
            &lt; Back to Chat
          </a>

          <button
            id="profile-remove-btn"
            class="btn btn-danger btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#dialog">
            Remove Friend
          </button>
        </div>
      </div>
    </div>


    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card shadow-sm p-4">
          <div class="row align-items-start">

            <!-- Profilbild -->
            <div class="col-md-3 text-center">
              <img
                src="images/profile.png"
                class="img-fluid rounded mb-3"
                alt="Profile Picture"
                style="max-width: 200px;" />
            </div>

            <!-- Profilinfos -->
            <div class="col-md-9">
              <p>
                <?= $user->getAboutYou() ?>
              </p>

              <dl class="row">
                <dt class="col-sm-4">Coffee or Tea?</dt>
                <dd class="col-sm-8">Tea</dd>

                <dt class="col-sm-4">Full Name</dt>
                <dd class="col-sm-8">
                  <?= $user->getUsername() . " " . $user->getLastname() ?>
                </dd>
              </dl>
            </div>

          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="row justify-content-center mt-5">
    <div class="col-10 text-center">
      <h2>Change History</h2>

      <?php
      foreach ($user->getHistory() as $entry) {
        echo "<p>$entry</p>";
      }
      ?>
    </div>
  </div>

  </div>
  <script>
    // create a model for remove friend 

    function removeFriend(name) {
      const btn = document.getElementById("profile-remove-btn");
      let myModalEl = document.querySelector('#dialog')
      let modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
      modal.hide();
      window.location.href = "friends.php?remove=" + name;
    }
  </script>
</body>

</html>