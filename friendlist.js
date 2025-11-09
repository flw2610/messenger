var users = [];
var friends = [];

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
      friends = JSON.parse(xmlhttp.responseText);
      //console.log(friends);
      updateSelector();
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

function updateSelector() {
  const datalist = document.getElementById("friend-selector");
  // Making a copy of the options to safely iterate over
  const options = Array.from(datalist.getElementsByClassName("selectorOption"));

  users.forEach((user) => {
    // First we ignore our own user
    if (user != currentUser) {
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

function addFriend() {
  const requestField = document.getElementById("friend-request-name");
  const requestName = requestField.value;
  let validUser = false;
  // Check if name is a real user and not our own user
  if (users.includes(requestName) && requestName != currentUser) {
    // Check if name is not already a friend
    if (!friends.some((friend) => friend.username == requestName)) {
      validUser = true;
    } else {
      alert(`${requestName} is already a friend!`);
    }
  } else {
    alert("User not found");
  }

  if (validUser) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
        console.log("Requested...");
        alert("Friend request sent!");
      }
    };
    xmlhttp.open("POST", backendUrl + "/friend", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.setRequestHeader("Authorization", "Bearer " + token);
    let data = {
      username: requestName,
    };
    let jsonString = JSON.stringify(data);
    xmlhttp.send(jsonString);
  }

  requestField.value = "";
}
