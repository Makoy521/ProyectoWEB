<?php 
	class DB {
		const DB_HOST = 'localhost';
		public $DB_USER = 'root';
		public $DB_PASSWORD = '';
		const DB_NAME = 'proyectoweb';

		function __construct()
		{
		}

		function getConnection()
		{
			$dsn = "mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME;
			$dbh = new PDO($dsn, $this->DB_USER, $this->DB_PASSWORD);
			$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
			$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
			$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			return $dbh;
		}
	}
 ?>