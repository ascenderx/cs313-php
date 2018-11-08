const process = require('process');
const http = require('http');
const BufferList = require('/usr/local/lib/node_modules/learnyounode/node_modules/bl/bl');

let numFinished = 0;
let results = [null, null, null];
let urls = process.argv.slice(2, 5);
for (let u = 0; u < urls.length; u++) {
    let url = urls[u];
    http.get(url, (response) => {
        response.pipe(BufferList((err, buf) => {
            onEnd(err, buf, u);
        }));
    });
}

function onEnd(err, buf, index) {
    numFinished++;

    if (err) {
        console.error(err.getMessage());
    } else {
        results[index] = buf.toString();
    }

    if (numFinished === results.length) {
        results.forEach((result) => {
            console.log(result || '');
        });
    }
}