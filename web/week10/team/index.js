/**
 * WEEK 10 Team Activity
 * PostgreSQL using Node.js
 *
 * @author James D. Downer
 * @since November 23, 2018
 * @version 1.0
 */

/**
 * IMPORTS : EXTERNAL & BUILT-IN
 */
const express = require('express');
const path = require('path');

/**
 * IMPORTS : LOCAL
 */
const endpoints = require('./modules/endpoints.js');

/**
 * CONSTANTS
 */
const PORT = process.env.PORT || 5000;
const STATIC_DIR = path.join(__dirname, 'public');
const VIEWS_DIR = path.join(__dirname, 'views');

/**
 * START SERVER
 */
express()
    .use(express.static(STATIC_DIR))
    .set('views', VIEWS_DIR)
    .set('view engine', 'ejs')
    .get('/', (req, res) => { res.sendfile(`${STATIC_DIR}/index.html`); })
    .get('/getPerson', endpoints.getPerson)
    .get('/getParents', endpoints.getParents)
    .get('/getChildren', endpoints.getChildren)
    .listen(PORT, () => console.log(`Listening on ${ PORT }`));
