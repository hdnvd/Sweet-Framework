<?php

namespace core\CoreClasses\File;

/**
 *
 * @author nahavandi
 *        
 */
class GifImage extends ImageFormat
{
	protected function getMimeType()
	{
		return "image/gif";
	}
}

?>