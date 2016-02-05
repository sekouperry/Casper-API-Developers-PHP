<?php

include_once("../src/CasperDevelopersAPI.php");

//Register at https://developers.casper.io to get Credentials
$casper = new CasperDevelopersAPI("your_api_key", "your_api_secret");

try {

    $login = $casper->getSnapchatIOSLogin("username", "password");

    echo "Snapchat Login URL: {$login->url}\n\n";

    foreach($login->headers as $key => $value){
        echo "Header: {$key}={$value}\n";
    }

    echo "\n";

    foreach($login->params as $key => $value){
        echo "Param: {$key}={$value}\n";
    }

} catch(Exception $e){
    echo "Oops! " . $e->getMessage() . "\n";
}