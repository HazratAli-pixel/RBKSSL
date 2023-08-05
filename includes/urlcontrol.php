<?php 
	$FullUrl= $_SERVER['REQUEST_URI'];
    $HostName= $_SERVER['HTTP_HOST'];
    $Urls =explode("/",$FullUrl);
    if($HostName == 'localhost:8080'){
        $FolderName = $Urls[2];
        $FileName = $Urls[3];
        $QueryName =explode("?",$FileName);
        $BaseUrl= "/".$Urls[1];
    }else{
        $FolderName = $Urls[1];
        $FileName = $Urls[2];
        $QueryName =explode("?",$FileName);
        $BaseUrl= "/".$Urls[0];
    }
?>