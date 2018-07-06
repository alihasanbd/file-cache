<?php

namespace Kodeio\FileCache;

abstract class fCache_Helper
{
	protected $cDir, $file, $id, $hour;
	
	protected function fname($id)
	{
		return rtrim($this->cDir, '/') .'/data_'. $id .'_obj.fc';
	}
	
	protected function readFile($file, $del)
	{
		$this->file = unserialize(file_get_contents($file));
		if($del && $this->isExpired()) $this->delete();
		return @$this->file->data[0];
	}
}
