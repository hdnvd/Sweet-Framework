<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class FormLabel extends Lable {

	function __construct($Content,$ID="FormLabel",$Class="FormLabel")
    {
        parent::__construct($Content, $ID, $Class);
        $this->setTagName("label");
    }
}

?>