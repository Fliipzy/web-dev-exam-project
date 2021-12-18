function createToast(title, description, type, containerId) {
    let toastId = Date.now();
    let icon = "";
    switch (type) {
        case "success":
            icon = "check-circle";
            break;
        case "danger":
            icon = "times-circle";
            break;
        case "warning":
            icon = "exclamation-circle";
            break;
        case "primary":
            icon = "info-circle";
            break;
    }
    let toastHTML = `<div id='${toastId}' class="toast toast-${type} hide">
                    <span class="close"></span>
                    <div class="toast-icon">
                        <i class="fas fa-${icon}"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">
                            ${title}
                        </div>
                        <div class="toast-description">
                            ${description}
                        </div>
                    </div>
                </div>`

    document.getElementById(containerId).innerHTML += toastHTML;

    document.getElementById(toastId).querySelector("span").addEventListener("click", () => {
        document.getElementById(toastId).remove();
    });
    
    document.getElementById(toastId).classList.remove("hide");
    document.getElementById(toastId).classList.add("fade-in");

    // add timeouts for fade in and fade out animations
    setTimeout(() => {
        document.getElementById(toastId).classList.remove("fade-in");
    }, 300);

    setTimeout(() => {
        document.getElementById(toastId).classList.add("fade-out");
        setTimeout(() => {
            document.getElementById(toastId).remove();
        }, 200);
    }, 3000);
}