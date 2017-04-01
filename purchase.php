<?php
require_once "assets/inc/page_start.php";
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['userName'])) {

    require_once PATH_INC . "header.php";

    $title = "Project1 | purchase";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;


    $header = "Thank you for shopping!'";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;


    echo $link;
}
else{
    if(isset($_GET['ID'])){
        $userid = $_GET['ID'];
        //echo $userid;
    }
    require_once PATH_INC . "header.php";
    require "lib_project1.php";
//setting object

    $title = "Project1 | Purchase";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;

    $header = "Thank you for shopping";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;

    echo '<p style="font-family: Futura">your item will reach you soon.</p>';

}
?>