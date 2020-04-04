window.onload = function () {
    let create = document.getElementById("create-button");
    create.onclick = function (e) {
        let username = document.getElementById("create-name");
        if (username.value.length === 0) {
            e.preventDefault();
            alert("Name must not be empty");
        }
    };

    let join = document.getElementById("join-button");
    join.onclick = function (e) {
        let username = document.getElementById("join-name");
        if (username.value.length === 0) {
            e.preventDefault();
            alert("Enter a name to join");
        } else {
            let code = document.getElementById("join-code");
            if (code.value.length === 0) {
                e.preventDefault();
                alert("Enter a room code to join");
            }
        }
    };

    let joinCode = document.getElementById("join-code");
    joinCode.onclick = function () {
        joinCode.focus();
    }
};