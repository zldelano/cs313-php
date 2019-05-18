CREATE TABLE Notes_User (
    notes_user_id   SERIAL,
    name_first VARCHAR(40),
    name_last  VARCHAR(40),
    PRIMARY KEY (notes_user_id)
);

INSERT INTO Notes_User
    (name_first, name_last)
VALUES
    ('Alex', 'Bentley'),
    ('Zach', 'Delano');

CREATE TABLE Speaker (
    speaker_id      SERIAL,
    name_first      VARCHAR(40),
    name_middle     VARCHAR(40),
    name_last       VARCHAR(40),
    position        VARCHAR(100),
    PRIMARY KEY (speaker_id)
);

INSERT INTO Speaker 
    (name_first, name_middle, name_last, position)
VALUES  
    ('Dallin', 'H.', 'Oaks', 'First Counselor in the First Presidency'),
    ('Henry', 'B.', 'Eyring', 'Second Counselor in the First Presidency'),
    ('Russell', 'M.', 'Nelson', 'President of the Church of Jesus Christ of Latter-day Saints');

CREATE TABLE Session_Type (
    session_type_id SERIAL,
    session_type    VARCHAR(100),
    PRIMARY KEY (session_type_id)
);

INSERT INTO Session_Type
    (session_type)
VALUES  
    ('Saturday Morning'),
    ('Saturday Afternoon'),
    ('General Priesthood'),
    ('Sunday Morning');

CREATE TABLE Conference_Session (
    session_id      SERIAL,
    session_type_id SERIAL  REFERENCES  Session_Type(session_type_id),
    month           VARCHAR(20),
    year            INTEGER,
    PRIMARY KEY (session_id)
);

INSERT INTO conference_session
    (session_type_id, month, year)
VALUES
    (1, 'April', 2019),
    (2, 'April', 2019),
    (3, 'April', 2019),
    (4, 'April', 2019);

CREATE TABLE Talk (
    talk_id         SERIAL,
    speaker_id      SERIAL  REFERENCES Speaker(speaker_id),
    session_id      SERIAL  REFERENCES Conference_Session(session_id),
    title           VARCHAR(100),
    PRIMARY KEY (talk_id)
);

INSERT INTO talk
    (speaker_id, session_id, title)
VALUES
    (2, 1, 'A Home Where the Spirit of the Lord Dwells'),
    (3, 3, 'We Can Do Better and Be Better'),
    (3, 4, '\"Come, Follow Me\"'),
    (1, 2, 'The Sustaining of Church Officers');

CREATE TABLE Note (
    note_id         SERIAL,
    talk_id         SERIAL  REFERENCES Talk(talk_id),
    notes_user_id   SERIAL  REFERENCES Notes_User(notes_user_id),
    content         TEXT,
    date_updated    DATE,
    PRIMARY KEY (note_id)
);


INSERT INTO note
    (talk_id, notes_user_id, content, date_updated)
VALUES
    (1, 2, 'good talk---I have nothing really to say other than that', CURRENT_TIMESTAMP),
    (2, 2, 'blah blah blah', CURRENT_TIMESTAMP),
    (3, 1, 'lawdie dah', CURRENT_TIMESTAMP),
    (3, 2, 'what even is General Conference?', CURRENT_TIMESTAMP),
    (1, 1, 'Wait, who''s Joseph Smith?', CURRENT_TIMESTAMP);
