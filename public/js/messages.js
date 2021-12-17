function popmessage(elementId, message, type) {
    // get message element
    const messageElement = document.getElementById(elementId);
    
    // refresh classes & text
    messageElement.classList = `message ${type}`;
    messageElement.innerHTML = message + '<span class="close">🗙</span>';

    // add close event to message
    messageElement.querySelector("span").addEventListener("click", () => {
        messageElement.hidden = true;
    });

    // show
    messageElement.hidden = false;
}