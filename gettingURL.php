



<?php
    //function for get request using curl
    function curlGet($url){
        $ch = curl_init();

        //setting curl options
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        /*
        Additional curl_setopt
        CURLOPT_USERAGENT 
        CURLOPT_HTTPHEADER
        */
        $result = curl_exec($ch);
        
        //$httpResponse = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        //echo $httpResponse;

        curl_close($ch);
        return $result;
    }
    //https://www.packtpub.com/web-development/object-oriented-programming-php5
    $packtPage = curlGet("https://www.packtpub.com/web-development/object-oriented-programming-php5");

    echo $packtPage;
?>