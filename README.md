#Casper API - Developers - PHP

This is a PHP wrapper for the Casper Developers API.

It allows you to fetch Login and Endpoint authentication for the Snapchat™ API.

You will need to register for access to the [Casper Developers Console](https://developers.casper.io) so you can create a Project and receive credentials for access.

##Usage

First, you will need to include the `CasperDevelopersAPI.php` class.

```
include_once("../src/CasperDevelopersAPI.php");
$casper = new CasperDevelopersAPI("your_api_key", "your_api_secret");
```

###Login Authentication

`getSnapchatIOSLogin` takes your Snapchat Username and Snapchat Password as arguments.

The `$login` object will contain the Headers and Parameters required to make a successful Snapchat Login request. It will also provide you with the URL that you should make the Snapchat Login request to.

If something goes wrong, a `CasperException` will be thrown.

```
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
```

###Endpoint Authentication

`getSnapchatIOSEndpointAuth` takes your Snapchat Username, Snapchat AuthToken and the Snapchat Endpoint as arguments.

The `$json` object will contain an Array object called `endpoints` which contains the Headers and Parameters for multiple Snapchat API Endpoints.

You will always receive the Headers and Parameters for the Endpoint you make a request for, but you might receive Headers and Parameters for additional endpoints, depending on which endpoint you made a request for.

Each object in `$endpoints` will contain `endpoint`, `headers`, `params` and `cache_millis`.

```
endpoint: The Snapchat Endpoint the headers and params are for.
headers: Headers to add to the Snapchat API request (for this endpoint)
params: Parameters to add to the Snapchat API request (for this endpoint)
cache_millis: How long in Milliseconds you are required to cache and reuse the Headers and Params before making another request to the Casper API.
```

The `$settings` object contains Settings that you **must** follow. For example, If `force_expire_cached` is set to `true`, you are required to invalidate, all of the Endpoints that you have cached for the username you have provided.

. It will also provide you with the URL that you should make the Snapchat Login request to.

If something goes wrong, a `CasperException` will be thrown.

```
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
```

##Examples

[See the Examples](./examples)

##Credits

Pizza and L&P, because they helped me create this.