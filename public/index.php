<?php
use Zclone\Core\Request;
[$router,$container]=require dirname(__DIR__).'/app/bootstrap.php';
$router->dispatch(new Request(), $container);
