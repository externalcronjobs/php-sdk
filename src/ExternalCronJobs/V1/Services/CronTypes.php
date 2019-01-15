<?php
namespace ExternalCronJobs\V1\Services;

use ExternalCronJobs\V1\AbstractServicesBase;

class CronTypes extends AbstractServicesBase {
    
    /**
     * @return string
     */
    protected function endpoint() {
        return '/api/v1/cron_types';
    }
}