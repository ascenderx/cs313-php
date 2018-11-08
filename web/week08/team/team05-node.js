const process = require('process');
const fs = require('fs');
const path = require('path');

let dir = process.argv[2];
let ext = process.argv[3];
fs.readdir(dir, listFiles);

function listFiles(err, list) {
    if (err) {
        return console.error(err);
    }

    let dotext = `.${ext}`;
    for (let file of list) {
        let filename = file.toString();
        let fileext = path.extname(filename);
        if (dotext === fileext) {
            console.log(filename);
        }
    }
}
