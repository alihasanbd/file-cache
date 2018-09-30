<?php

namespace Kodeio;

use Exception;

class FileCache
{
	public static $path, $prefixes = [];
	protected $file, $id, $hour, $prefix;
	
	protected function fname($id)
	{
		if(null == self::$path){
			throw new Exception(
				"FileCache path 'Kodeio\FileCache::\$path' is not set."
			);
			return false;
		} 
		$idfr = str_replace(['/','\\'], '_', $this->prefix) .'_'. $id;
		return rtrim(self::$path, '/') .'/data_'. $idfr .'_obj.fc';
	}
	
	protected function readCache($file, $del)
	{
		$this->file = unserialize(file_get_contents($file));
		if($del && $this->isExpired()) $this->delete();
		return @$this->file->data[0];
	}
}
