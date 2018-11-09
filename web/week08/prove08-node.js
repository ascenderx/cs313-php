/**
 * BUILTIN IMPORTS
 */
const http = require('http');
const url = require('url');

/**
 * LOCAL IMPORTS
 */
const handlers = require('./handlers-node.js');

/**
 * CONSTANTS
 * @const PORT   The TCP port to listen to
 * @const ROUTES A map of URL routes to handler functions
 */
const PORT = 8888;
const ROUTES = {
    '/': handlers.home,
    '/home': handlers.home,
    '/getData': handlers.simpleData,
    '/games': handlers.goGithubIO
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
        handle = handlers.notFound;
    }

    // handle the request and reply
    let reply = handle(request);
    response.writeHead(reply.status, reply.header);
    response.end(reply.content);
}

// start the server
http.createServer(onRequest).listen(PORT);