<?php
namespace ExternalCronJobs\V1\Services;

use ExternalCronJobs\V1\AbstractServicesBase;

class TimeSchedules extends AbstractServicesBase {
    
    /**
     * @return string
     */
    protected function endpoint() {
        return '/api/v1/time_schedules';
    }
}