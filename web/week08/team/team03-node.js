const fs = require('fs');

let arg = process.argv[2];
let buf = fs.readFileSync(arg);

const ENDL = '\n'.charCodeAt(0);
let count = 0;
for (let val of buf.values()) {
    if (val === ENDL) {
        count++;
    }
}

console.log(count);
