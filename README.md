# SecureCRUD

This project is to have a secured database of user and panel for manging them safely.

## Stack :

- html
- css
- php
- sql

## Authors :

- Yasminemfth
- Lohos

## Securités mise en place

Injections SQL :
- utilisateurs SQL avec droits limités
- requetes preparées avec pdo->prepare / execute

Attaques XSS :
- verification formulare coté serveur
- utilisation de htmlSpecialChars pour securisé les données en PHP

Attaques CSRF : 
- tokens CSRF (correspondance site/session et POST) pour eviter les manipulations par outils externes
- attribut SameSite dans les headers

Bonne Pratique :
- hashage du mot de passe (algorytme ByCript)

## Securités non mise en place :

attaques DDoS : 
- Hebergeur avec par-feu

## fichiers necessaires au bon fonctionnement :

- .env
- /sqlRequestInitialisation/sqlUsersCreation.sql