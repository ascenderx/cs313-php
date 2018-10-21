CREATE TABLE students (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    username    varchar(64) UNIQUE NOT NULL,
    password    varchar(64) NOT NULL
);

-- CREATE TABLE categories (
--     id          SERIAL PRIMARY KEY,
--     name        varchar(64)
-- );

-- CREATE TABLE courses (
--     eduid       varchar(16) UNIQUE NOT NULL
-- ) INHERITS (categories);

CREATE TABLE courses (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    eduid       varchar(16) UNIQUE NOT NULL
);

CREATE TABLE assignments (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    duedate     date,
    course      int REFERENCES courses (id) NOT NULL,
    student     int REFERENCES students (id) NOT NULL
);

CREATE TYPE status AS enum (
    'pending', 'ready', 'running', 'paused',
    'completed', 'cancelled'
);

CREATE TABLE tasks (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    description text,
    duration    interval NOT NULL,
    preemptable boolean NOT NULL,
    required    boolean NOT NULL,
    status      status NOT NULL,
    assignment  int REFERENCES assignments (id) NOT NULL
);
