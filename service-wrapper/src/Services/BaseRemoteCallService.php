<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 4/28/15
 * Time: 10:09 AM
 */

namespace Conark\ServiceWrapper\Services;

use Config;
use Log;

/**
 * Uses the GuzzleHttp Client for handling
 * remote calls. Client can be injected as well
 * (for unit testing/mock purposes)
 *
 * Class BaseRemoteCallService
 * @package App\Services
 */
class BaseRemoteCallService extends AbstractService{

    /**
     * @param mixed $client
     */
    public function __construct($client = null){
        $this->_client = $client == null ? new \GuzzleHttp\Client : $client;
    }

    /**
     * @var \GuzzleHttp\Client
     */
    private $_client;

    public function getClient(){
        return $this->_client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function setClient($client){
        $this->_client = $client;
    }

    /**
     * Makes the remote call
     *
     * @param $url
     * @return GuzzleHttp\Message\Response
     */
    public function makeCall($url){
        try {
            $response = $this->getClient()->get($url);
        } catch (\Exception $e)
        {
            Log::error($e);
            $response = false;
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $params
     * @return GuzzleHttp\Message\Response
     */
    public function postCall($url, $params){
        return $this->getClient()->post($url, $params);
    }

}