<?php

use App\Controllers\VoitureController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoitureController();
echo $controller->getVoiture();


