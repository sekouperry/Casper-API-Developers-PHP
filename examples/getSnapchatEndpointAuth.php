<?php

include_once("../src/CasperDevelopersAPI.php");

//Register at https://developers.casper.io to get Credentials
$casper = new CasperDevelopersAPI("your_api_key", "your_api_secret");

try {

    $json = $casper->getSnapchatIOSEndpointAuth("username", "auth_token", "/loq/conversations");

    $endpoints = $json->endpoints;
    $settings = $json->settings;

    $should_expire = $settings->force_expire_cached ? "Yes" : "No";
    echo "Delete all Cached Endpoints?: {$should_expire}\n\n";

    foreach($endpoints as $endpoint_auth){

        echo "Snapchat Endpoint: {$endpoint_auth->endpoint}\n";
        echo "Cache Milliseconds: {$endpoint_auth->cache_millis}\n";

        foreach($endpoint_auth->headers as $key => $value){
            echo "Header: {$key} = {$value}\n";
        }

        foreach($endpoint_auth->params as $key => $value){
            echo "Parameter: {$key} = {$value}\n";
        }

        echo "\n";

    }

} catch(Exception $e){
    echo "Oops! " . $e->getMessage() . "\n";
}