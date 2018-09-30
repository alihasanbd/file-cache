<?php

require_once(__DIR__ .'/../src/FileCache.php');
spl_autoload_register(function ($class){
	$class = str_replace('Kodeio\\FileCache\\', '', $class);
	$file = __DIR__ .'/../src/'. $class .'.php';
	if(file_exists($file)){
		require_once($file);
	}
});

Kodeio\FileCache::$path = __DIR__ .'/cache/';
