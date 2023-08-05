<?php 
session_start();
error_reporting(0);

if(strlen($_SESSION['alogin'])!=0){
    if($_SESSION['user']['SRP']==0 && $_SESSION['user']['userId'] == $_SESSION['alogin']){
        header('location:dashboard.php');
    }
    else header('location:../dashboard.php');
}

?>