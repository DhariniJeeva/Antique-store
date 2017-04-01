<?php
session_start();

require_once "assets/inc/page_start.php";
require_once "DB.class.php";
require "lib_project1.php";
require_once PATH_INC . "log.header.php";
$title = "Project1 | Login/member";
$output = str_replace('%TITLE%', $title, $output);
echo $output;

$header = "Welcome to 'Relics and Rarieties!'";
$headoutput = str_replace('%HEADER%', $header, $headoutput);
echo $headoutput;
$db = DB::getInstance();
//check in database
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $res = $db->getAllPeople($username, $password);
    $id = $db->getUserID($username, $password);

    if ($res >= 1) {
        $_SESSION['userName'] = $username;
        echo "successfully loggedin";
       header('Location: index.php?ID='.$id);
        exit();
    } else {
        echo "<p class='error'>sorry please enter correct credentials</p>";
    }
}
echo '
<form method="post" class="form-horizontal" role="form">
    <h3>Login page</h3>
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
            <input type="text"  id="username" name="username" value='.$username.'>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password"  id="password" name="password" value='.$password.'>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="login" type="submit" value="Login" class="btn btn-primary">
            <input id="reset" name="clear" type="reset" value="clear" class="btn btn-primary">

        </div>
    </div>
</form>
<a href="login.php">Back to Sign up page!</a>';

?>