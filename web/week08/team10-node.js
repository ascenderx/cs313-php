const process = require('process');
const net = require('net');

let port = process.argv[2];
let server = net.createServer(function listen(socket) {
    socket.end(getDateTime());
});
server.listen(port);

function getDateTime() {
    let now = new Date();
    let YYYY = now.getFullYear();
    let MM = now.getMonth() + 1;
    let DD = now.getDate();
    let hh = now.getHours();
    let mm = now.getMinutes();

    MM = padTwoZeros(MM);
    DD = padTwoZeros(DD);
    hh = padTwoZeros(hh);
    mm = padTwoZeros(mm);

    return `${YYYY}-${MM}-${DD} ${hh}:${mm}\n`;
}

function padTwoZeros(val) {
    val = val.toString();
    return val.padStart(2, '0');
}