<?php

session_start();
$db = new PDO('mysql:dbname=blog; host=127.0.0.1', 'otamurod', '1');
$out = "";

if(isset($_GET["logout"])){
    unset($_SESSION["username"]);
    session_destroy();
}

if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_SESSION["username"])){
    $out = $_SESSION["username"]["username"];
}

if(isset($_REQUEST["post"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
    $title = $_POST["title"];
    $body = $_POST["body"];
    $today = date("Y-m-d");
    $userId = $_SESSION["username"]["id"];

    $stmt = $db->prepare("INSERT INTO posts (title, body, publishDate, userId) VALUES ('$title', '$body', '$today', '$userId')");
    $stmt->execute();
}

else if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $pswd=$_POST["pwd"];
    $username=$db->quote($username);
    $pswd=$db->quote($pswd);
    $result=$db->query("SELECT * FROM users WHERE username = $username AND password = $pswd");
    $rows=$result->fetchAll();

    if(count($rows) == 0){
        $out = "You are not registered.";
    }
    else if(count($rows) > 0){
        foreach($rows as $row){
            $out = "Welcome ".$row["username"]."!";
            $_SESSION["username"]=$row;
        }
        if($_POST["remember"] == "on"){
            setcookie($row["username"], $row["username"], time()+3600*24*365);
        }
        else if($_POST["remember"] != "on"){
            setcookie($row["username"], $row["username"], time()-1);
        }
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>My Personal Page</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>

<?php include('header.php');
if(!isset($_SESSION["username"])){ ?>
    <!-- Show this part if user is not signed in yet -->
<div class="twocols">
    <form action="index.php" method="post" class="twocols_col">
        <ul class="form">
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo isset($_COOKIE["username"])?$_COOKIE["username"]:"";?>"/>
            </li>
            <li>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd"/>
            </li>
            <li>
                <label for="remember">Remember Me</label>
                <input type="checkbox" name="remember" id="remember" checked />
            </li>
            <li>
                <input type="submit" value="Submit" /> &nbsp; Not registered? <a href="register.php">Register</a>
            </li>
        </ul>
    </form>
<?php } ?>
    <h2><?php echo $out; ?></h2>
    <div class="twocols_col">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
    </div>
</div>
<?php
if(isset($_SESSION["username"])){ ?>
    <!-- Show this part after user signed in successfully -->
    <div class="logout_panel"><a href="register.php">My Profile</a>&nbsp;|&nbsp;<a href="index.php?logout=1">Log Out</a></div>
    <h2>New Post</h2>
    <form action="index.php?post=1" method="post">
        <ul class="form">
            <li>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" />
            </li>
            <li>
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10"></textarea>
            </li>
            <li>
                <input type="submit" value="Post" />
            </li>
        </ul>
    </form>

<?php
$posts=$db->query("SELECT p.title, p.body, p.publishDate, u.fullname, p.userId FROM posts p JOIN users u ON p.userId=u.id");
?>

    <div class="onecol">
        <?php foreach($posts as $post){	?>
            <div class="card">
                <h2><?php echo $post["title"];?></h2>
                <h5><?php echo $post["fullname"].", ".$post["publishedDate"];?></h5>
                <p><?php echo $post["body"];?></p>
            </div>
        <?php } ?>
    </div>
<?php } ?>

</body>
</html>