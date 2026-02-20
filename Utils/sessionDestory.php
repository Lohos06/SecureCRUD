<?php
require_once "sessionStart.php";

if(isset($_SESSION)) {
    session_destroy();
}
header("Location: /index.php")

?>