<?php

namespace core\CoreClasses\db;

/**
 *
 * @author hadi
 *        
 */
class TableField {
	private $table,$field,$as;
	
	/**
	 * 
	 * @param unknown $table
	 * @param unknown $field
	 * @param string $as
	 * @deprecated Use Of This Class Is Deprecated,Use DBField Instead.
	 */
	function __construct($table,$field,$as=null) {
		$this->table=$table;
		$this->field=$field;
		$this->as=$as;
	}
	public function getField()
	{
		return $this->field;
	}
	public function getTable()
	{
		return $this->table;
	}

	public function getAs()
	{
	    return $this->as;
	}

	public function setAs($as)
	{
	    $this->as = $as;
	}
}

?>