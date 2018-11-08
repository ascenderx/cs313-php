const t2map = require('/usr/local/lib/node_modules/learnyounode/node_modules/through2-map/index.js');
const http = require('http');
const process = require('process');

let port = process.argv[2];

let server = http.createServer(function listen(request, response) {
    request
    .pipe(t2map((str) => str.toString().toUpperCase()))
    .pipe(response);
});
server.listen(port);