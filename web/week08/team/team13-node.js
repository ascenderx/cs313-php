const http = require('http');
const process = require('process');
const url = require('url');

let port = process.argv[2];
let server = http.createServer(function listen(request, response) {
    let location = url.parse(request.url, true);
    let timeObj;
    let unixTimeObj;
    switch (location.pathname) {
        case '/api/parsetime':
            timeObj = createTimeObject(location.query.iso);
            response.writeHead(200, {'Content-Type': 'application/json'});
            response.end(JSON.stringify(timeObj));
            break;

        case '/api/unixtime':
            unixTimeObj = createUnixTimeObject(location.query.iso);
            response.writeHead(200, {'Content-Type': 'application/json'});
            response.end(JSON.stringify(unixTimeObj));
            break;

        default:
            response.writeHead(404);
            response.end();
    }
});
server.listen(port);

function createTimeObject(isoVal) {
    let date = new Date(isoVal);
    return {
        hour: date.getHours(),
        minute: date.getMinutes(),
        second: date.getSeconds()
    };
}

function createUnixTimeObject(isoVal) {
    let date = new Date(isoVal);
    return {
        'unixtime': date.valueOf()
    };
}
