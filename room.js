window.onload = function () {
    if (typeof(EventSource) !== "undefined") {
        let sse_players = new EventSource("update_players.php");
        sse_players.onmessage = function (event) {
            document.getElementById("players-list").innerHTML = event.data;
        };
    } else {
        alert("Browser does not support EventSource");
    }

    let bidButton = document.getElementById("bid-button");
    bidButton.onclick = function (e) {
        let bidInput = document.getElementById("bid-input");
        let bid = bidInput.value;

        let log = document.getElementById("log");
        if (bid.length === 0) {
            e.preventDefault();
            log.innerHTML += "<div class='message error'>Please enter your bid</div>";
        } else if (isNaN(bid)) {
            e.preventDefault();
            log.innerHTML += "<div class='message error'>Please enter numbers only</div>";
        } else {
            e.preventDefault();
            log.innerHTML += "<div class='message'>You bid " + bid + "</div>";
        }

        bidInput.value = '';
    };
}