<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'AddtoCart':
            AddtoCart();
            break;
        case 'select':
            select();
            break;
    }
}

function select() {
    echo "The select function is called.";
    exit;
}

function AddtoCart() {
    echo "The AddtoCart function is called.";
    exit;
}
?>