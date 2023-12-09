<?php

require_once "./utils.php";

session_start();

if (isset($_SESSION["username"])) {
	header("Location: /", true, 301);
	exit();
}

$errmsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$name = tidy_input($_POST["name"]);
	$username = tidy_input($_POST["username"]);
	$password = tidy_input($_POST["password"]);
	$password_confirm = tidy_input($_POST["password_confirm"]);
	if (empty($name) or empty($username) or empty($password)) {
		$errmsg = "Name, Username, and Password are required.";
	} elseif ($password !== $password_confirm) {
		$errmsg = "Password does not match.";
	} else {
		$sql_stm = $dbconn->prepare("SELECT 1 FROM users WHERE username = ?");
		$sql_stm->execute([$username]);
		$sql_res = $sql_stm->fetch();
		if (empty($sql_res)) {
			$sql_stm = $dbconn->prepare("INSERT INTO users (name, username, password) VALUES (:name, :username, :password)");
			$sql_stm->execute([
				":name" => $name,
				":username" => $username,
				":password" => password_hash($password, PASSWORD_DEFAULT),
			]);
			$_SESSION["name"] = $name;
			$_SESSION["username"] = $username;
			header("Location: /", true, 301);
			exit();
		} else {
			$errmsg = "Username is already used.";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="center">
				<h2>Register</h2>
				<form method="post">
					<input type="text" name="name" placeholder="name" value="<?php echo isset($name) && !empty($name) ? $name : "" ?>"/>
					<input type="text" name="username" placeholder="Username" value="<?php echo isset($username) && !empty($username) ? $username : "" ?>"/>
					<input type="password" name="password" placeholder="Password" />
					<input type="password" name="password_confirm" placeholder="Confirm password" />
					<div class="error"><?php echo $errmsg; ?></div>
					<span>Do you have an account? <a href="/login.php">Login!</a></span>
					<button type="submit">Register</button>
				</form>
			</div>
		</div>
	</body>
</html>
