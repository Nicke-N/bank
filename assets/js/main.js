let rates = getJSON("https://api.exchangeratesapi.io/latest");
for(currency in rates.rates) {
    let span = document.createElement("span");
    span.textContent = currency + ": " + rates.rates[currency] + " ";
    document.getElementById("rates").appendChild(span);

}

function loadJSON(file, callback) {

    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', file, false);
    xobj.onreadystatechange = () => {
        if (xobj.readyState == 4 && xobj.status == "200") { //readystate 4 = done && status = done

            callback(xobj.responseText);

        }
    }
    xobj.send(null);

}

function getJSON(file) {
    let result = null;

    loadJSON(file, function (response) {
        result = JSON.parse(response);
    });
    return result;
}
function sendcash(sender, recipient, amount) {
    
    $.ajax({
        url: "/assets/controllers/exchange.php",
        method:"PUT",
        data:{sender:sender, recipient:recipient, amount:amount},
        datatype:"text",
        success: function (data) {
            console.log(data);
        }
    })
}


/*
document.addEventListener("DOMContentLoaded", function () {
    var container = document.getElementById("accContainer");
    var accountNumber = document.getElementById("accountNumber").value;
    
    var req = new XMLHttpRequest();
    req.open('GET', '../getUsers.php', true);
    req.onload = function() {
        var response = JSON.parse(req.responseText);
        if (response.users != null || undefined) {
            renderHTML(`<ul>`)
            for (var i = 0; i < response.users.length; i++) {
                if (response.users[i].accountNumber != accountNumber) {
                    renderHTML(`<form action="/transRedirectPage.php" method="POST">
                    <li>
                        <div id="userAccounts">
                        <input value="${response.users[i].accountNumber}" name="accountNumber" hidden>
                        <p><span class="boldType">Name:</span> ${response.users[i].firstName} ${response.users[i].lastName}</p>
                        <p><span class="boldType">Account number:</span> ${response.users[i].accountNumber} <button type="submit">Make transfer</button></p>
                    </div>
                    </li>
                    </form>`);
                }                
            }         
            renderHTML(`</ul>`)   
        } else {
            renderHTML(`<h1>Could not load users</h1>`)
        }
    }
    req.send();

    function renderHTML(data) {
        container.insertAdjacentHTML('afterbegin', data);
    }
})
*/