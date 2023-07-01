-- create the databases
CREATE DATABASE IF NOT EXISTS laravel;

-- create the users for each database
CREATE USER 'root'@'%' IDENTIFIED BY 'secret';
GRANT CREATE, ALTER, INDEX, LOCK TABLES, REFERENCES, UPDATE, DELETE, DROP, SELECT, INSERT ON `laravel`.* TO 'root'@'%';

FLUSH PRIVILEGES;