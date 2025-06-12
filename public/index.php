<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

use App\Core\Entrypoint;
use App\Repositories\NoteRepository;


$noteRepository = new NoteRepository($pdo);

$routes = require __DIR__ . '/../config/routes.php';

$entrypoint = new Entrypoint($routes, $noteRepository);
$entrypoint->handleRequest();