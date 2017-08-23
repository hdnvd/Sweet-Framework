<?php

namespace core\CoreClasses\db;

/**
 *
 * @author nahavandi
 *        
 */
class TableName {
	private $TableName,$Nickname;
	public function __construct($TableName,$Nickname)
	{
		$this->setTableName($TableName);
		$this->setNickname($Nickname);
	}
	

	public function getTableName()
	{
	    return $this->TableName;
	}

	public function setTableName($TableName)
	{
	    $this->TableName = $TableName;
	}

	public function getNickname()
	{
	    return $this->Nickname;
	}

	public function setNickname($Nickname)
	{
	    $this->Nickname = $Nickname;
	}
}

?>