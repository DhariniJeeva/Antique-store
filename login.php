<?php
require_once "assets/inc/page_start.php";
require_once "DB.class.php";
require "lib_project1.php";
require_once PATH_INC . "log.header.php";

$title = "Project1 | Login";
$output = str_replace('%TITLE%', $title, $output);
echo $output;

$header = "Welcome to 'Relics and Rarieties!'";
$headoutput = str_replace('%HEADER%', $header, $headoutput);
echo $headoutput;

//setting object
$db = DB::getInstance();

//data sanitisation for signup form

$errors = array();
if(isset($_POST['signup'])) {
    session_start();
     $name = $_POST['username'];
     $email = $_POST['email'];
     $pass =  $_POST['password'];

    if (empty($_POST['username']) || is_numeric($_POST['username']) || htmlspecialchars($_POST['username'])) {
        $errors['name'] = '<p class="error">Please enter username, only letter are allowed</p>';
    }

    if (empty($_POST['email'])) {

        $errors['email'] = '<p class="error">Please enter email</p>';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = '<p>Please enter password</p>';
    }

    if (!isset($_POST["captcha"]) || $_POST["captcha"] == "" ||
        $_SESSION["vercode"] != $_POST["captcha"]) {
        $errors['captcha'] = '<p class="error">wrong verification code</p>';
    }

    //check if user already exists in table, if yes, then redirect user to member login page
    if($res=$db->uniqueCheckName($name) ==1){

        $errors['name'] = '<p class="error">sorry name already exists</p>';
    }

    if($res=$db->uniqueCheckEmail($email) ==1){


        $errors['email'] = '<p class="error">sorry email already exists</p>';
    }

    if(!$errors){


        $_SESSION['userName'] = $_POST['username'];

        $query = "INSERT INTO signup(username, Email, password)
                  VALUES(?,?,?)";
        $data = array("$name", "$email", "$pass");

        $db->do_query($query, $data, array("s", "s","s"));
        $id= $db->get_insert_id();
        echo $db->get_affected_rows();
        if($db->get_affected_rows() ==1 ){
            echo "successfully added";
            header('Location: index.php?ID='.$id);
            exit();
        }
        else{
            echo "problem with your signup. Please email dj9875@rit.edu for assistance";
        }
    }
}
if(isset($errors['name'])) echo $errors['name'];

if(isset($errors['email'])) echo $errors['email'];

if(isset($errors['password'])) echo $errors['password'];

if(isset($errors['captcha'])) echo $errors['captcha'];

    echo "
    <form class='form-horizontal' method='post' role='form'>
    <h3>User Registration form</h3>
    <p><span class='error'>* required field.</span></p>
     <div class='form-group'>
           <label for='username' class='col-sm-2 control-label'>Username*</label>           
            <div class='col-sm-10'>
                <input type='text' placeholder='username' value='".$name."' name='username'>
            </div>
      </div>
      
      <div class='form-group'>
           <label for='email' class='col-sm-2 control-label'>Email*</label>           
            <div class='col-sm-10'>
                <input type='email' placeholder='email' value='".$email."' name='email'>
            </div>
      </div>
      
       <div class='form-group'>
           <label for='password' class='col-sm-2 control-label'>Password*</label>           
            <div class='col-sm-10'>
                <input type='password' placeholder='password' value='".$pass."' name='password'>
            </div>
      </div>
      
      <div class='form-group'>
           <label for='captcha' class='col-sm-2 control-label'>Captcha*</label>           
            <div class='col-sm-10'>
             <img src='captcha.php' style='border:solid 2px; border-color:yellow;'/><br/>

                <input name='captcha' placeholder='enter code' type='text'><br/>
            </div>
      </div>
      
      <div class='form-group'>
		<div class='col-sm-10 col-sm-offset-2'>
			<input id='submit' name='signup' type='submit' value='Submit' class='btn btn-primary'>
			<input id='submit' name='member' type='submit' value='Already a member?' class='btn btn-primary'>

		</div>
	</div>
    
</form>";
?>
<?php

if(isset($_POST['member'])){
    header('Location: member.php');
    exit();
}
?>