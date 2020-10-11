<?php
require_once "simple_html_dom.php";
$arrContextOptions=array(
    //disabling ssl verifying ?
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
    //defining a user agent
    'http' => array(
        'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
    ),
);

$site = file_get_html("https://yemek.com/tarif/",false, stream_context_create($arrContextOptions));

$links = $site->find("div[class=e1cftz0b4 css-wkz9il ebrn5c20] a[class=css-hol3hb e1cftz0b0]");

foreach ($links as $link) {
    $url = "https://yemek.com".$link->href;

    $site = file_get_html($url,false,stream_context_create($arrContextOptions));

    echo $site->find(".titleSecondPiece",0);
    echo $site->find("div.article p",0)->plaintext;
    echo $site->find("div.article p",1)->plaintext;

    //malzemeler
    echo $site->find("div.parts.ingredients",0);

    $yapilis= $site->find("div.parts.essenceOf ol p");

    echo "Yapılış <br>";

    $num = 1;
    foreach ($yapilis as $yap) {
        echo $num.":".$yap;
        $num++;
    }

}
?>