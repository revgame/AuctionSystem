<!--This function is to show the data from a live search-->
function showHint(str){
    if (str.length == 0){
        document.getElementById("txtHint").innerHTML = "";
        return "";
    }
    else {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            <!--this will check that the state and status is ready-->
            if (this.readyState == 4 && this.status == 200){
                var uic = document.getElementById("txtHint")
                uic.innerHTML = "";
                let txt = JSON.parse(this.responseText);

                <!--This function then creates an list of the data using JSON-->
                txt.forEach(function (obj) {
                    let container = document.createElement("li");
                    container.innerHTML= '<a href="showItem.php?id=' + obj._itemId + '">' + obj._itemName + '</a>' + ' ' + '<img src ="images/' + obj._images + '" width="50px" height="50px">';
                    uic.appendChild(container);
                })
            }
        };
        xmlhttp.open("GET", "livesearch.php?q=" + str, true);
        xmlhttp.send();
    }
}