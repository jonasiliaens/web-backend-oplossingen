<?php

	class Database
	{	
		private $db;
		
		public function __construct($dbConnection)
		{
			$this->db = $dbConnection;
		}

		public function query($queryString)
		{
			$statement = $this->db->prepare($queryString);
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

	}

?>