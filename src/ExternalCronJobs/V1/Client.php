<?php
namespace ExternalCronJobs\V1;


use ExternalCronJobs\V1\Services\Crons;
use ExternalCronJobs\V1\Services\CronTypes;
use ExternalCronJobs\V1\Services\Folders;
use ExternalCronJobs\V1\Services\TimeSchedules;
use ExternalCronJobs\V1\Services\Timezones;

class Client {
    private $domain = 'http://hosted.externalcronjobs.com';
    
    /**
     * @var Folders $folders
     */
    public $folders;
    
    /**
     * @var Crons $crons
     */
    public $crons;
    
    /**
     * @var Timezones $timezones
     */
    public $timezones;
    
    /**
     * @var TimeSchedules
     */
    public $timeSchedules;
    
    /**
     * @var CronTypes
     */
    public $cronTypes;
    
    /**
     * @var string $apiKey
     */
    private $apiKey;
    
    /**
     * Client constructor.
     *
     * @param $apiKey
     */
    public function __construct($apiKey) {
        $this->setApiKey($apiKey);
        $this->folders = new Services\Folders($this);
        $this->crons = new Services\Crons($this);
        $this->timezones =  new Services\Timezones($this);
        $this->timeSchedules =  new Services\TimeSchedules($this);
        $this->cronTypes =  new Services\CronTypes($this);
    }
    
    /**
     * @return string
     */
    public function apiKey() {
        return $this->apiKey;
    }
    
    /**
     * @param $apiKey
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }
    
    /**
     * @param $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }
    
    /**
     * @return string
     */
    public function getDomain() {
        return $this->domain;
    }
}