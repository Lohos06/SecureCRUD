<?php
$lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if ($line[0] === '#') continue;

    [$key, $value] = explode('=', $line, 2);
    putenv(trim($key) . '=' . trim($value));
    $_ENV[trim($key)] = trim($value); // si tu veux vraiment $_ENV
}
?>