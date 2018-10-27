function viewAssign(id) {
    let form = document.forms.namedItem(`form-${id}`);
    let data = new FormData(form);
    let dataObj = {};
    for (let datum of data) {
        let key = datum[0];
        let value = datum[1];
        dataObj[key] = value;
    }

    const STATUS_SUCCESS = 200;
    const STATUS_EMPTY = 204;
    const STATUS_INVALID = 406;
    jQuery.ajax({
        url: 'view-assign.php',
        method: 'get',
        data: dataObj,
        success: (data, textStatus, xhr) => {
            if (xhr.status == STATUS_SUCCESS) {
                console.log(`${data}`);
            } else if (xhr.status == STATUS_EMPTY) {
                console.log(`No records found`);
            }
        }
    });
}