<?php

namespace Kodeio\FileCache;

use Exception;

abstract class fCache_Helper
{
	protected  static $path = null;
	protected $file, $id, $hour, $prefix;
	
	protected function fname($id)
	{
		if(null !== self::$path){
			$idfr = str_replace('/', '_', $this->prefix) . $id;
			return rtrim(self::$path, '/') .'/data_'. $idfr .'_obj.fc';
		}
		throw new Exception(
			"FileCache path 'fCache::path' is not set."
		);
		return false;
	}
	
	protected function readFile($file, $del)
	{
		$this->file = unserialize(file_get_contents($file));
		if($del && $this->isExpired()) $this->delete();
		return @$this->file->data[0];
	}
}
