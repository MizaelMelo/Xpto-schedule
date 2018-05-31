<?php

session_start();

require './vendor/autoload.php';
require './config.php';

use App\Core\Core;

$core = new Core();
$core->run();