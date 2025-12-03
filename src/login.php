<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="stylesheet.css" />
  </head>

  <body class="inOut">
    <img src="images/chat.png" alt="SprechblasenLogo" />
    <h1><b>Please sign in</b></h1>
    <form class="login_register">
      <fieldset class="frame">
        <legend>Login</legend>
        <div class="mediaBreak">
          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Username"
          /><br />
        </div>

        <div class="mediaBreak">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Password"
          />
        </div>
      </fieldset>
      <div class="mediaBreak">
        <a href="./register.php"><button type="button">Register</button></a>
        <a href="./friends.php"
          ><button class="enterButton" type="button">Login</button></a
        >
      </div>
    </form>
  </body>
</html>
