/*window.onload = function () {
    setInterval(init, 1000);

    function init() {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("players-list").innerHTML = xmlHttp.responseText;
            }
        };

        xmlHttp.open("GET", "current_players.php", true);
        xmlHttp.send();
    }
}*/

/*
window.onbeforeunload = function () {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.state === 4 && this.status === 200) {
            document.getElementById("players-list").innerHTML = xmlHttp.responseText;
        }
    }
    xmlHttp.open("GET", "quit.php", true);
    xmlHttp.send();
}
*/

window.onload = function () {
    if (typeof(EventSource) !== "undefined") {
        let source = new EventSource("server.php");
        source.onmessage = function (event) {
            document.getElementById("players-list").innerHTML = event.data;
        };
    } else {
        alert("Browser does not support EventSource");
    }
}