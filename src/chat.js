// Chatpartner einmalig beim Laden speichern
const chatpartner = (() => {
    const url = new URL(window.location.href);
    return url.searchParams.get("friend");
})();

function listMessages() {
    fetch("ajax_load_messages.php?to=" + chatpartner)
        .then((response) => response.json())
        .then((data) => {
            formatMessages(data);
        });
}

function formatMessages(data) {
    let messagesContainer = document.getElementById("messages");
    messagesContainer.innerHTML = ""; // Clear existing messages

    data.forEach(function (message) {
        let messageElement = document.createElement("p");
        messageElement.innerHTML = message.from + ": " + message.msg + "<br/>";
        messagesContainer.appendChild(messageElement);
    });
}

function onSendMessageButtonClicked() {
    let messageInput = document.getElementById("message-input");
    let messageText = messageInput.value;

    let data = {
        msg: messageText,
        to: chatpartner
    };

    //send_messages(data);
    fetch("ajax_send_message.php", {
        method: "POST",
        
        body: JSON.stringify(data) // Send JSON data
    }).then((response) => {
        if (response.ok) {
            console.log("Message sent successfully");
        } else {
            console.error("Error sending message");
        }
    });

    messageInput.value = ""; // Reset the input field
}

function send_messages(data) { // obsolete because of php
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("done...");
        }
    };
    xmlhttp.open("POST", backendUrl + "/message", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', 'Bearer ' + token);

    let jsonString = JSON.stringify(data); // Serialize as JSON
    xmlhttp.send(jsonString); // Send JSON-data to server
}

let chatHeader = document.getElementById("chat-header");
chatHeader.innerText = "Chat with " + chatpartner;
//Jede Sekunde neu laden, um eventuelle Aktualisierungen zu visualisieren.
listMessages();
setInterval(listMessages, 1000);
