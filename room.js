$(function () {
    $(".error").hide();

    if (typeof (EventSource) === "undefined") {
        throw new Error("Browser doe snot support EventSource");
    }

    let sse_players = new EventSource("update_players.php");
    sse_players.onmessage = function (event) {
        $("#players-list").html(event.data);
    };

    let sse_history = new EventSource("read_history.php");
    sse_history.onmessage = function (event) {
        let log = event.data.toString();
        if (log !== "<br />") {
            $("#log").html(event.data);
        }
    }

    $("#bid-button").on("click", function () {
        let bidInput = $("#bid-input");
        let bid = bidInput.val();
        let msg;
        if (bid.length === 0) {
            let error = $("#error-empty");
            fadeInOut(error);
        } else if (isNaN(bid)) {
            let error = $("#error-invalid");
            fadeInOut(error);
        } else {
            msg = "<div class='message'>You bid " + bid + "</div>";
            $.post(
                "update_history.php",
                {
                    message: msg
                }
            );
            $("#log").append(msg);
        }

        bidInput.val("");
    })

    // $("#test").text("jQuery test");
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