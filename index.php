<?php

echo phpversion ();

ini_set('eaccelerator.enable', 0);

require __DIR__.'/../vender/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';