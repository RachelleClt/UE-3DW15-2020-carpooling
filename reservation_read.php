<?php

use App\Controllers\ReservationController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationController();
echo $controller->getReservation();
