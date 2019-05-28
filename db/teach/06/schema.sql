-- Setup extensions
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- Create tables
DROP TABLE IF EXISTS teach04_scripture;
CREATE TABLE teach04_scripture (
   id       UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   book     VARCHAR(50)    NOT NULL,
   chapter  NUMERIC(3,0)   NOT NULL,
   verse    NUMERIC(3,0)   NOT NULL,
   content  TEXT           NOT NULL,

   -- key setup
   PRIMARY KEY (id)
);

-- inserting into teach04_scripture
INSERT INTO teach04_scripture
   (book, chapter, verse, content)
VALUES
   ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.'),
   ('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'),
   ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth btruth and clight, until he is glorified in truth and dknoweth all things.'),
   ('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');

