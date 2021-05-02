<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use patipark\yii2log\Log;

$model = new Log();
echo $model::tableName();
