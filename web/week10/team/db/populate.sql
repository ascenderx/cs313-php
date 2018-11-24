INSERT INTO people (firstname, lastname, dob) VALUES
      ('James', 'Downer', '06/22/1992')
    , ('Emily', 'Hanson', '10/30/1996')
    , ('Jim', 'Downer', '02/28/1947')
    , ('Clara', 'Downer', '04/24/1950')
    ;

INSERT INTO relationships (child, parent) VALUES
      ((SELECT (id) FROM people WHERE firstname = 'James'), (SELECT (id) FROM people WHERE firstname = 'Jim'))
    , ((SELECT (id) FROM people WHERE firstname = 'James'), (SELECT (id) FROM people WHERE firstname = 'Clara'))
    ;
