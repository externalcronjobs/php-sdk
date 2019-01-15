<?php

namespace ExternalCronJobs\V1;

use ExternalCronJobs\Exception;

abstract class AbstractServicesBase {
    /** @var Client $client */
    protected $client;
    
    /**
     * @return string
     */
    abstract protected function endpoint();
    
    /**
     * AbstractBase constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }
    
    /**
     * @param array $parameters
     *
     * @return array
     *
     * @throws Exception
     */
    public function getAll(array $parameters = []) {
        return $this->makeCurl('GET', $this->endpoint(), $parameters);
    }
    
    /**
     * @param int $id
     *
     * @return array
     *
     * @throws Exception
     */
    public function get($id) {
        $url = $this->endpoint() . '/' . $id;
        
        return $this->makeCurl('GET', $url, []);
    }
    
    /**
     * @param $id
     *
     * @return array
     *
     * @throws Exception
     */
    public function delete($id) {
        $url = $this->endpoint() . '/' . $id;
        
        return $this->makeCurl('DELETE', $url, []);
    }
    
    /**
     * @param $parameters
     *
     * @return array
     *
     * @throws Exception
     */
    protected function post($parameters) {
        return $this->makeCurl('POST', $this->endpoint(), $parameters);
    }
    
    /**
     * @param $id
     * @param $parameters
     *
     * @return array
     *
     * @throws Exception
     */
    protected function put($id, $parameters) {
        $url = $this->endpoint() . '/' . $id;
        
        return $this->makeCurl('PUT', $url, $parameters);
    }
    
    /**
     * @param $method
     * @param $url
     * @param $data
     *
     * @return array
     *
     * @throws Exception
     */
    protected function makeCurl(string $method, string $url, array $data){
        $curl = curl_init();
        
        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        
        // Setting CURL Options
        curl_setopt($curl, CURLOPT_URL, $this->client->getDomain() . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'apikey: ' . $this->client->apiKey(),
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
        // All set? Time to execute CURL
        $result = curl_exec($curl);
        if(!$result){
            throw new Exception("ExternalCronJobs Connection failed");
        }
        
        echo $result;
        
        curl_close($curl);
        
        $response = [];
        try {
            $response = json_decode($result);
        } catch (\Exception $Exception) {
            unset($Exception);
        }
        
        return $response;
    }
}