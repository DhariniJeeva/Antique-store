<?php
require_once "assets/inc/page_start.php";
session_start();

//if no userName session is present, redirects you to login page
if(!isset($_SESSION['userName'])){
    require_once "assets/inc/log.header.php";
    $title = "Project1 | Cart";
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
    //getUserID($userid);
    require_once  "assets/inc/header.php";
    require_once "DB.class.php";
    require "lib_project1.php";
    $title = "Project1 | Cart";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;

//setting object
    $db = DB::getInstance();
    $header = "Add to Cart page";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;

    getUserID($userid);
    //when empty cart button is clicked, item is deleted from cart table and updated in products table
    if (isset($_POST['emptyCart']) || $_POST['total_price'] == 0) {
        $deletedID = $_POST["ID"];
        $deletedQuantity = $_POST["quantity"];
        $pruce = $_POST['cost'];
        $DeleteQuery = "DELETE FROM cart WHERE ID=?";
        $db->do_query($DeleteQuery, array($deletedID), array("i"));

        if($db->get_affected_rows()>0){
            echo "<p style='text-align:center; font-size:larger; font-family:sans-serif ;color: mediumaquamarine';>
            Your changes to the cart are saved!</p>";
        }
        $updateQuery = "UPDATE products SET Quantity= Quantity + ? WHERE ID=?";
        echo "<br/>";
        $db->do_query($updateQuery, array($deletedQuantity, $deletedID), array("i", "i"));
        echo "<br/>";
        $query2 = "SELECT * FROM cart where userid=?";
        $db->do_query($query2, array($userid), array("i"));
        echo lib_project1::build_table($db->fetch_all_array(), "cart");
    }
}
?>

