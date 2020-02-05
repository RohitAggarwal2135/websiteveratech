function blogSomething() {
    let uri = window.location.protocol + "//" + window.location.hostname + "/someURL";
    $.ajax({
        url: uri,
        data: {},
        type: 'POST',
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.status);
            console.log(XMLHttpRequest.responseText);
        },
        success: function (data, textStatus, request) {
            document.getElementById('someId').value = data;
        }
    });
}
