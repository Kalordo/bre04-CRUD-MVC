<?php

require __DIR__ . "/config/autoload.php";

$router = new Router();

$router->handleRequest($_GET);