<?php 
    //if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
      //   $url = "https://";   
    //else  
        // $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    //$url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url= $_SERVER['REQUEST_URI'];
    echo $url;
    echo "<br>";
    echo $_SERVER['PHP_SELF'];
    echo "<br>";
    echo $_SERVER['SERVER_NAME'];
    echo "<br>";
    echo $_SERVER['HTTP_HOST'];
    echo "<br>";
    echo $_SERVER['HTTP_REFERER'];
    echo "<br>";
    echo $_SERVER['HTTP_USER_AGENT'];
    echo "<br>";
    echo $_SERVER['SCRIPT_NAME'];
    echo "<pre>";
    //print_r($_SERVER);
    echo "</pre>";
    $hosts= $_SERVER['HTTP_HOST'];
    $value =explode("/",$url);
    echo "0".$value[0];
    echo "<br>";
    echo  $value[1];
    echo "<br>";
    $texxt=  $value[2];
    echo "<br>";
    echo "3".$value[3];
    echo "<br>";echo "<br>";
// $links= $hosts."/".$value[1];

// echo "<br>";echo "<br>";

// echo "link: ".$links;
echo $value[2]== 'includes' ? 'open':'close';
// if($texxt=="includess"){
//   echo "open";
// } else{
//   echo "close";
// }
      
    $_SESSION['current_link'] = $url;  
  ?>   