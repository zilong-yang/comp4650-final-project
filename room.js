const fs = require('fs');
window.onload = function () {

    // readHistory();
    alert("0");
    let roomID = document.getElementById("room-id").value;
    let historyFile = roomID + ".txt";

    alert("1")
    fs.readFile(historyFile, function(err, data) {
        document.getElementById("log").innerHTML = data.toString();
    });

    if (typeof(EventSource) !== "undefined") {
        let sse_players = new EventSource("update_players.php");
        sse_players.onmessage = function (event) {
            document.getElementById("players-list").innerHTML = event.data;
        };

        let sse_history = new EventSource("read_history");
        sse_history.onmessage = function (event) {
            document.getElementById("log").innerHTML = event.data;
        }
    } else {
        alert("Browser does not support EventSource");
    }

    let bidButton = document.getElementById("bid-button");
    bidButton.onclick = function (e) {
        let bidInput = document.getElementById("bid-input");
        let bid = bidInput.value;

        let log = document.getElementById("log");
        let message;
        if (bid.length === 0) {
            e.preventDefault();
            message = "<div class='message error'>Please enter your bid</div>";
        } else if (isNaN(bid)) {
            e.preventDefault();
            message = "<div class='message error'>Please enter numbers only</div>";
        } else {
            e.preventDefault();
            message = "<div class='message'>You bid " + bid + "</div>";
        }

        fs.writeFile(historyFile, message, (err => console.error(err.toString())));

        // log.innerHTML += message;

        bidInput.value = '';
    };
};

// function readHistory() {
//     let xmlHttp = new XMLHttpRequest();
//     xmlHttp.open("GET", "read_history.php", true);
//     xmlHttp.send();
//
//     xmlHttp.onreadystatechange = function () {
//         if (this.state === 4 && this.status === 200) {
//             document.getElementById("log").innerHTML = xmlHttp.responseText;
//         }
//     }
// }