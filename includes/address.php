<?php 

    //if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
      //   $url = "https://";   
    //else  
        // $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    //$url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   

    $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

    $obj = json_decode($jsonobj);
    
    echo $obj->Peter;
    echo $obj->Ben;
    echo $obj->Joe;
  
    
    $url= $_SERVER['REQUEST_URI'];
      
    $_SESSION['current_link'] = $url;  
  ?>   