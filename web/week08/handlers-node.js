const url = require('url');
const statusCodes = require('./status-node.js');

module.exports = {
    /**
     * HANDLE -> HOME
     * Returns the homepage.
     * @returns A simple reply object (status, HTTP header, and content)
     */
    home: function() {
        return {
            status: statusCodes.SUCCESS,
            header: {
                'Content-Type': 'text/html'
            },
            content: '<h1>Welcome to the Home Page</h1>'
        };
    },

    /**
     * HANDLE -> SIMPLE DATA
     * Returns some simple JSON data.
     * @returns A simple reply object (status, HTTP header, and content)
     */
    simpleData: function() {
        let data = {
            'name': 'Jimmy Downer',
            'class': 'cs313'
        };

        return {
            status: statusCodes.SUCCESS,
            header: {
                'Content-Type': 'application/json' 
            },
            content: JSON.stringify(data)
        };
    },

    /**
     * HANDLE -> GO TO GITHUB.IO
     * @returns A simple reply object that redirects to GitHub
     */
    goGithubIO: function() {
        return {
            status: statusCodes.PERMANENT_REDIRECT,
            header: {
                'Location': 'https://ascenderx.github.io'
            },
            content: null
        };
    },

    /**
     * HANDLE -> ENCRYPT W/ VIGENÈRE
     * Performs a simple vigenère encryption on the request data.
     * @param request The inbound HTTP request
     * @returns       A simple reply object (status, HTTP header, and content)
     * 
     * The URL parameters are as follows:
     * @var key    The cipher key
     * @var input  The cipher input to encrypt/decrypt
     * @var mode   (Optional) The cipher mode: "encrypt" (default) or "decrypt"
     * @var format (Optional) The output format: "text" (default) or "json"
     */
    encryptVigenere: function(request) {
        const MODE_ENCRYPT = 0;
        const MODE_DECRYPT = 1;
        const FORMAT_TEXT  = 0;
        const FORMAT_JSON  = 1;

        let location = url.parse(request.url, true);
        let query = location.query;
        let format = FORMAT_TEXT;
        let mode = MODE_ENCRYPT;
        let valid = true;
        let status;
        let content;

        // check URL input parameter (required)
        if (!('input' in query) || !query.input) {
            valid = false;
            content = 'Missing "input" parameter';
        // check URL key parameter (required)
        } else if (!('key' in query) || !query.key) {
            valid = false;
            content = 'Missing "key" parameter';
        // check optional URL parameters
        } else {
            // if URL format parameter is present, then make sure it's valid
            if ('format' in query) {
                switch ((query.format + '').trim().toLowerCase()) {
                    case 'default':
                    case 'text':
                        format = FORMAT_TEXT;
                        break;
                    
                    case 'json':
                        format = FORMAT_JSON;
                        break;

                    case 'null':
                    case 'undefined':
                    case '':
                        valid = false;
                        content = 'Missing output format';
                        break;
                    
                    default:
                        valid = false;
                        content = `Invalid output format "${query.format}"`;
                }
            }

            // if URL mode parameter is present, then make sure it's valid
            if ('mode' in query) {
                switch ((query.mode + '').trim().toLowerCase()) {
                    case 'default':
                    case 'encrypt':
                        mode = MODE_ENCRYPT;
                        break;
                    
                    case 'decrypt':
                        mode = MODE_DECRYPT;
                        break;
                    
                    case 'null':
                    case 'undefined':
                    case '':
                        valid = false;
                        content = 'Missing cipher mode';
                        break;
                    
                    default:
                        valid = false;
                        content = `Invalid cipher mode "${query.mode}"`;
                }
            }
        }

        // if URL parameters were invalid, then set the status to BAD REQUEST
        // and don't attempt to cipher
        if (!valid) {
            status = statusCodes.BAD_REQUEST;
        // otherwise, proceed with the cipher
        } else {
            status = statusCodes.SUCCESS;

            const CHAR_CODE_A = ('A').charCodeAt(0);

            let text = query.input.toUpperCase();
            let key = stripNonAlpha(query.key.toUpperCase());
            let output = '';
            let k = 0;
            for (let t = 0; t < text.length; t++) {
                // if it's not a standard Roman letter, then add it to the
                // output and keep going, but don't increment the key index
                if (!isAlpha(text.charAt(t))) {
                    output += text.charAt(t);
                    continue;
                }

                let codeT = text.charCodeAt(t) - CHAR_CODE_A + 1;
                let codeK = key.charCodeAt(k) - CHAR_CODE_A + 1;
                let codeN;

                // if encrypting, then add the codes together and wrap around
                // the alphabet, with 'A' being 1
                if (mode === MODE_ENCRYPT) {
                    codeN = codeT + codeK;
                    // if larger than 'Z' (26), then keep subtracting 26 until it's
                    // inside the alphabet range
                    while (codeN > 26) {
                        codeN -= 26;
                    }
                // if decrypting, then subtract the key code from the input
                // code and wrap around the alphabet, with 'A' being 1
                } else if (mode === MODE_DECRYPT) {
                    codeN = codeT - codeK;
                    // if smaller than 'A' (1), then keep adding 26 until it's inside
                    // the alphabet range
                    while (codeN <= 0) {
                        codeN += 26;
                    }
                }

                output += String.fromCharCode(codeN + CHAR_CODE_A - 1);

                // increment and wrap the key index counter
                k = (k + 1) % key.length;
            }

            // determine what format to return the output as
            if (format === FORMAT_JSON) {
                content = JSON.stringify({
                    output: output
                });
            } else {
                content = output;
            }
        }

        // determine what Content-Type to set the HTTP header to
        let type;
        if (format === FORMAT_JSON) {
            type = 'application/json';
        } else {
            type = 'text/html';
        }

        return {
            status: status,
            header: {
                'Content-Type': type
            },
            content: content
        };
    },

    /**
     * HANDLE -> NOT FOUND
     * Sends a simple 404 page.
     * @returns A simple reply object (status, HTTP header, and content)
     */
    notFound: function() {
        return {
            status: statusCodes.NOT_FOUND,
            header: {
                'Content-Type': 'text/html'
            },
            content: 'Page Not Found'
        };
    }
};

/**
 * IS ALPHABETICAL CHARACTER
 * Performs a RegExp test on a string to determine if it is
 * a (single) alphabetic character.
 * @param char The character string to test
 * @returns    A boolean of whether or not it is singular and alphabetic
 */
function isAlpha(char) {
    return /^[A-Za-z]{1}$/.test(char);
}

/**
 * STRIP NON-ALPHABETIC CHARACTERS
 * @param text The text to strip
 * @returns    The stripped string
 */
function stripNonAlpha(text) {
    let output = '';
    for (let t = 0; t < text.length; t++) {
        let ch = text.charAt(t);
        if (isAlpha(ch)) {
            output += ch;
        }
    }

    return output;
}