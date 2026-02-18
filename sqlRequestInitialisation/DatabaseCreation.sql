-- Creer la BDD
CREATE DATABASE SecureUser;
USE SecureUser;

--Creer la table des utilisateurs
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(255),
    password VARCHAR(255),
    role VARCHAR(10),
    biography TEXT
);

-- supprimer la BDD
DROP DATABASE SecureUser;