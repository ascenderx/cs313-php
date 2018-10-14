CREATE TABLE Students (
    id          SERIAL PRIMARY KEY,
    name        varchar(64)
);

CREATE TABLE Categories (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    student     int REFERENCES Students (id) NOT NULL
);

CREATE TABLE Courses (
    eduID       varchar(16) NOT NULL
) INHERITS (Categories);

CREATE TABLE Assignments (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    dueDate     date,
    category    int REFERENCES Categories (id) NOT NULL
);

CREATE TYPE Status AS enum (
    'pending', 'ready', 'running', 'paused',
    'completed', 'cancelled'
);

CREATE TABLE Tasks (
    id          SERIAL PRIMARY KEY,
    name        varchar(64),
    description text,
    duration    interval NOT NULL,
    preemptable boolean NOT NULL,
    required    boolean NOT NULL,
    status      Status NOT NULL,
    assignment  int REFERENCES Assignments (id) NOT NULL
);
