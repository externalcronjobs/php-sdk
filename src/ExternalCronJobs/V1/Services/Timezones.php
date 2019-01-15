<?php
namespace ExternalCronJobs\V1\Services;

use ExternalCronJobs\V1\AbstractServicesBase;

class Timezones extends AbstractServicesBase {
    
    /**
     * @return string
     */
    protected function endpoint() {
        return '/api/v1/timezones';
    }
}