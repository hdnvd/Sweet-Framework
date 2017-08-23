<?php
/*
*@Author:Hadi AmirNahavandi
*@Last Update:2014/5/10
*/
namespace core\CoreClasses\services;
	abstract class FormDesign extends ModuleClass
	{
		private $data=array();

        /**
         * @return mixed
         */
        public function getMessage()
        {
            return $this->message;
        }

        /**
         * @param mixed $message
         */
        public function setMessage($message)
        {
            $this->message = $message;
        }
        private $message;
        private $messageType;

        /**
         * @return int
         */
        public function getMessageType()
        {
            return $this->messageType;
        }

        /**
         * @param int $messageType
         */
        public function setMessageType($messageType)
        {
            $this->messageType = $messageType;
        }
		public abstract function getBodyHTML($command="load");
		public function getResponse()
		{
			if(CURRENT_RESPONSEMODE==ResponseMode::XML)
				return $this->getXML()->asXML();
			elseif(CURRENT_RESPONSEMODE==ResponseMode::HTML)
				return $this->getBodyHTML();
			elseif (CURRENT_RESPONSEMODE==ResponseMode::AJAX)
				return $this->getAjaxHTML();
			elseif (CURRENT_RESPONSEMODE==ResponseMode::JSON)
				return $this->getJSON();
		}
		/**
		 * @return \SimpleXMLElement
		 */
		public function getXML()
		{
			return null;
		}
		public function getJSON()
		{
			return null;
		}
		public function getAjaxHTML($command="load")
		{
			return $this->getBodyHTML($command);
		}
		public function __set($name, $value)
		{
			$methodName="set" . ucwords($name);
			if(!method_exists($this,$methodName))
				$this->data[$name] = $value;
			else
				throw new \Exception("Access To Parameter $name Denied!");
		}
		
		public function __get($name)
		{
			$methodName="set" . ucwords($name);
			if(!method_exists($this,$methodName))
			{
				if (array_key_exists($name, $this->data)) 
				{
					return $this->data[$name];
				}
				return "";
			}
			else
				throw new \Exception("Access To Parameter $name Denied!");
		}
	}
?>