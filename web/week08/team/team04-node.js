const fs = require('fs');

let arg = process.argv[2];
fs.readFile(arg, func);

function func(err, buf) {
    if (err) {
        console.error(err);
        return;
    }
    
    const ENDL = '\n'.charCodeAt(0);
    let count = 0;
    for (let val of buf.values()) {
        if (val === ENDL) {
            count++;
        }
    }
    
    console.log(count);
}
