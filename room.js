$(function () {
    if (typeof (EventSource) === "undefined") {
        throw new Error("Browser doe snot support EventSource");
    }

    let sse_players = new EventSource("update_players.php");
    sse_players.onmessage = function (event) {
        $("#players-list").html(event.data);
    };

    $("#bid-button").on("click", function () {
        let bid = $("#bid-input").val();
        let msg;
        if (bid.length === 0) {
            msg = "<div class='message error'>Please enter your bid</div>";
            $("#log").append(msg);
        } else if (isNaN(bid)) {
            msg = "<div class='message error'>Please enter numbers only</div>";
            $("#log").append(msg);
        } else {
            msg = "<div class='message'>You bid " + bid + "</div>";
            $.post(
                "update_history.php",
                {
                    message: msg
                },
                function (data) {
                    alert(data.toString());
                }
            );
            $("#log").append(msg);
        }
    })


    let sse_history = new EventSource("read_history.php");
    sse_history.onmessage = function (event) {
        let log = event.data.toString();
        if (log !== "<br />") {
            $("#log").html(event.data);
        }
    }

    // $("#test").text("jQuery test");
});