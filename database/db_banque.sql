CREATE DATABASE db_banque

CREATE TABLE account (
  id int NOT NULL AUTO_INCREMENT,
  code_account varchar(250) DEFAULT NULL,
  date_created datetime DEFAULT NULL,
  id_customer int DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY code_account_UNIQUE (code_account),
  KEY id_customer_idx (id_customer),
  CONSTRAINT id_customer FOREIGN KEY (id_customer) REFERENCES customer (id) ON DELETE CASCADE ON UPDATE CASCADE
) 

CREATE TABLE account_costs (
  id int NOT NULL AUTO_INCREMENT,
  id_account int DEFAULT NULL,
  PRIMARY KEY (id),
  KEY id_account_idx (id_account),
  CONSTRAINT id_account FOREIGN KEY (id_account) REFERENCES account (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT id_costs FOREIGN KEY (id) REFERENCES costs (id) ON DELETE CASCADE ON UPDATE CASCADE
) 

CREATE TABLE costs (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(45) DEFAULT NULL,
  date_created varchar(45) DEFAULT NULL,
  PRIMARY KEY (id)
) 
CREATE TABLE customer (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(50) DEFAULT NULL,
  adress varchar(45) DEFAULT NULL,
  phone_number int DEFAULT NULL,
  PRIMARY KEY (id)
) 

CREATE TABLE transaction (
  id int NOT NULL AUTO_INCREMENT,
  id_user int DEFAULT NULL,
  date datetime DEFAULT NULL,
  motif varchar(45) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT id_user FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
) 

CREATE TABLE user (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(45) DEFAULT NULL,
  password varchar(45) DEFAULT NULL,
  role int DEFAULT NULL,
  PRIMARY KEY (id)
) 