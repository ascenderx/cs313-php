const { Pool, Client } = require('pg');
const { promisify } = require('util');

module.exports = {
    getPerson: (request, response) => {
        let client = new Client({ password: 'abacus$$$#930' });
        let clientConnect = promisify(client.connect);
        let clientQuery = promisify(client.query);
        let urlQuery = request.query;

        const QUERY = "SELECT * FROM people WHERE id = $1;";
        const PARAMS = [urlQuery.id];
       
        client.connect((err) => {
            if (err) {
                return sendError(reponse, err);
            }

            client.query(QUERY, PARAMS, (err, res) => {
                if (err) { 
                    return sendError(response, err);
                }

                sendResponse(response, res.rows[0]);
            });
        });
    },

    getParents: (request, response) => {
        let client = new Client({ password: '0IA53eR762Ui' });
        let clientConnect = promisify(client.connect);
        let clientQuery = promisify(client.query);
        let urlQuery = request.query;

        const QUERY = "SELECT people.id, lastname, firstname, dob "
                    + "FROM people INNER JOIN relationships " 
                    + "ON people.id = relationships.parent "
                    + "WHERE relationships.child = $1;";
        const PARAMS = [urlQuery.id];

        client.connect((err) => {
            if (err) {
                return sendError(response, err);
            }

            client.query(QUERY, PARAMS, (err, res) => {
                if (err) {
                    return sendError(response, err);
                }

                sendResponse(response, res.rows);
            });
        });
    },

    getChildren: (request, response) => {
        let client = new Client({ password: '0IA53eR762Ui' });
        let clientConnect = promisify(client.connect);
        let clientQuery = promisify(client.query);
        let urlQuery = request.query;

        const QUERY = "SELECT people.id, lastname, firstname, dob "
                    + "FROM people INNER JOIN relationships "
                    + "ON people.id = relationships.child "
                    + "WHERE relationships.parent = $1;";
        const PARAMS = [urlQuery.id];

        client.connect((err) => {
            if (err) {
                return sendError(response, err);
            }

            client.query(QUERY, PARAMS, (err, res) => {
                if (err) {
                    return sendError(response, err);
                }

                sendResponse(response, res.rows);
            });
        });
    },
};

function sendError(response, err) {
    console.error(err);
    response.set('Content-Type', 'application/json');
    response.status(500);
    response.end(JSON.stringify(err));
}

function sendResponse(response, data, status) {
    status = status || 200;
    console.log(status, data);
    response.set('Content-Type', 'application/json');
    response.status(status);
    response.end(JSON.stringify(data));
}

