const process = require('process');
const http = require('http');

let url = process.argv[2];
http.get(url, (response) => {
    response.on('data', onData);
    response.on('error', onError);
    response.on('end', onEnd);
});

function onData(data) {
    console.log(data.toString());
}

function onError(error) {
    console.error(error.getMessage());
}

function onEnd() {
    process.exit();
}