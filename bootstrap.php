<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set error reporting (optional)
error_reporting(E_ALL);
ini_set('display_errors', 1);
