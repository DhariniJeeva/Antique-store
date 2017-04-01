<?php

$output = '<html><title>%TITLE%</title></html>';
$headoutput = '<html>&nbsp;<div class=".page-header"><h1>%HEADER%</h1></div></html>';

function getUserID($id){
    $userid = $id;
}
?>
   <html>
    <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/fonts/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <link href="https://fonts.googleapis.com/css?family=Bevan" rel="stylesheet">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">

</head>
<body>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(' .single-item').slick({
        });
    });
</script>
<div class="d">
    <ul><i title="cart" class="fa fa-cart-plus fa-2x" aria-hidden="true" style="float:right; padding-right: 15px" onclick=window.location="cart.php?ID=<?php echo $userid?>"></i></ul>
<ul><i title="admin settings"class="fa fa-cog fa-2x" aria-hidden="true" style="float:right;padding-right: 15px" onclick=window.location="admin.php?ID=<?php echo $userid?>"></i></ul>
<ul><i title="logout" class="fa fa-sign-out fa-2x" aria-hidden="true" style="float: right;padding-right: 15px; color: yellow" onclick="window.location='logout.php'"></i></ul>
</div>
<div style="margin-top: 1.5%"><a style="color:aqua" href="index.php?ID=<?php echo $userid?>">Back to Catalogue</a></div>
</body>
</html>


