<?php

namespace Kodeio;

class FileCache
{
	public static $path, $tables = [];
	protected $file, $id, $hour, $table, $prefix;
	
	protected function fname($id)
	{ 
		$table = str_replace(['/','\\'], '_', $this->table);
		$prefix = (null == $this->prefix)? '_'. $this->prefix:''; 
		$file = "/data_{$table}{$prefix}_{$id}_obj.fc";
		return rtrim(self::$path, '/') . $file;
	}
	
	protected function readCache($file, $del)
	{
		$this->file = unserialize(file_get_contents($file));
		if($del && $this->isExpired()) $this->delete();
		return @$this->file->data[0];
	}
}
