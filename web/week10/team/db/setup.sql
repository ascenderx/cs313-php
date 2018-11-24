CREATE TABLE people (
    id          SERIAL PRIMARY KEY,
    firstname   VARCHAR(16),
    lastname    VARCHAR(16),
    dob         DATE
);

CREATE TABLE relationships (
    id          SERIAL PRIMARY KEY,
    parent      INTEGER REFERENCES people (id),
    child       INTEGER REFERENCES people (id)
);
