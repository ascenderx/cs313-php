const process = require('process');
const http = require('http');
const fs = require('fs');

let port = process.argv[2];
let file = process.argv[3];

let server = http.createServer(function listen(request, response) {
    let fin = fs.createReadStream(file);
    fin.pipe(response);
});
server.listen(port);