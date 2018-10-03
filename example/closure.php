<?php

// Closure

require_once(__DIR__ .'/autoload.php');

use Kodeio\FileCache\fCache;

class ClosureTest
{
	private $data = [200];
	
	public function get()
	{
		$inst = $this;
		$cache = new fCache('simple');
		return $cache->get('ccczf93564yg', function() use($inst){
			return $inst->data;
		});
	}
	
	public function pretty(String $recId, Closure $source)
	{
		$model = $this;
		$cache = new fCache('simple');
		return $cache->get($recId, 
			function() use($model, $source){
			return $source($model);
		});
	}
	
	public function test()
	{
		return $this->pretty('ppp1f93564yg', function($self){
			return $self->data;
		});
	}
}

$cache = new ClosureTest;
var_dump($cache->test());
