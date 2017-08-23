<?php

namespace core\CoreClasses\db;

/**
 *
 * @author nahavandi
 *        
 */
class DBField {
	private $field,$AddTablePrefix;
	public function __construct($field,$AddTablePrefix=true)
	{
		$this->setField($field);
		$this->setAddTablePrefix($AddTablePrefix);
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

	public function getAddTablePrefix()
	{
	    return $this->AddTablePrefix;
	}

	public function setAddTablePrefix($AddTablePrefix)
	{
	    $this->AddTablePrefix = $AddTablePrefix;
	}
}

?>