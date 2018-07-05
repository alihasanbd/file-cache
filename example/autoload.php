<?php

spl_autoload_register(function ($class){
	$class = str_replace('Kodeio\\FileCache\\', '', $class);
	$file = __DIR__ .'/../src/'. $class .'.php';
	if(file_exists($file)){
		require_once($file);
	}
});
