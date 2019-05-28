-- Setup extensions
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- Create tables
DROP TABLE IF EXISTS teach06_scripture;
CREATE TABLE teach06_scripture (
   id       UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   book     VARCHAR(50)    NOT NULL,
   chapter  NUMERIC(3,0)   NOT NULL,
   verse    NUMERIC(3,0)   NOT NULL,
   content  TEXT           NOT NULL,

   -- key setup
   PRIMARY KEY (id)
);

DROP TABLE IF EXISTS teach06_topic;
CREATE TABLE teach06_topic (
   id       UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   name     VARCHAR(40)    NOT NULL,

   -- key setup
   PRIMARY KEY (id)
);

DROP TABLE IF EXISTS teach06_join_scripture_topic;
CREATE TABLE teach06_join_scripture_topic (
   scripture_id  UUID   NOT NULL,
   topic_id      UUID   NOT NULL,

   -- key setup
   FOREIGN KEY (scripture_id) REFERENCES teach06_scripture (id),
   FOREIGN KEY (topic_id)     REFERENCES teach06_topic (id)
);

-- inserting into teach06_scripture
INSERT INTO teach06_scripture
   (book, chapter, verse, content)
VALUES
   ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.'),
   ('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'),
   ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth btruth and clight, until he is glorified in truth and dknoweth all things.'),
   ('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');

-- inserting into teach06_topic
INSERT INTO teach06_topic
   (name)
VALUES
   ('Faith'), ('Sacrifice'), ('Charity');
