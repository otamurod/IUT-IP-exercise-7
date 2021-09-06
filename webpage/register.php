<?php

include('connection.php');

$username = "";
$email = "";
$pswd = "";
$pswd_cm = "";
$fullname = "";
$dob = "";

try {
    $db = new PDO('mysql:dbname=blog; host=127.0.0.1', 'otamurod', '1');
    echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pswd = $_POST['pwd'];
    $pswd_cm = $_POST['confirm_pwd'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    if(preg_match('/[a-zA-Z0-9.-_]+[@]\w+[.]\w{2,3}/i',$email) && $pswd==$pswd_cm && preg_match('/^.{8,}$/i',$pswd)){
        $stmt=$db->prepare("INSERT INTO users (username,email,password,fullname,dob) VALUES ('$username','$email','$pswd','$fullname', '$dob')");
        $stmt->execute();
        header('Location: index.php', TRUE, 301);
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" required/>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" />
					</li>
                    <li>
                        <label for="dob">Date Of Birth</label>
                        <input type="text" name="dob" id="dob" />
                    </li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" required/>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" required />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
	</body>
</html>