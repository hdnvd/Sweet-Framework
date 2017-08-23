<?php

namespace core\CoreClasses\File;

/**
 *
 * @author nahavandi
 *        
 */
class JpegImage extends ImageFormat
{
	protected function getMimeType()
	{
		return "image/jpeg";
	}
}

?>