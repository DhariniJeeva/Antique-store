<?php
require_once "assets/inc/page_start.php";
session_start();

//if no userName session is present, redirects you to login page
if (!isset($_SESSION['userName'])) {
    require_once "assets/inc/log.header.php";
    $title = "Project1 | Index";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;

    $header = "Welcome to 'Relics and Rarieties'!";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;
    echo $link;
} //otherwise, you can proceed
else {
    if (isset($_GET['ID'])) {
        $userid = $_GET['ID'];
    }

//adding all required sources
    require_once "assets/inc/header.php";
    require_once "DB.class.php";
    require "lib_project1.php";

//setting object
    $db = DB::getInstance();

//dynamic title
    $title = "Project1 | Index";
    $output = str_replace('%TITLE%', $title, $output);
    echo $output;
    $welcome = $_SESSION['userName'];

//dynamic header
    $header = "Hey, $welcome! Welcome to 'Relics and Rarieties'";
    $headoutput = str_replace('%HEADER%', $header, $headoutput);
    echo $headoutput;
    $d = getUserID($userid);

//if discounted items are clicked
    if (isset($_POST['AddtoCart'])) {
        $ID = $_POST['ID'] . "<br/>";
        $name = $_POST['Name'];
        $Desc = $_POST['Desc'];
        $Price = $_POST['Price'];
        $Saleprice = $_POST['Saleprice'];
        $imagename = $_POST['imagename'];
        $quantity = $_POST['Quantity'];

        if ($quantity == 0) {
            echo "<script language='JavaScript'>alert('Sorry not in stock')</script>";
        } else {
            //checks if the discounted product already exists in the user's cart
            if ($db->uniqueCheckProdUser($name, $userid) > 0) {
                discountUpdatetoCart($ID);
            } else {
                discountAddtoCart($userid, $ID, $name, $Desc, $Saleprice, $imagename);
            }
        }
    }
    //if catalogue items are clicked
    if (isset($_POST['CatAddtoCart'])) {
        $ID = $_POST['ID'] . "<br/>";
        $name = $_POST['Name'];
        $Desc = $_POST['Desc'];
        $Price = $_POST['Price'];
        $cost = $_POST['cost'];
        $imagename = $_POST['imagename'];
        $quantity = $_POST['Quantity'];

        if ($quantity == 0) {
            echo "<script language='JavaScript'>alert('Sorry not in stock')</script>";
        } else {
            echo "<script language='JavaScript'>alert('Added to cart')</script>";

            //checks if the product already exists in the user's cart
            if ($db->uniqueCheckProdUser($name, $userid) > 0) {
                catUpdateCart($ID);

            } else {
                catAddtoCart($userid, $ID, $name, $Desc, $Price, $imagename);
            }
        }
    }
    echo '

<img id="sale" src="assets/image/onsale.gif" style="margin-left: 38%; margin-top: 4%;" width="20%" height="10%"/>
<div class="content">';
    $query = "SELECT * FROM products where Saleprice!=0";
    $db->do_query($query);
    echo lib_project1::build_table($db->fetch_all_array(), "discount");
    echo '</div>';
    //pagination, displaying only 5 items each page
    $page = $_GET['page'];
    if ($page == "" || $page == "1") {
        $page1 = 0;
    } else {
        $page1 = ($page * 5) - 5;
    }
    echo '
        <h2 style="margin-left:30px; color: white">More items in our catalogue!</h2>';
        $query = "SELECT * FROM products where Saleprice=0 LIMIT $page1,5";
        $db->do_query($query);
        echo lib_project1::build_table($db->fetch_all_array(), "catagory");
        $count = $db->get_affected_rows();
        $a = $count / 1.5;
        $a = ceil($a);

        for ($b = 1; $b <= $a; $b++) {
            ?><a href="index.php?ID=<?php echo $userid ?>&page=<?php echo $b ?>"
             style="font-size:large;color:aqua;text-decoration: none;"><?php echo $b . " "; ?></a><?php
    }
} ?>
