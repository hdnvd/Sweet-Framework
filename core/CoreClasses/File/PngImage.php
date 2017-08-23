<?php

namespace core\CoreClasses\File;

/**
 *
 * @author nahavandi
 *        
 */
class PngImage extends ImageFormat
{
	protected function getMimeType()
	{
		return "image/png";
	}
}

?>