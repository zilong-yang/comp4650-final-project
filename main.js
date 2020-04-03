window.onload = function () {
    let create = document.getElementById("create-button");

    create.onclick = function (e) {
        let username = document.getElementById("create-name");
        if (username.value.length === 0) {
            e.preventDefault();
            alert("Name must not be empty");
        }

        self.location = "room.php";
    };

    let join = document.getElementById("join-button");
    join.onclick = function () {
        alert("join clicked");
    };

    let joinCode = document.getElementById("join-code");
    joinCode.onclick = function () {
        joinCode.focus();
    }
};