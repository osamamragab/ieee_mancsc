<?php

require_once "./utils.php";

session_start();

if (isset($_SESSION["username"])) {
	header("Location: /", true, 301);
	exit();
}

$errmsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = tidy_input($_POST["username"]);
	$password = tidy_input($_POST["password"]);
	if (empty($username) || empty($password)) {
		$errmsg = "Username and Password are required.";
	} else {
		$sql_stm = $dbconn->prepare("SELECT name, password FROM users WHERE username = ?");
		$sql_stm->execute([$username]);
		$sql_res = $sql_stm->fetch();
		if (!empty($sql_res) && password_verify($password, $sql_res["password"])) {
			$_SESSION["name"] = $sql_res["name"];
			$_SESSION["username"] = $username;
			header("Location: /", true, 301);
			exit();
		} else {
			$errmsg = "Username or Password is incorrect.";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="center">
				<h2>Login</h2>
				<form method="post">
					<input type="text" name="username" placeholder="Username" value="<?php echo isset($username) && !empty($username) ? $username : "" ?>"/>
					<input type="password" name="password" placeholder="Password" />
					<div class="error"><?php echo $errmsg; ?></div>
					<span>Are you a new user? <a href="/register.php">Register!</a></span>
					<button type="submit">Login</button>
				</form>
			</div>
		</div>
	</body>
</html>
