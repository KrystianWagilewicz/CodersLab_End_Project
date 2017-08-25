CREATE DATABASE noticeboard;

CREATE TABLE user_account (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id));

INSERT INTO user_account (name, surname, email, password) VALUES('admin','superadmin','admin@admin.pl','tajnehaslo');
