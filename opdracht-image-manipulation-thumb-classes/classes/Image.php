<?php
	class Image
	{	
		private $fileName;
		private $fileTemp;
		private $fileType;
		private $fileSize;
		private $fileExtension;
		private $originalWidth;
		private $originalHeight;

		function __construct($name, $temp, $type, $size)
		{
			$this->fileName 	=	$name;
			$this->fileTemp 	=	$temp;
			$this->fileType 	=	$type;
			$this->fileSize 	=	$size;
		}

		public function validateType($types)
		{
			$isValid 	=	false;

			foreach ($types as $type)
			{
				if ($type == $this->fileType)
				{
					$isValid 	=	true;
				}
			}

			return $isValid;
		}

		public function validateSize()
		{
			$isValid 	=	false;

			if ($this->fileSize < 5000000)
			{
				$isValid 	=	true;
			}

			return $isValid;
		}

		public function validateFile()
		{	
			$fileIsValid 	=	false;
			$typeIsValid 	=	false;
			$sizeIsValid 	=	false;

			$typeIsValid 	=	$this->validateType(array('image/jpeg', 
														'image/png',
														'image/gif' ));

			$sizeIsValid 	=	$this->validateSize();

			if ($typeIsValid && $sizeIsValid)
			{
				$fileIsValid 	=	true;
			}

			return $fileIsValid;
		}

		public function giveDimension()
		{
			list($width, $height) = getimagesize($this->fileTemp);

			$this->originalWidth 	=	$width;
			$this->originalHeight 	=	$height;

			if ($width < $height)
			{
				$imageDimension 	=	'portret';
			}

			if ($width > $height)
			{
				$imageDimension 	=	'landscape';
			}

			if ($width == $height)
			{
				$imageDimension 	=	'square';
			}

			return $imageDimension;
		}

		public function createFileParts()
		{
			$fileParts				=	pathinfo($this->fileName);
			$name					=	$fileParts['filename'];
			$this->fileExtension 	=	$fileParts['extension'];

			return $name;
		}

		public function createThumbnail($width, $height)
		{
			$name 	= 	$this->createFileParts();

			$dimension 	=	$this->giveDimension();
			
			switch ($dimension) 
			{
				case 'landscape':
					$cropDimensions = $this->originalHeight;
					$x 	=	($this->originalWidth - $this->originalHeight)/2;
					$y 	=	0;
					$cropped = $this->cropImage($cropDimensions, $x, $y);
					break;

				case 'portret':
					$cropDimensions = $this->originalWidth;
					$x 	=	0;
					$y 	=	($this->originalHeight - $this->originalWidth)/2;
					$cropped = $this->cropImage($cropDimensions, $x, $y);
					break;

				case 'square':
					$cropped = $this->createSource();
					$cropDimensions = $this->originalWidth;
					break;
			}

			$thumb = imagecreatetruecolor($width, $height);
		
			imagecopyresized($thumb, $cropped, 0,0,0,0, $width,$height, $cropDimensions, $cropDimensions);

			$resized 	= 	imagejpeg($thumb, ('img/' . $name . '_thumb.jpg'), 100);
		}

		public function cropImage($cropDimensions, $x, $y)
		{
			$source =	$this->createSource();
			$crop = imagecreatetruecolor($cropDimensions, $cropDimensions);
	
			imagecopyresized($crop, $source, 0,0,$x,$y, $cropDimensions, $cropDimensions, $cropDimensions, $cropDimensions);

			return $crop;
		}

		public function createSource()
		{
			switch ($this->fileExtension)
			{
				case ('jpg'):
				case ('jpeg'):
					$source 	= 	imagecreatefromjpeg($this->fileTemp);
					break;
					
				case ('png'):
					$source 	=	imagecreatefrompng($this->fileTemp);
					break;
		
				case ('gif'):
					$source 	=	imagecreatefromgif($this->fileTemp);
					break;
			}

			return $source;
		}
	}
?>