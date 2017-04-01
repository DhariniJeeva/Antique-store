<?php
session_start();

session_regenerate_id();
session_destroy();
unset($_SESSION);

if (isset($_SESSION)){
    echo " session exits";
}

echo $_POST[$_SESSION];
require_once "assets/inc/page_start.php";

require_once PATH_INC . "log.header.php";

$title="Project1 | logout";
$output=str_replace('%TITLE%', $title, $output);
echo $output;

$header="Thank you for shopping with us!";
$headoutput=str_replace('%HEADER%', $header, $headoutput);
echo $headoutput;

?>

<html>
<body>
<p style="text-align: center; font-size: larger">click below to log back in! <br/>
     <i class="fa fa-user fa-3x" aria-hidden="true" onclick="window.location='login.php'"></i></p>
</body>
</html>
