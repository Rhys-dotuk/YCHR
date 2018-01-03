<?php

echo phpversion ();

ini_set('eaccelerator.enable', 0);

require __DIR__.'/../public_html/bootstrap/autoload.php';

$app = require_once __DIR__.'/../public_html/bootstrap/app.php';