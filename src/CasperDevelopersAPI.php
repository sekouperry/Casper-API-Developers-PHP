<?php

include_once dirname(__FILE__) . '/lib/JWT.php';
include_once dirname(__FILE__) . '/CasperAgent.php';
include_once dirname(__FILE__) . '/CasperException.php';

/**
 * @file
 * PHP implementation of the Casper Developers API.
 */
class CasperDevelopersAPI extends CasperAgent {

    public function __construct($api_key = null, $api_secret = null){
        $this->setAPIKey($api_key);
        $this->setAPISecret($api_secret);
    }

    /**
     * Fetches all Headers and Parameters required to make a Snapchat iOS Login request
     *
     * @param string $username
     *   Your Snapchat Username
     *
     * @param string $password
     *   Your Snapchat Password
     *
     * @return object
     *   Response Object
     *
     * @throws CasperException
     *   An exception is thrown if an error occurs.
     */
    public function getSnapchatIOSLogin($username, $password){

        $response = parent::post("/snapchat/ios/login", null, array(
            "username" => $username,
            "password" => $password
        ));

        if(!isset($response->headers)){
            throw new CasperException("Headers not found in Response");
        }

        if(!isset($response->params)){
            throw new CasperException("Params not found in Response");
        }

        return $response;

    }

    /**
     * Fetches all Headers and Parameters required to make a Snapchat API request to the Endpoint provided.
     * Additional Endpoints may be returned at the same time.
     *
     * @param string $username
     *   Your Snapchat Username
     *
     * @param string $auth_token
     *   Your Snapchat AuthToken
     *
     * @param string $endpoint
     *   Snapchat API Endpoint
     *
     * @return object
     *   Response Object
     *
     * @throws CasperException
     *   An exception is thrown if an error occurs.
     */
    public function getSnapchatIOSEndpointAuth($username, $auth_token, $endpoint){

        $response = parent::post("/snapchat/ios/endpointauth", null, array(
            "username" => $username,
            "auth_token" => $auth_token,
            "endpoint" => $endpoint
        ));

        if(!isset($response->endpoints)){
            throw new CasperException("Endpoints Object not found in Response");
        }

        return $response;

    }

}
