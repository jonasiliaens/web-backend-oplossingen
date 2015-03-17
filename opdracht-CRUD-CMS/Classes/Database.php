<?php

	class Database
	{	
		private $db;
		
		public function __construct($dbConnection)
		{
			$this->db = $dbConnection;
		}

		public function query($queryString, $placeholders = false)
		{
			$statement = $this->db->prepare($queryString);

			if ($placeholders)
			{
				foreach($placeholders as $placeholderName => $placeholderValue)
				{
					$statement->bindValue($placeholderName, $placeholderValue);
				}
			}

			$statement->execute();

			$results = array();

			while ( $row = $statement->fetch( PDO::FETCH_ASSOC ) )
			{
				$results[]	=	$row;
			}
			if ( empty( $results ) )
			{
				$results = false;
			}
			return $results;
		}

		public function insert($queryString, $placeholders = false)
		{
			$statement = $this->db->prepare($queryString);

			if ($placeholders)
			{
				foreach($placeholders as $placeholderName => $placeholderValue)
				{
					$statement->bindValue($placeholderName, $placeholderValue);
				}
			}

			$statement->execute();

		}

	}

?>