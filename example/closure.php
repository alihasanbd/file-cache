<?php

// Closure

require_once(__DIR__ .'/autoload.php');

use Kodeio\FileCache\fCache;

class ClosureTest
{
	private $data = [200];
	
	public function get()
	{
		$cache = new fCache('simple');
		$inst = $this;
		return $cache->get('ccczf93564yg', function() use($inst){
			return $inst->data;
		});
	}
}

$cache = new ClosureTest;
var_dump($cache->get());
