<?php

echo phpversion ();

ini_set('eaccelerator.enable', 0);

require __DIR__.'/../public_html/YCHR/bootstrap/autoload.php';

$app = require_once __DIR__.'/../public_html/YCHR/bootstrap/app.php';