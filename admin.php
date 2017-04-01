<?php
require_once "assets/inc/page_start.php";
session_start();

//if no userName session is present, redirects you to login page
if(!isset($_SESSION['userName'])) {

    require_once "assets/inc/log.header.php";
    $title = "Project1 | Admin";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;
    $header = "Welcome to 'Relics and Rarieties!'";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;
    echo $link;
}
//otherwise, lets you proceed
else {
        if(isset($_GET['ID'])){
            $userid = $_GET['ID'];
        }
    require_once "DB.class.php";
    require_once  "assets/inc/header.php";
    require "lib_project1.php";
    //setting object
    $db = DB::getInstance();
    $title = "Project1 | Admin";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;

    $header = "Admin page-Inventory";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;
    getUserID($userid);
    $selectQuery = "SELECT * FROM products";
    $db->do_query($selectQuery);
    echo 'hint : password is admin';
    echo lib_project1::build_table($db->fetch_all_array(), "admin");

}
