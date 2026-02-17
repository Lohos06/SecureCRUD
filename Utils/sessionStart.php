<?php

// parametrage des cookies de sessions
session_set_cookie_params([
  "lifetime" => 0, // suppression du cookie a la fermeture de l'onglet
  "path"     => "/", // cookie accessible sur toute les pages
  "secure"   => true, // envoie les cookies que en https donc encryptés
  "httponly" => true, // les cookies ne peuvent pas etre lus par du js
  "samesite" => "Strict" // n'evnoie pas le cokie si ne viens pas du site
]);

// regenere l'id de la sessiona sa creation pour ne pas qu'on puisse utiliser d'ancien id de session
session_start();
session_regenerate_id(true);

?>