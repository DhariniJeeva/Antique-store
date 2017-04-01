<?php
require_once "DB.class.php";

class lib_project1
{
    public static function build_table($db_array, $flag)
    {
///if the flag is set to discount

        if ($flag == "discount") {
            echo '<div class="single-item">';
            foreach ($db_array as $URL) {
                echo '<form method="post">';
                echo '<div><strong>' . $URL["Name"] . '</strong></div>';
                echo '<div>' . $URL["description"] . '</div>';
                echo '<div class="image"><img id="fig" width: 100%; height="auto" src="assets/image/' . $URL["imagename"] . '"</div>';
                echo '<div><strike style="color: orangered">Price was: ' . $URL["Price"] . '$</strike></div>';
                echo '<div style="color: gold">Price now: ' . $URL["Saleprice"] . '$</div>';
                echo '<div>Hurry! Only ' . $URL["Quantity"] . ' left</div>';


                echo '<input type="hidden" name="ID" value=' . $URL["ID"] . '>';
                echo "<input type='hidden' name='Name' value='" . $URL['Name'] . "'>";
                echo '<input type="hidden" name="imagename" value=' . $URL["imagename"] . '>';
                echo "<input type='hidden' name='Desc' value= '" . $URL["description"] . "'>";
                echo '<input type="hidden" name="Price" value=' . $URL["Price"] . '>';
                echo '<input type="hidden" name="Saleprice" value=' . $URL["Saleprice"] . '>';
                echo '<input type="hidden" name="Quantity" value=' . $URL["Quantity"] . '>';
                echo '<input type="submit" class="btn btn-outline-primary" value="Add to Cart" name="AddtoCart"></i>
                <br/><br/>';
                echo '</form>';
                echo '</div>';
            }
            echo '</div>';

        }
        //catalogue catagory
        if ($flag == "catagory") {

            foreach ($db_array as $URL) {
                echo '<div class="cat">';
                echo '<form method="post">';
                echo '<div><strong>' . $URL["Name"] . '</strong></div>';
                echo '<div>' . $URL["description"] . '</div>';
                echo '<div class="image" ><img width: 100%; height: auto; src="assets/image/' . $URL["imagename"] . '"</div>';
                echo '<div style="color: gold">Price is: ' . $URL["Price"] . '$</div>';
                echo '<div>Hurry! Only ' . $URL["Quantity"] . ' left</div>';
                echo '<input type="submit" value="Add to Cart" name="CatAddtoCart" class="btn btn-outline-primary"></i>
                <br/><br/>';
                echo '</div>';

                echo '<input type="hidden" name="ID" value=' . $URL["ID"] . '>';
                echo "<input type='hidden' name='Name' value='" . $URL['Name'] . "'>";
                echo '<input type="hidden" name="imagename" value=' . $URL["imagename"] . '>';
                echo "<input type='hidden' name='Desc' value= '" . $URL["description"] . "'>";
                echo '<input type="hidden" name="Price" value=' . $URL["Price"] . '>';
                echo '<input type="hidden" name="Quantity" value=' . $URL["Quantity"] . '>';


                echo '</form>';

                echo '</div>';
            }

        }

        if (isset($_GET['ID'])) {
            $userid = $_GET['ID'];
        }
//disaply for the cart
        if ($flag == "cart") {

            echo '<div class="cartcontent">';

            $total_price = 0;
            foreach ($db_array as $URL) {

                echo '<form method="post">';
                echo '<tr><div><strong>' . $URL["name"] . '</strong></div></tr>';
                echo '<tr><div>' . $URL["description"] . '</div></tr>';
                echo '<tr><div class="image"><img src="assets/image/' . $URL["imagename"] . '"</div></tr>';
                echo '<tr><div>Price is: ' . $URL["cost"] . '$</div></tr>';
                echo '<tr><div>Quantity: ' . $URL["quantity"] . '</div></tr>';
                echo '<input type="submit" class="btn btn-outline-primary" value="Empty Cart" name="emptyCart">';

                echo '<input type="hidden" name="ID" value=' . $URL["ID"] . '>';
                echo '<input type="hidden" name="Name" value=' . $URL["name"] . '>';
                echo '<input type="hidden" name="imagename" value=' . $URL["imagename"] . '>';
                echo '<input type="hidden" name="Desc" value=' . $URL["description"] . '>';
                echo '<input type="hidden" name="cost" value=' . $URL["cost"] . '>';
                echo '<input type="hidden" name="quantity" value=' . $URL["quantity"] . '>';
                echo '<br/>';
                echo '<br/>';

                $total_price += $URL['cost'] * $URL['quantity'];

                echo '</div>';
                echo '</form>';
            }
            echo "Total Price : " . $total_price . "$";
            echo ' <input class="btn btn-primary" type="submit" name="Buy" value="Buy" onClick=document.location.href="purchase.php?ID=' . $userid . '">';
            echo ' <input class="btn btn-primary" type="submit" name="save" value="Save for later" onClick=document.location.href="index.php?ID=' . $userid . '">';
        }
        if ($flag == "admin") {
            $db = DB::getInstance();

            echo '<div class="form-group" style="margin-top: 2%">';
            echo '<form method="post" class="form-horizontal">';
            echo "<label for='client'>select from the list to edit item: </label>";
            echo '<select name="client" id="client" style="margin-left: 20px;">';
            echo '<option value="0">Choose one</option>';
            foreach ($db_array as $admin) {

                echo '<option value="' . $admin['ID'] . '"' . (($_POST['client'] == $admin['ID']) ? 'selected="selected"' : "") . '>' . $admin['Name'] . '</option>';

            }


            echo '</select>';
            echo '&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="select" name="selectList">';
            echo '</form>';
            $target_dir = "assets/image/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            echo $image = basename($_FILES["fileToUpload"]["name"]);
            if (isset($_POST['selectList'])) {
                $query = "SELECT * FROM products where ID=?";
                $db->do_query($query, array($_POST['client']), array("i"));
                $rwo = $db->fetch_all_array();
                foreach ($rwo as $row) {
                }
                echo '</div>';

            }
            //edit an item begins
            $target_dir = "assets/image/";
            $target_file = $target_dir . basename($_FILES["fileToUploads"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["editform"])) {

                $oldsale= $_POST['oldsale'];
                 $_POST['imagename'];
                 $oldfile = $_POST['oldfileToUploads'];
                 $name = $_POST['names'];
                 $idd = $_POST['prodids'];
                 $description = $_POST['descriptions'];
                 $price = $_POST['prices'];
                 $quantity = $_POST['quantitys'];
                 $saleprice = $_POST['salePrices'];

                echo $image = basename($_FILES["fileToUploads"]["name"]);
                // Check file size
                if ($_FILES["fileToUploads"]["size"] > 500000) {
                    echo "<p class='error'>Sorry, your file is too large.</p>";
                    $uploadOk = 0;
                }

                if (empty($name) ||
                    empty($price) || empty($description) ||
                    is_numeric($name)
                ) {
                    echo "invalid entries. name can not empty or numeric and price cant be empty or string";
                    $uploadOk = 0;
                }

                //check if its admin
                if ($db->getAdmin($_POST['passwords']) != 1) {
                    echo '<p class="error">Sorry you are not an administrator-password wrong</p>';
                    $uploadOk = 0;
                }
                //maintaining discount items constraint
                //check if oldsaleprice and new saleprice are same
                if($oldsale !=$saleprice) {

                    if ($_POST['salePrices'] > 0) {

                        $res = $db->get_discounted_items();
                        if ($res == 1) {

                            echo "<p class='error'>sorry you  can't add more discounted items now. so make saleprice 0 </p>";
                            $uploadOk = 0;
                        }
                    }
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<p class='error'>Sorry, your product was not edited/added. </p>";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUploads"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["fileToUploads"]["name"]) . " has been uploaded.";

                    }

                    //if no changes in image
                    if (empty($image)) {

                        $updateProd = "UPDATE products SET Name = ?, description=?, Price=?, Quantity=?, Saleprice=?
                                    WHERE ID=?";
                        $updateData = array("$name", "$description", "$price", "$quantity", "$saleprice", "$idd");
                        $db->do_query($updateProd, $updateData, array("s", "s", "i", "i", "i", "i"));
                        echo $db->get_error();
                        $db->get_affected_rows();
                        if ($db->get_affected_rows() > 0) {
                            echo "<p style='color: green'>yay successfully updated!</p>";
                        } else {
                            echo "<p style='font-size: large' class='error'>please select from the drop down list again and proceed</p>";
                        }

                    } else {
                        $updateProd = "UPDATE products SET Name = ?, description=?, Price=?, Quantity=?, Saleprice=?, imagename=? 
                                    WHERE ID=?";
                        $updateData = array("$name", "$description", "$price", "$quantity", "$saleprice", "$image", "$idd");
                        $db->do_query($updateProd, $updateData, array("s", "s", "i", "i", "i", "s", "i"));
                        echo $db->get_error();
                        echo $db->get_affected_rows();
                        if ($db->get_affected_rows() > 0) {
                            echo "<p style='color: green;'>yay successfully updated with image!</p>";
                        } else {
                            echo "<p class='error'>please select from the drop down list again and proceed</p>";
                        }
                    }


                }
            }
            echo "<form class='form-horizontal' method='post' enctype='multipart/form-data'>
    <h4>Edit item</h4>
    <p><span class='error'>* required field.</span></p>
    <div class='form-group'>
     <div class='col-lg-12'>
           <label for='name' class='col-sm-2 control-label'>Name*</label>
           <input type='text' name='names' id='names' value='" . (($row["Name"]) ? ($row["Name"]) : $_POST['names']) . "'>
           <input type='hidden' name='prodids' id='prodids' value=" . $_POST['client'] . ">

     </div>
     </div>
    
    <div class='form-group'>
     <div class='col-lg-12'>
           <label for='description' class='col-sm-2 control-label'>Description*</label>
           <input type='text' name='descriptions' id='descriptions' value='" . (($row["description"]) ? ($row["description"]) : $_POST['descriptions']) . "'>

     </div>
     </div>
    
    <div class='form-group'>
     <div class='col-lg-12'>
           <label for='price' class='col-sm-2 control-label'>Price*</label>
           <input type='number' name='prices' id='prices' value='" . (($row["Price"]) ? ($row["Price"]) : $_POST['prices']) . "'>
     
     </div>
     </div>
     
     <div class='form-group'>
     <div class='col-lg-12'>
           <label for='quantity' class='col-sm-2 control-label'>Quantity*</label>
           <input type='number' name='quantitys' id='quantitys' value='" . (($row["Quantity"]) ? ($row["Quantity"]) : $_POST['quantitys']) . "'>
     </div>
     </div>
     
     <div class='form-group'>
     <div class='col-lg-12'>
           <label for='salePrices' class='col-sm-2 control-label'>Sale Price*</label>
           <input type='number' name='salePrices' id='salePrices' value='" . (($row["Saleprice"]) ? ($row["Saleprice"]) : $_POST['salePrices']) . "'>
           <input type='hidden' name='oldsale' id='oldsale' value='" . ($row["Saleprice"])."'>
     </div>
     </div>
    
     <div class='form-group'>
     
           <label for='fileToUpload' class='col-sm-2 control-label'>Select image to upload*</label>

           <input type='file' name='fileToUploads' id='fileToUploads' value=''>
           <input type='hidden' name='oldfileToUploads' id='oldfileToUploads' value=" . (($row["imagename"]) ? ($row["imagename"]) : $_POST['oldfileToUploads']) . ">

           
           <caption>" . $row['imagename'] . "</caption>
           
          <!-- <img width='175' height='200' src='assets/image/" . (($row['imagename']) ? ($row['imagename']) : $oldfile) . "'/>-->
           
           
     </div>
     
     <div class='form-group'>
                    <div class='col-lg-12'>
                        <label for='password' class='col-sm-2 control-label'>Password*</label>
                        <input type='password' name='passwords' id='passwords'>
                    </div>
                    </div>
    
                   <div class='form-group'>
                   <div class='col-lg-12 col-sm-offset-2'>
                   <input type='submit' name='editform' value='submit form' class='btn btn-primary'>
                   <input type='hidden' name='selectList' class='btn btn-primary'>
                    
                   </div>
                   </div>
                   </form>";//edit item ends here!

            //Add product
            $target_dir = "assets/image/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["uploadimage"])) {
                // Check if file already exists
                if (!empty($target_file)) {
                    if (file_exists($target_file)) {
                        echo "<p class='error'>Sorry, file already exists.</p>";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        echo "<p class='error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
                        $uploadOk = 0;
                    }
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "<p class='error'>Sorry, your file is too large.</p>";
                    $uploadOk = 0;
                }

                if (empty($_POST['name']) ||
                    empty($_POST['price']) ||
                    empty($_POST['description']) || empty($_POST['quantity']) ||
                    is_numeric($_POST['name'])
                ) {
                    echo "<p class='error'>name can not empty or numeric and price cant be empty or string</p>";
                    $uploadOk = 0;
                }
                if (($_POST['name'])) {

                    if ($db->uniqueCheckProd($_POST['name']) > 0) {

                        echo "<p class='error'>duplicate product</p>";
                        $uploadOk = 0;
                    }
                }
                //check if its admin
                if ($db->getAdmin($_POST['password']) != 1) {
                    echo '<p class="error">Sorry you are not an administrator-password wrong</p>';
                    $uploadOk = 0;
                }
                if ($_POST['salePrice'] > 0) {

                    $res = $db->get_discounted_items();
                    if ($res == 1) {
                        echo "<p class='error'>sorry you  can't add more discounted items now. so make saleprice 0 </p>";
                        $uploadOk = 0;
                    }
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<p class='error'>Sorry, your product was not added. </p>";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                    }
                    echo $name = $_POST['name'];
                    echo $description = $_POST['description'];
                    echo $price = $_POST['price'];
                    echo $quantity = $_POST['quantity'];
                    echo $saleprice = $_POST['salePrice'];
                    echo $image = basename($_FILES["fileToUpload"]["name"]);

                    $insertquery = "INSERT INTO products(Name, description, Price, Quantity, Saleprice, imagename)
                                    VALUES(?,?,?,?,?,?)";
                    $data1 = array("$name", "$description", "$price", "$quantity", "$saleprice", "$image");
                    $db->do_query($insertquery, $data1, array("s", "s", "i", "i", "i", "s"));
                    echo $db->get_error();
                }
            }//add form
            echo '
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
    <h4>Add new item</h4>
    <p><span class="error">* required field.</span></p>
     <div class="form-group">
     <div class="col-lg-12">
        <label for="name" class="col-sm-2 control-label">Name*</label>
        
           <input type="text" name="name" id="name" value="' . $_POST['name'] . '">
     </div>
     </div>           
    <div class="form-group">
    <div class="col-lg-12">
        <label for="description" class="col-sm-2 control-label">Description*</label>
        
           <input type="text" name="description" id="description" value="' . $_POST['description'] . '">
     </div>
     </div> 
          
     <div class="form-group">
      <div class="col-lg-12">
        <label for="price" class="col-sm-2 control-label">Price*</label>
       
           <input type="number" name="price" id="price" value="' . $_POST['price'] . '">
     </div>
     </div> 
           
    <div class="form-group">
    <div class="col-lg-12">
        <label for="quantity" class="col-sm-2 control-label">Quantity*</label>
        
           <input type="number" name="quantity" id="quantity" value="' . $_POST['quantity'] . '">
     </div>
     </div>
     
     <div class="form-group">
      <div class="col-lg-12">
        <label for="salePrice" class="col-sm-2 control-label">Sale Price*</label>
       
           <input type="number" name="salePrice" id="salePrice" value="' . $_POST['salePrice'] . '">
     </div>
     </div>
      
    <div class="form-group">
    <div class="col-lg-12">
        <label for="fileToUpload" class="col-sm-2 control-label">Select image to upload*</label>
        
           <input type="file" name="fileToUpload" id="fileToUpload" value="">
     </div>
     </div>
     
    <div class="form-group">
    <div class="col-lg-12">
        <label for="password" class="col-sm-2 control-label">Password*</label>
        
           <input type="password" name="password" id="password" value="">
     </div>
     </div>
     
     <div class="form-group">
     <div class="col-lg-12 col-sm-offset-2">
           <input type="submit" name="uploadimage" value="Upload" class="btn btn-primary">
           <input type="reset" name="reset" value="reset" class="btn btn-primary">

     </div>
     </div>

</form>';
        }
    }
}

//adds to the cart and update product table
function catAddtoCart($userid, $ID, $name, $Desc, $cost, $imagename)
{
    $db = DB::getInstance();
    $query2 = "INSERT INTO cart(ID, name, description, cost, imagename, userid)
                VALUES(?,?,?,?,?,?)";
    $data = array($ID, "$name", "$Desc", $cost, "$imagename", $userid);

    $db->do_query($query2, $data, array("i", "s", "s", "i", "s", "i"));
    echo $db->get_error();

    //updating the product table
    $updateProd = "UPDATE products set Quantity = Quantity - 1 WHERE ID = ?";
    $proddata = array($ID);
    $db->do_query($updateProd, $proddata, array("i"));


    $updateQuery = "UPDATE cart set quantity = quantity + 1 WHERE ID = ?";
    $data = array($ID);
    $db->do_query($updateQuery, $data, array("i"));

}

//updates the cart and product when the product is same
function catUpdateCart($ID)
{
    $db = DB::getInstance();
    //updating the product table
    $updateProd = "UPDATE products set Quantity = Quantity - 1 WHERE ID = ?";
    $proddata = array($ID);
    $db->do_query($updateProd, $proddata, array("i"));


    $updateQuery = "UPDATE cart set quantity = quantity + 1 WHERE ID = ?";
    $data = array($ID);
    $db->do_query($updateQuery, $data, array("i"));

}

//updates the cart and discounted product when the product is same
function discountAddtoCart($userid, $ID, $name, $Desc, $Saleprice, $imagename)
{
    $db = DB::getInstance();
    $query2 = "INSERT INTO cart(ID, name, description, cost, imagename, userid)
                VALUES(?,?,?,?,?,?)";
    $data = array($ID, "$name", "$Desc", $Saleprice, "$imagename", $userid);
    $db->do_query($query2, $data, array("i", "s", "s", "i", "s", "i"));
    echo $db->get_error();
    //updating the product table
    $updateProd = "UPDATE products set Quantity = Quantity - 1 WHERE ID = ?";
    $proddata = array($ID);
    $db->do_query($updateProd, $proddata, array("i"));

    $updateQuery = "UPDATE cart set quantity = quantity + 1 WHERE ID = ?";
    $data = array($ID);
    $db->do_query($updateQuery, $data, array("i"));

}

//updates the cart and discounted product when the product is same
function discountUpdatetoCart($ID)
{
    $db = DB::getInstance();
    //updating the product table
    $updateProd = "UPDATE products set Quantity = Quantity - 1 WHERE ID = ?";
    $proddata = array($ID);
    $db->do_query($updateProd, $proddata, array("i"));

    $db->get_error();
    $updateQuery = "UPDATE cart set quantity = quantity + 1 WHERE ID = ?";
    $data = array($ID);
    $db->do_query($updateQuery, $data, array("i"));
    $db->get_error();
}

?>
<html>
<head>
</head>
</html>