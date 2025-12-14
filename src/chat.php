<?php require("start.php"); 

if (empty($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link rel="stylesheet" href="stylesheet.css" /-->
    <script src="main.js"></script>
    <script src="chat.js" defer></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container bg-light py-3 px-5">
      <h1 id="chat-header">Chat with Tom</h1>
      <div class="btn-group">
        <a class="btn btn-secondary" href="friends.php">&lt; Back</a>
        <a class="btn btn-secondary" id="view-profile-link" href="profile.php">Profile</a>
        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeFriendModal">
        Remove Friend</a>
      </div>
      <div class="card my-3">
        <div class="card-body" id="messages"></div>
      </div>
      <div class="input-group">
        <input
          id="message-input"
          class="form-control"
          type="text"
          placeholder="New Message"
        />
        <button
          class="btn btn-primary"
          id="send-message-button"
          type="button"
          onclick="onSendMessageButtonClicked()"
        >
        Send
        </button>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="removeFriendModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modal-header">Remove x as Friend</h4>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            Do you really want to end your friendship?
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" id="friend-remove" href="friends.php">
              Yes, Please!
            </a>
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle inkl. Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
