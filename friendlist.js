var users = [];

window.setInterval(function () {
  loadFriends();
  loadUsers();
}, 1000);
loadFriends();
loadUsers();

function loadFriends() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let friends = JSON.parse(xmlhttp.responseText);
      //console.log(friends);
      updateSelector(friends);
    }
  };
  xmlhttp.open("GET", backendUrl + "/friend", true);
  xmlhttp.setRequestHeader("Content-type", "application/json");
  xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
  xmlhttp.send();
}

function loadUsers() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      users = JSON.parse(xmlhttp.responseText);
      //console.log(users);
    }
  };
  xmlhttp.open("GET", backendUrl + "/user", true);
  xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
  xmlhttp.send();
}

function updateSelector(friends) {
  const datalist = document.getElementById("friend-selector");
  // Making a copy of the options to safely iterate over
  const options = Array.from(datalist.getElementsByClassName("selectorOption"));

  users.forEach((user) => {
    // First we ignore our own user
    if (user != window.user) {
      // Search if the user is found in the list of friends
      if (friends.some((friend) => friend.username == user)) {
        // If the user is already a friend, we check if it needs to be removed from the options
        const option = options.find((option) => option.innerText == user);
        if (option) {
          datalist.removeChild(option);
        }
      } else {
        // If the user is not a friend, we check if it needs to be added to the options
        if (!options.some((option) => option.innerText == user)) {
          const option = document.createElement("option");
          option.className = "selectorOption";
          option.innerText = user;
          datalist.appendChild(option);
        }
      }
    }
  });
}
