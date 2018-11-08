const http = require('http');
const url = require('url');

/**
 * CONSTANTS
 * @const PORT   The TCP port to listen to
 * @const ROUTES A map of URL routes to handler functions
 */
const PORT = 8888;
const ROUTES = {
    '/': handleHome,
    '/home': handleHome,
    '/getData': handleSimpleData,
};

/**
 * ON REQUEST
 * Callback for when a server connection is created.
 * @param request  The HTTP request, populated
 * @param response The HTTP response to populate
 */
function onRequest(request, response) {
    // get the path
    let location = url.parse(request.url, true);
    let pathname = location.pathname;

    // determine redirection based on the route
    let handle;
    if (pathname in ROUTES) {
        handle = ROUTES[pathname];
    } else {
        handle = handleNotFound;
    }

    // handle the request and reply
    let reply = handle(request);
    response.writeHead(reply.status, reply.header);
    response.end(reply.content);
}

/**
 * HANDLE -> HOME
 * Returns the homepage.
 * @returns A simply reply object (status, HTTP header, and content)
 */
function handleHome() {
    return {
        status: 200,
        header: {
            'Content-Type': 'text/html'
        },
        content: '<h1>Welcome to the Home Page</h1>'
    };
}

/**
 * HANDLE -> SIMPLE DATA
 * Returns some simple JSON data.
 * @returns A simply reply object (status, HTTP header, and content)
 */
function handleSimpleData() {
    let data = {
        'name': 'Jimmy Downer',
        'class': 'cs313'
    };

    return {
        status: 200,
        header: {
            'Content-Type': 'application/json' 
        },
        content: JSON.stringify(data)
    };
}

/**
 * HANDLE -> NOT FOUND
 * Sends a simple 404 page.
 * @returns A simply reply object (status, HTTP header, and content)
 */
function handleNotFound() {
    return {
        status: 404,
        header: {
            'Content-Type': 'text/html'
        },
        content: 'Page Not Found'
    };
}

// start the server
http.createServer(onRequest).listen(PORT);