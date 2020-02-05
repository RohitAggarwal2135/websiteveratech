function submitFunction() {
    let api_directory = "/api";
    let route = "/postadd";
    let uri = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + api_directory + route;
    document.getElementById('test').innerText = uri;
    $.ajax({
        url: uri,
        data: $('#formId').serialize(),
        type: 'POST',
        error: function (XMLHttpRequest) {
            console.log(XMLHttpRequest.status);
            console.log(XMLHttpRequest.responseText);
            alert("Data not saved.");
        },
        success: function (response) {
            console.log(response);
            alert("Data Saved.");
        }
    });
}
