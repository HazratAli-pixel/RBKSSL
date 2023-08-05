<?php 
session_start();
error_reporting(0);
    $FullUrl= $_SERVER['REQUEST_URI'];
    $HostName= $_SERVER['HTTP_HOST'];
    $Urls =explode("/",$FullUrl);

if(strlen($_SESSION['alogin'])!=0){
    if($_SESSION['user']['SRP']==1 && $_SESSION['user']['userId'] == $_SESSION['alogin']){
        header('location:./sr1c4e3a5o0q5c7k6l1/dashboard.php');
    }
    else {
        $Urls > 2 ? header('location:dashboard.php') : header('location:../dashboard.php');
        // header('location:dashboard.php');
    }
    
    
}

?>