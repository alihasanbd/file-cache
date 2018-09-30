<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once(__DIR__ .'/autoload.php');

use Kodeio\FileCache\fCache;

$cache = new fCache('simple');
$cache2 = new fCache('simple2');

$cache->set('zf93564yg', ['value' => 100]);
echo '<pre>';
print_r($cache->get('zf93564yg'));
