<?php 
session_start();
require('db/connection.php');
require('setup/function.php');
if(isset($_GET['page'])){
    switch($_GET['page']){
        case 'signout':
            unset($_SESSION['username']);
            require('views/login.php');
        break;
    }
}else{
    if(isset($_SESSION['username'])==false){
        if(isset($_POST['username_login'])){
           login();
        }else{
            require('views/login.php');
        }
    }else{
        require('views/home.php');
       
    }   
}


?>