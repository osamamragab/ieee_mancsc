<?php

try {
	if (!isset($dbconn)) {
		$dbconn = new PDO("mysql:host=127.0.0.1:3306;dbname=php_auth", "php_auth", "php_auth@pass");
		$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // fail on error
		$dbconn->exec("CREATE TABLE IF NOT EXISTS users(name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL);");
	}
} catch (PDOException $e) {
	echo "database connection failed: " . $e->getMessage();
}

function tidy_input($input) {
	return htmlspecialchars(stripslashes(trim($input)));
}

?>
