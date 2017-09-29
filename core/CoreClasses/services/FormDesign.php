<?php
/*
*@Author:Hadi AmirNahavandi
*@Last Update:2014/5/10
*/
namespace core\CoreClasses\services;
	use core\CoreClasses\html\Div;
    use core\CoreClasses\html\FormLabel;
    use core\CoreClasses\html\Lable;

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

        private $FieldCaptions;
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
        protected function getFieldRowCode($Field,$Title,$PlaceHolder,$InvalidMessage=null)
        {
            if($PlaceHolder==null)
                $PlaceHolder=$Title;

            $Group=new Div();
            $Group->setClass('form-group');
            $lblTitle=new FormLabel($Title);
            $lblTitle->SetAttribute("for",$Field->getId());
            $lblTitle->SetClass('control-label col-sm-2');
            $Group->addElement($lblTitle);
            $TitleField=new Div();
            $TitleField->setClass('col-sm-10');
            $Field->SetAttribute('placeholder',$PlaceHolder);
            $TitleField->addElement($Field);
            if($InvalidMessage!=null){
                $InvalidFeedBackDiv=new Div();
                $InvalidFeedBackDiv->setClass('invalid-feedback');
                $InvalidFeedBackDiv->addElement(new Lable($InvalidMessage));
                $TitleField->addElement($InvalidFeedBackDiv);
            }
            $Group->addElement($TitleField);
            return $Group;
        }
        protected function getSingleFieldRowCode($Field)
        {
            $Group=new Div();
            $Group->setClass('form-group');
            $FieldDiv=new Div();
            $FieldDiv->setClass('col-sm-offset-2 col-sm-10');
            $FieldDiv->addElement($Field);
            $Group->addElement($FieldDiv);
            return $Group;
        }
        protected function getFieldCaption($FieldName)
        {
            if(key_exists($FieldName,$this->FieldCaptions))
                return $this->FieldCaptions[$FieldName];
            else
                return $FieldName;
        }
        protected function setFieldCaption($FieldName,$Caption)
        {
            $this->FieldCaptions[$FieldName]=$Caption;
        }
        public function __construct()
        {
            $this->FieldCaptions=array();
        }
    }
?>