var users = [];
var friends = [];
const currentUser = document.getElementById("current-username").value;
console.log("Current user is: " + currentUser);

window.setInterval(function () {
  loadFriends();
  loadUsers();
}, 1000);
loadFriends();
loadUsers();

function loadFriends() {
  fetch("ajax_load_friends.php")
    .then((res) => {
      if (res.status === 404) {
        friends = [];
        return null;
      } else {
        return res.json();
      }
    })
    .then((data) => {
      if (data !== null) {
        friends = data;
      } else {
        console.log("No friends loaded.");
      }
    });
  //updateSelector();
  updateFriends();
}

function loadUsers() {
  fetch("ajax_load_users.php")
    .then((res) => res.json())
    .then((data) => {
      if (data !== null) {
        users = data;
      } else {
        console.log("No users loaded.");
      }
    });
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
      requestField.style.borderColor = "red";
    }
  } else {
    alert("User not found");
    requestField.style.borderColor = "red";
  }

  if (validUser) {
    fetch("friends.php?action=add-friend&user=" + requestName).then(
      (response) => {
        if (response.ok) {
          console.log("Friend request sent.");
          location.reload();
        } else {
          console.error("Error sending friend request.");
        }
      }
    );
  }

  requestField.value = "";
}

function updateFriends() {
  const friendlist = document.getElementById("friendlist");
  // These are the list-items (li), each consists of an anchor and a span
  const friendEntries = Array.from(
    friendlist.getElementsByClassName("friendEntry")
  );
  const requestList = document.getElementById("requestList");
  // There are the requestList items
  const requestEntries = Array.from(
    requestList.getElementsByClassName("requestEntry")
  );

  users.forEach((user) => {
    // First we ignore our own user
    if (user != currentUser) {
      // Search if the user is found in the list of friends
      const friend = friends.find((friend) => friend.username == user);
      // Differ between accepted friends and friend requests
      if (friend && friend.status == "accepted") {
        // If the user is a friend, we check if it needs to be added to the list
        if (
          !friendEntries.some(
            (entry) => entry.getElementsByTagName("a")[0].innerText == user
          )
        ) {
          friendlist.appendChild(createFriendEntry(user));
        }
        const friendEntry = friendEntries.find(
          (entry) => entry.getElementsByTagName("a")[0].innerText == user
        );
        if (friendEntry) {
          const span = friendEntry.getElementsByTagName("span")[0];
          span.innerText = friend.unread;
          if (friend.unread > 0) {
            span.style.visibility = "visible";
          } else {
            span.style.visibility = "hidden";
          }
        }
      } else {
        // If the user is not a friend (anymore), we check if it needs to be removed from the list
        const friendEntry = friendEntries.find(
          (entry) => entry.getElementsByTagName("a")[0].innerText == user
        );
        if (friendEntry) {
          friendlist.removeChild(friendEntry);
        }
      }

      if (friend && friend.status == "requested") {
        // Check if a new friend request needs to be added to the list
        if (!requestEntries.some((entry) => entry.id.endsWith(user))) {
          requestList.appendChild(createRequestEntry(user));
        }
      } else {
        // Check if a friend request got accepted or denied, and needs to be removed from the list
        const requestEntry = requestEntries.find((entry) =>
          entry.id.endsWith(user)
        );
        if (requestEntry) {
          requestList.removeChild(requestEntry);
        }
      }
    }
  });
}

function createFriendEntry(name) {
  // Construct new entry for the friendlist
  const entry = document.createElement("li");
  entry.className = "friendEntry";

  const anchor = document.createElement("a");
  anchor.setAttribute("href", "chat.php?friend=" + name);
  anchor.innerText = name;

  const span = document.createElement("span");
  span.innerText = "2";
  // Hide span when there are no new messages
  span.style.visibility = "hidden";

  entry.appendChild(anchor);
  entry.appendChild(span);
  return entry;
}

function createRequestEntry(name) {
  // Construct new incoming friend request
  //requestForm.action = "friends.php?baum=true";
  const requestForm = document.createElement("form");
  requestForm.id = "requestForm-" + name;
  requestForm.method = "POST";
  const entry = document.createElement("li");
  entry.className = "requestEntry";
  entry.id = "requestEntry-" + name;

  const outerDiv = document.createElement("div");
  outerDiv.className = "mediaBreak";

  const bold = document.createElement("b");
  bold.innerText = name;

  const innerDiv = document.createElement("div");

  const acceptButton = document.createElement("button");
  acceptButton.innerText = "Accept";
  acceptButton.type = "button";
  acceptButton.name = "action";
  acceptButton.value = "accept-friend";
  //acceptButton.setAttribute("value", "accept-friend");
  //acceptButton.setAttribute("action", "friends.php?action=accept-friend&user=" + name);
  //acceptButton.setAttribute("type", "submit");
  acceptButton.setAttribute("onclick", "friendRequestAccept(`" + name + "`)");
  const rejectButton = document.createElement("button");
  rejectButton.innerText = "Reject";
  //rejectButton.setAttribute("value", "reject-friend");
  //rejectButton.setAttribute("action", "friends.php?action=reject-friend&user=" + name);
  rejectButton.setAttribute("type", "button");
  rejectButton.setAttribute("onclick", "friendRequestReject(`" + name + "`)");

  innerDiv.appendChild(acceptButton);
  innerDiv.appendChild(rejectButton);
  outerDiv.innerText = "Friend request from ";
  outerDiv.appendChild(bold);
  outerDiv.appendChild(innerDiv);
  requestForm.appendChild(outerDiv);
  entry.appendChild(requestForm);
  return entry;
}

function friendRequestAccept(name) {
  // To be implemented
  console.log("Accepting friend request... accept " + name);
  fetch("friends.php?action=accept-friend&user=" + name).then((response) => {
    if (response.ok) {
      console.log("Friend request accepted.");
    } else {
      console.error("Error accepting friend request.");
    }
  });
}

function friendRequestReject(name) {
  // To be implemented
  console.log("Rejecting friend request... reject " + name);
  fetch("friends.php?action=reject-friend&user=" + name).then((response) => {
    if (response.ok) {
      console.log("Friend request rejected.");
    } else {
      console.error("Error rejecting friend request.");
    }
  });
}
