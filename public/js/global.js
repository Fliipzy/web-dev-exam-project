let messageBoxes = document.querySelectorAll("div.message");

messageBoxes.forEach(messageBox => {
    messageBox.getElementsByTagName("span")[0].addEventListener("click", function() {
        messageBox.hidden = true;
    });
});

