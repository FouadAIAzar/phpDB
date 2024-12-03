CREATE TABLE autos (
   auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
   make VARCHAR(128),
   year INTEGER,
   mileage INTEGER
);

SELECT * FROM autos;

CREATE TABLE users (
   id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
   email VARCHAR(128) NOT NULL,
   password VARCHAR(128) NOT NULL
);

SELECT * FROM users;

INSERT INTO users (email, password) VALUES ('a@a.com', '123');

S

INSERT INTO autos (make, year, mileage) VALUES ('Toyota', 2005, 200000);

DELETE FROM autos WHERE make = NULL;
SELECT * FROM autos;
