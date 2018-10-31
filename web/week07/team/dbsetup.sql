CREATE DATABASE team07;
\c team07;

CREATE TABLE teach07_user (
    id          SERIAL PRIMARY KEY,
    username    VARCHAR(64) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL
);