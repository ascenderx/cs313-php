const process = require('process');

let sum = 0;
for (let a = 2; a < process.argv.length; a++) {
    let arg = process.argv[a];
    sum += Number(arg);
}
console.log(sum);

