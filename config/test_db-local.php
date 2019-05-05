<?php
$db = require __DIR__ . '/db-local.php';

// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=mysql;dbname=customers_test';

return $db;
