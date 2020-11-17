<?php

use App\Controllers\CommentController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CommentController();
echo $controller->getComment();
