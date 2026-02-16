-- Creer la BDD
CREATE DATABASE SecureUser;
USE SecureUser;

--Creer la table des utilisateurs
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(255),
    pasword VARCHAR(255),
    biography TEXT
);

-- dsupprimer la BDD
DROP DATABASE SecureUser;