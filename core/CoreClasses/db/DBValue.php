<?php

namespace core\CoreClasses\db;

/**
 *
 * @author nahavandi
 *        
 */
class DBValue {
	private $field;
	public function __construct($field)
	{
		$this->setField($field);
	}
	public function __toString()
	{
		return $this->field;
	}

	public function getField()
	{
	    return $this->field;
	}

	public function setField($field)
	{
	    $this->field = $field;
	}

}

?>