<?php require("start.php");
if (empty($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}



// Check Query Parameter to remove friend
if (isset($_GET['remove'])) {
  $friendToRemove = $_GET['remove'];
  $currentUser = $_SESSION['user'];
  if ($service->removeFriend($friendToRemove)) {
    error_log("Friend " . $friendToRemove . " removed successfully for user " . $currentUser);
  } else {
    error_log("Failed to remove friend " . $friendToRemove . " for user " . $currentUser);
  }
  header("Location: friends.php");
  exit;
}

// Request in action accept-friend or reject-friend
if (isset($_GET['action']) && ($_GET['action'] === 'accept-friend')) {
  $message = 'baum';
  $friendToAccept = $_GET['user'];
  if($service->friendAccept($friendToAccept)) {
    error_log("Friend request from " . $friendToAccept . " accepted.");
  } else {
    error_log("Failed to accept friend request from " . $friendToAccept . ".");
  }
  header("Location: friends.php");
  exit;
}

if (isset($_GET['action']) && ($_GET['action'] === 'reject-friend')) {
  $message = 'baum';
  $friendToReject = $_GET['user'];
  if($service->friendDismiss($friendToReject)) {
    error_log("Friend request from " . $friendToReject . " rejected.");
  } else {
    error_log("Failed to reject friend request from " . $friendToReject . ".");
  }
  header("Location: friends.php");
  exit;
}


?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="stylesheet.css" />
  <script src="main.js"></script>
  <script src="friendlist.js" defer></script>
</head>

<body>
  <h1><b>Friends</b></h1>
  <p>
    <a class="nav" href="./logout.php">Logout</a> |
    <a class="nav" href="./settings.php">Settings</a>
  </p>
  <hr />
  <!--Friends-->
  <ul id="friendlist"></ul>
  <hr />
  <!--Friend Requests-->
  <h2><b>New Requests</b></h2>
  <ol id="requestList"></ol>
  <hr />
  <!--Adding new Friend-->
  <form>
    <div class="inline-input-button mediaBreak">
      <input class="friend-message-input" type="text" placeholder="Add Friend to List" name="friendRequestName"
        id="friend-request-name" list="friend-selector" autocomplete="off" />
      <datalist id="friend-selector"> </datalist>
      <button type="button" onclick="addFriend()">Add</button>
    </div>
  </form>
</body>

</html>