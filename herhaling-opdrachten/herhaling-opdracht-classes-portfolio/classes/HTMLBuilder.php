<?php

	class HTMLBuilder
	{
		public function __construct ($header, $body, $footer)
		{
			$this->buildHeader($header);
			$this->buildBody($body);
			$this->buildFooter($footer);
		}

		public function buildHeader($file)
		{
			$cssFiles 	=	$this->searchFiles('css', '.css');
			$cssLinks 	=	$this->buildCsslinks($cssFiles);

			include_once ('html/'.$file.'.partial.html');
		}

		public function buildBody($file)
		{
			include_once ('html/'.$file.'.partial.html');
		}

		public function buildFooter($file)
		{
			$jsFiles 	=	$this->searchFiles('js', '.js');
			$jsLinks 	=	$this->buildJslinks($jsFiles);

			include_once ('html/'.$file.'.partial.html');
		}

		private function buildCsslinks($files)
		{
			$container 	=	'';

			foreach ($files as $file)
			{
				$container 	.=	'<link rel="stylesheet" href="' . $file . '">';
			}

			return $container;
		}

		private function buildJslinks($files)
		{
			$container 	=	'';

			foreach ($files as $file)
			{
				$container 	.=	'<script src="' . $file . '"></script>';
			}

			return $container;
		}

		private function searchFiles($folder, $extension)
		{
			$searchString 	=	$folder.'/*'.$extension;
			$files 			=	glob($searchString);

			return $files;
		}




	}




?>