<?php

require_once(__DIR__ .'/autoload.php');

use Kodeio\FileCache\fCache;

$cache = new fCache(__DIR__ .'/cache/', 10);

$cache->set('zf93564yg', ['value' => 100]);
echo '<pre>';
print_r($cache->get('zf93564yg', true));
