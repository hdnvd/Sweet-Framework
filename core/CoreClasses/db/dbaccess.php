<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2015/2/14
*/
namespace core\CoreClasses\db;

class dbaccess
{
	private  $debugmode,$dbHandler,$query,$insertedID;
	private $AutoClose;
	function __construct()
	{
		$this->debugmode=false;
		$this->connectToDatabase();
		$this->insertedID=null;
		$this->AutoClose=true;
	}
	public function beginTransaction()
	{
        
	    $this->setAutoClose(false);
	    $this->dbHandler->beginTransaction();
	
	}
	public function commit()
	{
	    $this->dbHandler->commit();
	    $this->close_connection();
	}
	public function rollBack()
	{
	    $this->dbHandler->rollBack();
	}
	function turnOnDebugMode()
	{
		$this->debugmode=true;
		
	}
	public function connectToDatabase()
	{
		global $setting_host,$setting_dbuser,$setting_dbpass,$setting_dbname;
		if($this->dbHandler===null)
		{
		  try 
		  {
			$dbHandler=new \PDO("mysql:host=" . $setting_host . ";dbname=" . $setting_dbname . ";charset=utf8",$setting_dbuser,$setting_dbpass );
			$dbHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		  }
		  catch (\PDOException $e)
		  {
			throw new \Exception($e->getMessage());
		  }
		  $this->dbHandler=$dbHandler;
		}
		return;
	}
	public function ExecuteNonQuery($command)
	{
		if($this->debugmode)
		{
			echo "<p>" . $command . "</p>";
		}
		$this->connectToDatabase();
		$statement=$this->dbHandler->prepare($command);
		$statement->execute();
		$this->insertedID=$this->dbHandler->lastInsertId();
		if($this->AutoClose)
		  $this->close_connection();
	}
	public function ExecuteQuery($command)
	{
		if($this->debugmode)
			echo "<p>" . $command . "</p>";
		$this->connectToDatabase();
		$statement=$this->dbHandler->prepare($command);
		$statement->execute();
		$statement->setFetchMode(\PDO::FETCH_OBJ);
		return $statement;
		
	}
	
	public function getQueryString()
	{
		return  $this->query;
	}
	
	public function getInsertedId()
	{
		return $this->insertedID;
	}
	public function close_connection()
	{
	  if($this->dbHandler!=null)
	  {
	    $this->dbHandler=null;
	    if($this->debugmode)
			echo "اتصال با پایگاه داده قطع شد";
	  }
	  
	}
	public function isClosed()
	{
	    if($this->dbHandler===null)
	        return true;
	    else 
	        return false;
	}
	public function quote($text)
	{
		return $this->dbHandler->quote($text);
	}
	

	public function setAutoClose($AutoClose)
	{
	    $this->AutoClose = $AutoClose;
	}

	public function getAutoClose()
	{
	    return $this->AutoClose;
	}
}
?>
