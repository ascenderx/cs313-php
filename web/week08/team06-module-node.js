const fs = require('fs');
const path = require('path');

module.exports = (dir, ext, callback) => {
    fs.readdir(dir, listFiles);

    function listFiles(err, list) {
        if (err) {
            return callback(err);
        }

        let dotext = `.${ext}`;
        list = list.filter((file) => {
            return path.extname(filename) === dotext;
        });

        callback(null, list);
    }
}
