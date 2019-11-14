<?php

echo "Hello!";
exit;

require '../bootstrap.php';
require '../MiniBlogApplication.php';

$app = new MiniBlogApplicaiton(false);
$app->run();