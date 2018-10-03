<?php

namespace Kodeio\FileCache;

use Kodeio\FileCache;
use Exception; 

class fCache extends FileCache
{
	/* fife prefix & cache period */
	public function __construct($prefixes, $hour=24)
	{
		if(null == parent::$path){
			throw new Exception(
				"FileCache path 'Kodeio\FileCache::\$path' is not set."
			); 
		}
		if(false == is_array($prefixes)){
			$prefixes = [$prefixes];
		}
		
		if($tables = @$prefixes[0]){
			if(in_array($tables, parent::$tables)){
				throw new Exception(
					"The table/prefix '{$tables}' already in use on other model."
				);
			}
			parent::$tables[] = $tables;
			$this->prefix = @$prefixes[1];
			$this->tables = $tables;
			$this->hour = $hour;
		}else{
			throw new Exception(
				"The cache prefix(s) is/are invalid."
			);
		}
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
	
	public function get($recId, $del=true)
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
