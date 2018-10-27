function viewAssign(id) {
    let form = document.forms.namedItem(`form-${id}`);
    let data = new FormData(form);
    let dataObj = {};
    for (let datum of data) {
        let key = datum[0];
        let value = datum[1];
        dataObj[key] = value;
    }

    jQuery.ajax({
        url: 'view-assign.php',
        method: 'get',
        data: dataObj,
        statusCode: {
            200: function(data) {
                console.log(data);
            },
            204: function() {
                console.log('No records found');
            },
            406: function() {
                console.log('Invalid request');
            }
        }
    });
}