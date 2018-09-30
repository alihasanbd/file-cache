<?php

namespace Kodeio\FileCache;

use Kodeio\FileCache;
use Exception;

class fCache extends FileCache
{	
	/* fife prefix & cache period */
	public function __construct($prefix, $hour=24)
	{
		if(in_array($prefix, parent::$prefixes)){
			throw new Exception(
				"The prefix '{$prefix}' already in use."
			);
		}
		parent::$prefixes[] = $prefix;
		$this->prefix = $prefix;
		$this->hour = $hour;
	}
	
	/* @return - Nr. of char written or FALSE */
	public function set($recId, $data)
	{
		$file = $this->fname($recId);
		return file_put_contents($file, serialize((object)[
			'data' => [$data], 'updated_at' => null,
			'created_at' => strtotime('now'), 
		]));  
	}
	
	public function get($recId, $del=false)
	{
		$file = $this->fname($recId);
		if(true == file_exists($file)){
			$this->id = $recId; /* Saving Id */
			return $this->readCache($file, $del);
		}
		return null;
	}
	
	public function update($data)
	{
		if(null !== $this->file){
			$this->file->data = [$data];
			$this->file->updated_at = strtotime('now'); 
			return file_put_contents($this->fname($this->id), 
				serialize($this->file)
			);
		}
		return null;
	}
	
	public function delete($recId=null)
	{
		if(null == $recId){
			$recId = @$this->id;
		}
		if($file = $this->fname($recId)){
			if(true == file_exists($file)){
				return unlink($file);
			}
		}
		return null;
	}
	
	public function isExpired()
	{
		if(null !== $this->file){ 
			$minStart = strtotime("-{$this->hour} hours");
			return ($minStart >= $this->file->created_at);
		}
		return null;
	}
}
