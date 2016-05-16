<?php
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule();
$db = require_once __DIR__.'/../../config/database.php';
$capsule->addConnection($db);
$capsule->bootEloquent();