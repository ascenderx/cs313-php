const STATE_UNSENT = 0;
const STATE_OPENED = 1;
const STATE_HEADERS_RECEIVED = 2;
const STATE_LOADING = 3;
const STATE_DONE = 4;
const STATUS_SUCCESS = 200;
const STATUS_EMPTY = 204;
const STATUS_UNACCEPTABLE = 406;

function ajax(method, resource, data) {
    let xhr = new XMLHttpRequest();

    let promise = new Promise((resolve, reject) => {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == STATE_DONE) {
                if (xhr.status == STATUS_SUCCESS) {
                    resolve(xhr);
                } else {
                    reject(xhr);
                }
            }
        };
    });

    xhr.open(method, resource, true);
    xhr.send(data);
    
    return promise;
}

function ajaxGet(resource, data) {
    // construct GET URI parameters from data
    let params = '';
    let count = 0;
    for (let datum of data) {
        let key = encodeURIComponent(datum[0]);
        let value = encodeURIComponent(datum[1]);
        params += `${key}=${value}`;
        if (count++ > 0) {
            params += '&';
        }
    }
    let url = `${resource}?${params}`;

    // return the call to ajax()
    return new Promise((resolve, reject) => {
        ajax('GET', url, null)
        .then((xhr) => {
            resolve(xhr.responseText);
        })
        .catch((xhr) => {
            reject(xhr.status, xhr.responseText);
        });
    });
}

function ajaxPost(resource, data) {
    // return the call to ajax()
    return new Promise((resolve, reject) => {
        ajax('POST', resource, data)
        .then((xhr) => {
            resolve(xhr.responseText);
        })
        .catch((xhr) => {
            reject(xhr.status, xhr.responseText);
        });
    });
}