<?php

require_once "./utils.php";

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: /login.php", true, 301);
	exit();
}

$sql_stm = $dbconn->query("SELECT name, username FROM users");
$users = $sql_stm->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="center">
				<h2>Home</h2>
				<h3>Hello <?php echo $_SESSION["name"] . " (@" . $_SESSION["username"] . ")"; ?></h3>
				<div class="list">
					<p>Users on the system:</p>
					<ul>
						<?php
							foreach ($users as $info) {
								echo "<li>" . $info["name"] . " (@" . $info["username"] . ")</li>";
							}
						?>
					</ul>
				</div>
				<div style="margin: 20px auto;">Do you feel bored? <a href="/logout.php" style="color: red;">Logout!</a></div>
			</div>
		</div>
	</body>
</html>
