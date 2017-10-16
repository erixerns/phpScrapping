

<!-- fix author-->


<?php
    //Page 21
    //https://www.packtpub.com/web-development/object-oriented-programming-php5

    // Function to make GET request using curl
    function getCurl($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }

    //declaring array to store scraped books
    $packetBook = array();

    // Function to return XPATH object

    function returnXobj($item){
        $xmlPageDom = new DOMDocument();
        @$xmlPageDom->loadHTML($item);

        $xmlXpath = new DOMXPath($xmlPageDom);

        return $xmlXpath;
    }

    $packetPage = getCurl("https://www.packtpub.com/web-development/object-oriented-programming-php5");
    $packetPageXpath = returnXobj($packetPage);

    $title = $packetPageXpath->query('//h1');
    if($title->length > 0){
        $packetBook['title'] = $title->item(0)->nodeValue;
    }

    $release = $packetPageXpath->query(".//*[@id='mobile-book-container']/div[2]/div[2]/div/time");
    if($release->length > 0){
        $packetBook['release']=$release->item(0)->nodeValue;
    }

    $overview = $packetPageXpath->query('//div[@class="book-top-block-info-one-liner cf"]');
    if($overview->length>0){
        $packetBook['overview']=trim($overview->item(0)->nodeValue);
    }
    $author = $packetPageXpath->query(".//*[@id='mobile-book-container']/div[2]/div[2]/div");
    if($author->length>0){
        for ($i=0; $i < $author->length ; $i++) { 
            $packetBook['authors'][]= $author->item($i)->nodeValue;
        }
    }

    print_r($packetBook);
?>
