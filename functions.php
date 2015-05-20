<?php

function get_values($sql) {
	$dsn = 'mysql:dbname=goto;host=localhost';
	$user = 'root';
	$password = '';
	try{
		$options = array(
				PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf',);
		$pdo = new PDO($dsn, $user, $password, $options);
                $stmt = $pdo->prepare($sql);
		return $stmt;
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		return null;
		die();
	}
	$pdo = null;
}
