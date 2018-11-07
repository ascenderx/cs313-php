const process = require('process');
const http = require('http');
const BufferList = require('/usr/local/lib/node_modules/learnyounode/node_modules/bl/bl');

let url = process.argv[2];
http.get(url, (response) => {
    response.pipe(BufferList(onEnd));
});

function onEnd(err, buf) {
    if (err) {
        return console.error(err.getMessage());
    }

    console.log(buf.length);
    console.log(buf.toString());
}