<?php
	

	class Percent
	{
		public $absolute 	=	0;
		public $relative 	=	0;
		public $hundred		=	0;
		public $nominal 	=	'';

		public function __construct ($new, $unit)
		{
			$this->absolute 	=	$this->formatNumber($new / $unit);
			$this->relative 	=	$this->formatNumber($this->absolute - 1);
			$this->hundred	 	=	$this->formatNumber($this->absolute * 100);

			$this->nominal 		=	'status-quo';

			if ($this->absolute > 1)
			{
				$this->nominal 	=	'positive';
			}
			else if ($this->absolute < 1)
			{
				$this->nominal 	=	'negative';
			}		
		}

		private function formatNumber($number)
		{
			return number_format($number, 2, '.', ' ');

		}
	}
?>