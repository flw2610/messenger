// Chatpartner einmalig beim Laden speichern
const chatpartner = (() => {
    const url = new URL(window.location.href);
    return url.searchParams.get("friend");
})();

function list_messages() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);
            formatMessages(data);
        }
    };
    xmlhttp.open("GET", backendUrl+"/message/"+chatpartner, true);
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', 'Bearer '+token);
    xmlhttp.send();
}

function formatMessages(data) {
    let messagesContainer = document.getElementById("messages");
    messagesContainer.innerHTML = ""; // Clear existing messages

    data.forEach(function(message) {
        let messageElement = document.createElement("p");
        messageElement.innerHTML = message.from + ": " + message.msg + "<br/>";
        messagesContainer.appendChild(messageElement);
    });
}

function onSendMessageButtonClicked() {
    let messageInput = document.getElementById("message-input");
    let messageText = messageInput.value;

    let data = {
        message: messageText,
        to: chatpartner
    };

    send_messages(data);

    messageInput.value = ""; // Reset the input field
}

function send_messages(data) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("done...");
        }
    };
    xmlhttp.open("POST", backendUrl+"/message", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', 'Bearer '+token);

    let jsonString = JSON.stringify(data); // Serialize as JSON
    xmlhttp.send(jsonString); // Send JSON-data to server
}

let chatHeader = document.getElementById("chat-header");
chatHeader.innerText = "Chat with " + chatpartner;
//Jede Sekunde neu laden, um eventuelle Aktualisierungen zu visualisieren.
setInterval(list_messages, 1000);
