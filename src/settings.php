<?php require("start.php"); ?>
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
    <form action="settings.php" method="get">
      <fieldset class="frame">
        <legend>Base Data</legend>
        <div class="mediaBreak">
          <label for="firstName">First Name</label>
          <input
            type="text"
            id="firstName"
            name="firstName"
            placeholder="Your name"
          />
        </div>

        <div class="mediaBreak">
          <label for="lastName">Last Name</label>
          <input
            type="text"
            id="lastName"
            name="lastName"
            placeholder="Your surname"
          />
        </div>

        <div class="mediaBreak">
          <label>Coffee or Tea?</label>
          <select name="coffeeOrTea">
            <option value="neither" selected>Neither nor</option>
            <option value="coffee">Coffee</option>
            <option value="tea">Tea</option>
          </select>
        </div>
      </fieldset>

      <fieldset class="frame">
        <legend>Tell Something About You</legend>
        <textarea name="aboutYou" placeholder="Leave a comment here"></textarea>
      </fieldset>

      <fieldset class="frame radioButtons">
        <legend>Preferred Chat Layout</legend>
        <div>
          <input
            type="radio"
            id="chatLayoutCombined"
            name="chatLayout"
            value="combined"
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
          />
          <label for="chatLayoutSeparate"
            >Username and message in separated lines</label
          >
        </div>
      </fieldset>
      <div class="mediaBreak">
        <a href="friends.php"><button type="button">Cancel</button></a>
        <button class="enterButton" type="submit">Save</button>
      </div>
    </form>
  </body>
</html>
