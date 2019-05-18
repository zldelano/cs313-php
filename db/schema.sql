-- Setup extensions
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- -- Database creation
-- CREATE DATABASE service;

-- -- Connect to database
-- \c service;

-- Drop tables if they exist
DROP TABLE IF EXISTS service_job;
DROP TABLE IF EXISTS service_service;
DROP TABLE IF EXISTS service_employee;
DROP TABLE IF EXISTS service_vehicle;
DROP TABLE IF EXISTS service_job_info;
DROP TABLE IF EXISTS service_customer;
DROP TABLE IF EXISTS service_address;

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
   customer_id       UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   name_first        VARCHAR(30)    NOT NULL,
   name_second       VARCHAR(30)    NOT NULL,
   phone_primary     NUMERIC(11,0)  NOT NULL,
   phone_secondary   NUMERIC(11,0)  DEFAULT NULL,
   address_id        UUID           NOT NULL,

   -- key setup
   PRIMARY KEY (customer_id),
   FOREIGN KEY (address_id) REFERENCES service_address (address_id)
);

CREATE TABLE service_job_info (
   job_name          VARCHAR(40)    NOT NULL,
   cost              NUMERIC(6,2)   NOT NULL,
   description       TEXT           DEFAULT NULL,

   -- key setup
   PRIMARY KEY (job_name)
);

CREATE TABLE service_vehicle (
   vin               NUMERIC(17,0)  NOT NULL,
   color             VARCHAR(15)    NOT NULL,
   make              VARCHAR(30)    NOT NULL,
   model             VARCHAR(30)    NOT NULL,

   -- key setup
   PRIMARY KEY (vin)
);

CREATE TABLE service_employee (
   employee_id       UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   name_first        VARCHAR(30)    NOT NULL,
   name_second       VARCHAR(30)    NOT NULL,
   role              VARCHAR(15)    NOT NULL,

   -- key setup
   PRIMARY KEY (employee_id),

   -- additional constraints
   CONSTRAINT is_valid_role CHECK (role IN ('advisor', 'technician', 'manager', 'valet'))
);

CREATE TABLE service_service (
   service_id        UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   customer_id       UUID           NOT NULL,
   vin               NUMERIC(17,0)  NOT NULL,
   advisor           UUID           NOT NULL,
   notes             TEXT,

   -- key setup
   PRIMARY KEY (service_id),
   FOREIGN KEY (customer_id)  REFERENCES service_customer (customer_id),
   FOREIGN KEY (vin)          REFERENCES service_vehicle (vin),
   FOREIGN KEY (advisor)      REFERENCES service_employee (employee_id)
);

CREATE TABLE service_job (
   job_id            UUID           NOT NULL       DEFAULT uuid_generate_v4(),
   service_id        UUID           NOT NULL,
   technician        UUID           NOT NULL,
   job_name          VARCHAR(40)    NOT NULL,
   time_start        TIMESTAMP      NOT NULL,
   time_end          TIMESTAMP,
   completed         BOOLEAN        DEFAULT FALSE,

   -- key setup
   PRIMARY KEY (job_id),
   FOREIGN KEY (service_id) REFERENCES service_service (service_id),
   FOREIGN KEY (technician) REFERENCES service_employee (employee_id),
   FOREIGN KEY (job_name)   REFERENCES service_job_info (job_name)
);