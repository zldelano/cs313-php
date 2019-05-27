-- Setup extensions
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- -- Database creation
-- CREATE DATABASE service;

-- -- Connect to database
-- \c service;

-- Drop tables if they exist
DROP TABLE IF EXISTS service_job       CASCADE;
DROP TABLE IF EXISTS service_service   CASCADE;
DROP TABLE IF EXISTS service_employee  CASCADE;
DROP TABLE IF EXISTS service_vehicle   CASCADE;
DROP TABLE IF EXISTS service_job_info  CASCADE;
DROP TABLE IF EXISTS service_customer  CASCADE;
DROP TABLE IF EXISTS service_address   CASCADE;

-- Create tables
CREATE TABLE service_address (
   address_id        UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   city              VARCHAR(100)   NOT NULL,
   street            VARCHAR(100)   NOT NULL,
   zip               NUMERIC(5,0)   NOT NULL,
   state             CHAR(2)        NOT NULL,
   apt_number        NUMERIC(10,0)  DEFAULT NULL,

   -- key setup
   PRIMARY KEY (address_id)
);

CREATE TABLE service_customer (
   customer_email    VARCHAR(40)    NOT NULL,
   name_first        VARCHAR(30)    NOT NULL,
   name_second       VARCHAR(30)    NOT NULL,
   phone_primary     NUMERIC(11,0)  NOT NULL,
   phone_secondary   NUMERIC(11,0)  DEFAULT NULL,
   address_id        UUID           NOT NULL,

   -- key setup
   PRIMARY KEY (customer_email),
   FOREIGN KEY (address_id) REFERENCES service_address (address_id)
);

CREATE TABLE service_job_info (
   job_name          VARCHAR(40)    NOT NULL,
   cost              FLOAT          NOT NULL,
   description       TEXT           DEFAULT NULL,

   -- key setup
   PRIMARY KEY (job_name)
);

CREATE TABLE service_vehicle (
   vin               NUMERIC(17,0)  NOT NULL,
   color             VARCHAR(15)    NOT NULL,
   make              VARCHAR(30)    NOT NULL,
   model             VARCHAR(30)    NOT NULL,
   year              NUMERIC(4,0)   NOT NULL,
   owner             VARCHAR(40)    NOT NULL,

   -- key setup
   PRIMARY KEY (vin),
   FOREIGN KEY (owner)        REFERENCES service_customer (customer_email)
);

CREATE TABLE service_employee (
   username          VARCHAR(20)    NOT NULL,
   name_first        VARCHAR(30)    NOT NULL,
   name_second       VARCHAR(30)    NOT NULL,
   role              VARCHAR(15)    NOT NULL,

   -- key setup
   PRIMARY KEY (username),

   -- additional constraints
   CONSTRAINT is_valid_role CHECK (role IN ('advisor', 'technician', 'manager', 'valet'))
);

CREATE TABLE service_service (
   service_id        UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   customer_email    VARCHAR(40)    NOT NULL,
   vin               NUMERIC(17,0)  NOT NULL,
   advisor           VARCHAR(40)    NOT NULL,
   notes             TEXT,

   -- key setup
   PRIMARY KEY (service_id),
   FOREIGN KEY (customer_email)  REFERENCES service_customer (customer_email),
   FOREIGN KEY (vin)          REFERENCES service_vehicle (vin),
   FOREIGN KEY (advisor)      REFERENCES service_employee (username)
);

CREATE TABLE service_job (
   job_id            UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   service_id        UUID           NOT NULL,
   technician        VARCHAR(40)    NOT NULL,
   job_name          VARCHAR(40)    NOT NULL,
   time_start        TIMESTAMP      NOT NULL,
   time_end          TIMESTAMP,

   -- key setup
   PRIMARY KEY (job_id),
   FOREIGN KEY (service_id) REFERENCES service_service (service_id),
   FOREIGN KEY (technician) REFERENCES service_employee (username),
   FOREIGN KEY (job_name)   REFERENCES service_job_info (job_name)
);

-- insert statements
-- inserting into service_employee
INSERT INTO service_employee
   (username, name_first, name_second, role)
VALUES
   ('apowell', 'Adam', 'Powell', 'manager'),
   ('ogonzales', 'Oscar', 'Gonzales', 'advisor'),
   ('ctoomey', 'Chris', 'Toomey', 'advisor'),
   ('rlatimer', 'Rob', 'Latimer', 'advisor'),
   ('etejeda', 'Ed', 'Tejeda', 'technician');

-- inserting into service_address
INSERT INTO service_address
   (city, street, zip, state)
VALUES
   ('Redmond', '11115 156th PL NE', 98052, 'WA'),
   ('Scottsville', '2526  Sherman Street', 24590, 'VA'),
   ('Pleasant Hill', '249 Harter Street', 45359, 'OH');

-- inserting into service_customer
INSERT INTO service_customer
   (customer_email, name_first, name_second, phone_primary, phone_secondary, address_id)
VALUES
   ('zdelano@fakedomain.com', 'Zach', 'Delano', 4252299246, NULL, (SELECT address_id FROM service_address WHERE street='11115 156th PL NE')),
   ('jshea@fakedomain.com', 'Joseph', 'Shea', 7858503194, 7579333371, (SELECT address_id FROM service_address WHERE street='2526  Sherman Street')),
   ('dsweet@fakedomain.com', 'David', 'Sweet', 9376765240, 7409723894, (SELECT address_id FROM service_address WHERE street='249 Harter Street'));

-- inserting into service_vehicle
INSERT INTO service_vehicle
   (vin, color, make, model, year, owner)
VALUES
   (29471928566213456, 'silver', 'Ford', 'Focus', 2010, (SELECT customer_email FROM service_customer WHERE (name_first='Zach' AND name_second='Delano'))),
   (46598857982385012, 'grey', 'Ford', 'F150', 2017, (SELECT customer_email FROM service_customer WHERE (name_first='Zach' AND name_second='Delano'))),
   (75607300571823011, 'red', 'Jaguar', 'F-TYPE', 2020, (SELECT customer_email FROM service_customer WHERE (name_first='Joseph' AND name_second='Shea'))),
   (89827490182379050, 'red', 'Toyota', 'Prius', 2005, (SELECT customer_email FROM service_customer WHERE (name_first='David' AND name_second='Sweet')));

-- inserting into service_job_info
INSERT INTO service_job_info
   (job_name, cost, description)
VALUES
   ('5K Service', 49.99, 'Oil change, wiper fluid refill, brake inspection, tire inspection, tire rotation'),
   ('30K Service', 69.99, 'Oil change, wiper fluid refill, brake inspection, tire inspection, tire rotation, installation of new cabin and engine air filters'),
   ('Brake pad replacement (one axle)', 149.99, 'One brake pad is installed.'),
   ('Brake pad replacement (both axles)', 269.99, 'Two new brake pads are installed.'),
   ('Timing belt replacement', 699.99, 'The timing belt will be replaced.');

-- inserting into service_service
INSERT INTO service_service
   (customer_email, vin, advisor, notes)
VALUES
   (
      (SELECT customer_email FROM service_customer WHERE (name_first='Zach' AND name_second='Delano')),
      (SELECT vin FROM service_vehicle WHERE (owner=(SELECT service_customer.customer_email FROM service_customer WHERE (name_first='Zach' AND name_second='Delano'))) LIMIT 1),
      (SELECT username FROM service_employee WHERE (name_first='Oscar')),
      'Customer is furious right now'
   );

-- inserting int service_job
INSERT INTO service_job
   (service_id, technician, job_name, time_start, time_end)
VALUES
   (
      (SELECT service_service.service_id FROM service_service WHERE (notes='Customer is furious right now')),
      (SELECT service_employee.username FROM service_employee WHERE (name_first='Ed')),
      '5K Service',
      CURRENT_DATE - INTERVAL '25' MINUTE,
      NULL
   ),
   (
      (SELECT service_service.service_id FROM service_service WHERE (notes='Customer is furious right now')),
      (SELECT service_employee.username FROM service_employee WHERE (name_first='Ed')),
      'Timing belt replacement',
      CURRENT_DATE - INTERVAL '40' MINUTE,
      CURRENT_DATE - INTERVAL '25' MINUTE
   );

-- views
-- view: unfinished services
CREATE VIEW unfinished_services AS
   SELECT
      ss.service_id AS service_id, ss.customer_email AS customer_email, sj.job_name AS job_name, sj.technician AS technician, ji.cost AS cost, sj.time_end AS time_end
      -- ss.service_id, ss.customer_email, sj.job_name, sj.technician, ji.cost, sj.time_end
   FROM
      service_service AS ss
   LEFT JOIN service_job      AS sj ON ss.service_id=sj.service_id
   LEFT JOIN service_job_info AS ji ON sj.job_name=ji.job_name;

-- joins
-- join: customer address
SELECT
   (sc.name_first, sc.name_second, sa.street, sa.apt_number, sa.city, sa.state, sa.zip)
FROM
   service_customer as sc
JOIN
   service_address as sa
ON
   sc.address_id = sa.address_id;

-- join: customer vehicles
SELECT
   (sc.name_first, sc.name_second, sv.color, sv.year, sv.make, sv.model)
FROM
   service_customer as sc
JOIN
   service_vehicle as sv
ON
   sc.customer_email = sv.owner;

-- join: service price
SELECT
   (ss.service_id, SUM(ji.cost))
FROM
   service_service AS ss
LEFT JOIN service_job      AS sj ON ss.service_id=sj.service_id
LEFT JOIN service_job_info AS ji ON sj.job_name=ji.job_name
GROUP BY (ss.service_id);

-- join: service details
SELECT
   (ss.service_id, ss.customer_email, sj.job_name, sj.technician, ji.cost)
FROM
   service_service AS ss
LEFT JOIN service_job      AS sj ON ss.service_id=sj.service_id
LEFT JOIN service_job_info AS ji ON sj.job_name=ji.job_name;

