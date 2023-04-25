<!--This function is to show the status of the site-->
function showStatus(str, text) {
    var xhttp;
    if (str == "") {
        document.getElementById("status").innerHTML = "Rev";
        return;
    }
    <!--send data to the php file to acquire data and get the response-->
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            text.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "status.php?f=" + str, true);
    xhttp.send();
}

