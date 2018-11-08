const process = require('process');
const func = require('./team06-module-node.js');

let dir = process.argv[2];
let ext = process.argv[3];
func(dir, ext, (err, list) => {
    if (err) {
        return console.error(err);
    }

    for (let filename of list) {
        console.log(filename);
    }
});