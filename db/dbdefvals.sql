INSERT INTO students (name, username, password) VALUES
    ('Timmy', 'timmy2048', 'thisIsAPASSWORD');

INSERT INTO courses (name, eduid) VALUES
    ('Web Engineering I', 'CS 213'),
    ('Web Engineering II', 'CS 313'),
    ('Full Web Stack Development', 'CIT 366'),
    ('Software Design and Development', 'CS 246');

-- Timmy's Assignments
INSERT INTO assignments (name, duedate, course, student) VALUES
    ('CS 213 Prove05', '2018-Oct-20', (SELECT id FROM courses WHERE eduid='CS 213'), (SELECT id FROM students WHERE name='Timmy')),
    ('CS 313 Prove05', '2018-Oct-20', (SELECT id FROM courses WHERE eduid='CS 313'), (SELECT id FROM students WHERE name='Timmy')),
    ('CIT 366 Prove05 Submission', '2018-Oct-20', (SELECT id FROM courses WHERE eduid='CIT 366'), (SELECT id FROM students WHERE name='Timmy')),
    ('CIT 366 Prove05 Quiz', '2018-Oct-22', (SELECT id FROM courses WHERE eduid='CIT 366'), (SELECT id FROM students WHERE name='Timmy')),
    ('CS 246 Prove05 Submission', '2018-Oct-20', (SELECT id FROM courses WHERE eduid='CS 246'), (SELECT id FROM students WHERE name='Timmy')),
    ('CS 246 Prove05 Assessment', '2018-Oct-20', (SELECT id FROM courses WHERE eduid='CS 246'), (SELECT id FROM students WHERE name='Timmy')),
    ('CS 246 Ponder05', '2018-Oct-20', (SELECT id FROM courses WHERE eduid='CS 246'), (SELECT id FROM students WHERE name='Timmy'));

-- Timmy's Assignments: CS 213
INSERT INTO tasks (name, duration, preemptable, required, status, assignment) VALUES
    ('Build JS template', 'PT0H5M0S', FALSE, TRUE, 'completed', (SELECT id FROM assignments WHERE name='CS 213 Prove05')),
    ('Write JS code', 'PT0H30M0S', FALSE, TRUE, 'completed', (SELECT id FROM assignments WHERE name='CS 213 Prove05'));

-- Timmy's Assignments: CS 313
INSERT INTO tasks (name, duration, preemptable, required, status, assignment) VALUES
    ('Cleanup DBSetup', 'PT0H15M0S', FALSE, TRUE, 'completed', (SELECT id FROM assignments WHERE name='CS 313 Prove05')),
    ('Insert values', 'PT0H45M0S', FALSE, TRUE, 'running', (SELECT id FROM assignments WHERE name='CS 313 Prove05')),
    ('Update Heroku', 'PT0H5M0S', FALSE, TRUE, 'pending', (SELECT id FROM assignments WHERE name='CS 313 Prove05')),
    ('Build PHP', 'PT1H0M0S', TRUE, TRUE, 'pending', (SELECT id FROM assignments WHERE name='CS 313 Prove05')),
    ('Test & submit', 'PT0H20M0S', FALSE, TRUE, 'pending', (SELECT id FROM assignments WHERE name='CS 313 Prove05'));
