// window.onload = function () {
//     let create = document.getElementById("create-button");
//     create.onclick = function (e) {
//         let username = document.getElementById("create-name");
//         if (username.value.length === 0) {
//             e.preventDefault();
//             alert("Name must not be empty");
//         }
//     };
//
//     let join = document.getElementById("join-button");
//     join.onclick = function (e) {
//         let username = document.getElementById("join-name");
//         if (username.value.length === 0) {
//             e.preventDefault();
//             alert("Enter a name to join");
//         } else {
//             let code = document.getElementById("join-code");
//             if (code.value.length === 0) {
//                 e.preventDefault();
//                 alert("Enter a room code to join");
//             }
//         }
//     };
//
//     let joinCode = document.getElementById("join-code");
//     joinCode.onclick = function () {
//         joinCode.focus();
//     }
// };

$(function () {
    let create = $("#create-button");
    create.click( function (event) {
        let username = $("#create-name").val();
        if (username.length === 0) {
            event.preventDefault();
            fadeInOut($("#error-empty-name"));
        }
    });

    let join = $("#join-button");
    join.click(function (event) {
        let username = $("#join-name").val();
        if (username.length === 0) {
            event.preventDefault();
            fadeInOut($("#error-empty-name"));
        }

        let code = $("#join-code").val();
        if (code.length !== 6 || isNaN(code)) {
            event.preventDefault();
            fadeInOut($("#error-invalid-code"));
        }
    });
});

function fadeInOut(element) {
    if (!element.is(':animated')) {
        element.fadeIn(300);
        element.fadeOut(3000);
    } else {
        element.stop();
        fadeInOut(element);
    }
}