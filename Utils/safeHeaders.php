<?php

// Protectin des headers pour l'exterieur

// ne pas pouvoir afficher le site dans les i-frames en dehors de notre site
header("X-Frame-Options: SAMEORIGIN"); 

// le naviguateur respecte strictement les types de fichiers
// et donc ne les devines pas si mal parametrés (sert a ne pas avoir de programmes deguisés)
header("X-Content-Type-Options: nosniff");

// envoie seulement l'url snas les parametres si connection avec un autre site 
// (empeche la recuperation de parametres sensibles par ce site)
header("Referrer-Policy: strict-origin-when-cross-origin");

// empeche le chargement de ressources externes et le js dans le html
header("Content-Security-Policy: default-src 'self'");

?>