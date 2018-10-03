<?php

namespace Kodeio;

class FileCache
{
	public static $path=null, $prefixes=[];
	protected $file, $id, $hour, $prefix;
	
	protected function fname($id)
	{
		$fileName = "/kdata_{$this->prefix}_{$id}_obj.fc";
		return rtrim(self::$path, '/') . $fileName;
	}

	protected function readCache($file, $del)
	{
		$this->file = unserialize(file_get_contents($file));
		if($del && $this->isExpired()) $this->delete();
		return @$this->file->data[0];
	}
}
